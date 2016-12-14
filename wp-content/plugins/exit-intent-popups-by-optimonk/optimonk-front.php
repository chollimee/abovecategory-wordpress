<?php

/**
 * @Class OptiMonkFront
 */
class OptiMonkFront
{
    public static function init()
    {
        $accountId = get_option('optiMonk_accountId');
        $templateBasePath = dirname(__FILE__) . '/template';

        if (!$accountId) {
            return;
        }

        $insertJavaScript = file_get_contents($templateBasePath . '/insert-code.js');
        $insertJavaScript = str_replace('{{accountId}}', $accountId, $insertJavaScript);

        echo <<<EOD
<script type="text/javascript">
    $insertJavaScript
</script>

EOD;
        $data = OptiMonkFront::getWordpressData();

        $avsAdapterSetRows = join("\n   ", OptiMonkFront::getAdapterSet($data));
        $avsUserScript = file_get_contents($templateBasePath . '/optimonk-avs-user.js');
        $avsUserScript = str_replace('{{set_adapter}}', $avsAdapterSetRows, $avsUserScript);

        echo <<<EOD
<script type="text/javascript">
    $avsUserScript
</script>

EOD;
        $cartUpdateSetRows = join("\n   ", OptiMonkFront::getCartSetRows());
        $cartUpdateScript = file_get_contents($templateBasePath . '/optimonk-cart.js');
        $cartUpdateScript = str_replace('{{set_adapter}}', $cartUpdateSetRows, $cartUpdateScript);

        echo <<<EOD
<script type="text/javascript">
    $cartUpdateScript
</script>

EOD;

        $productData = OptiMonkFront::getWooCommerceProductData();
        $productSetRows = join("\n    ", OptiMonkFront::getAdapterSet($productData));
        $productScript = file_get_contents($templateBasePath . '/optimonk-product.js');
        $productScript = str_replace('{{set_adapter}}', $productSetRows, $productScript);

        echo <<<EOD
<script type="text/javascript">
    $productScript
</script>
EOD;
    }

    protected static function getWordpressData()
    {
        global $current_user, $wp_query;
        $return = array();

        if (isset($_GET['utm_campaign'])) {
            $return['utm_campaign'] = $_GET['utm_campaign'];
        }

        if (isset($_GET['utm_medium'])) {
            $return['utm_medium'] = $_GET['utm_medium'];
        }

        if (isset($_GET['utm_source'])) {
            $return['utm_source'] = $_GET['utm_source'];
        }

        $return['source'] = 'Direct';
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $return['referrer'] = $referrer ? $referrer : 'Direct';
        if (strpos($referrer, get_site_url()) !== 0) {
            $return['source'] = $referrer;
        }

        get_currentuserinfo();
        $return['visitor_type'] = (!empty($current_user->roles[0]) ? $current_user->roles[0] : 'logged out');

        $return['visitor_login_status'] = 'logged out';
        if (is_user_logged_in()) {
            $return['visitor_login_status'] = 'logged in';
        }

        $return['visitor_id'] = 0;
        if ($userId = get_current_user_id() > 0) {
            $return['visitor_id'] = $userId;
        }

        $return['page_title'] = strip_tags(wp_title("|", false, "right"));
        $return['post_type'] = get_post_type() ? get_post_type() : 'unknown';
        $return['post_type_with_prefix'] = '';

        $return['post_categories'] = '';
        $return['post_tags'] = '';
        $return['post_author'] = '';
        $return['post_full_date'] = '';
        $return['post_year'] = '';
        $return['post_month'] = '';
        $return['post_day'] = '';

        if (is_singular()) {
            $return['post_type'] = get_post_type();
            $return['post_type_with_prefix'] = 'single ' . get_post_type();

            $categories = array();
            foreach (get_the_category() as $category) {
                $categories[] = $category->slug;
            }

            $return['post_categories'] = join('|', $categories);

            if (($postTags = get_the_tags())) {
                $tags = array();
                foreach (get_the_tags() as $tag) {
                    $tags[] = $tag->slug;
                }

                $return['post_tags'] = join('|', $tags);
            }

            if (($author = get_userdata($GLOBALS["post"]->post_author))) {
                $return['post_author'] = $author->display_name;
            }

            $return["post_full_date"] = get_the_date();
            $return["post_year"] = get_the_date("Y");
            $return["post_month"] = get_the_date("m");
            $return["post_day"] = get_the_date("d");
        }

        if (is_archive() || is_post_type_archive()) {
            $return['post_type'] = get_post_type();
            $typePrefix = '';

            if (is_author()) {
                $typePrefix = "author ";
            } elseif (is_category()) {
                $typePrefix = "category ";
            } elseif (is_tag()) {
                $typePrefix = "tag ";
            } elseif (is_day()) {
                $typePrefix = "day ";
            } elseif (is_month()) {
                $typePrefix = "month ";
            } elseif (is_year()) {
                $typePrefix = "year ";
            } elseif (is_time()) {
                $typePrefix = "time ";
            } elseif (is_date()) {
                $typePrefix = "date ";
            } elseif (is_tax()) {
                $typePrefix = "tax ";
            }

            $return['post_type_with_prefix'] = $typePrefix . $return['post_type'];
        }

        $return['is_front_page'] = 0;
        if (is_front_page()) {
            $return['is_front_page'] = 1;
        }

        $return['is_home'] = 1;
        if (!is_front_page() && is_home()) {
            $return['is_home'] = 1;
        }

        $return['search_query'] = '';
        $return["search_results_count"] = 0;
        if (is_search()) {
            $return["search_query"] = get_search_query();
            $return["search_results_count"] = $wp_query->post_count;
        }

        return $return;
    }

    protected static function getWooCommerceCartData()
    {
        global $woocommerce;

        $return = array(
            'cart' => array(),
            'avs' => array(
                'cart_total' => 0,
                'cart_total_without_discounts' => 0,
                'number_of_item_kinds' => 0,
                'total_number_of_cart_items' => 0,
                'applied_coupons' => ''
            )
        );

        if (OptiMonkFront::isWooCommerce() === false) {
            return $return;
        }

        $cartTotal = 0;
        $numberOfItemKinds = 0;
        $totalNumberOfCartItems = 0;
        foreach ($woocommerce->cart->get_cart() as $item => $values) {
            /** @var WC_Product_Simple $cartProduct */
            $cartProduct = $values['data'];
            $cartProductName = $cartProduct->get_title();
            $cartProductQuantity = $values['quantity'];
            $cartProductPrice = get_post_meta($cartProduct->id, '_price', true);

            $return['cart'][] = array(
                'sku' => $cartProduct->get_sku(),
                'name' => $cartProductName,
                'price' => $cartProductPrice,
                'quantity' => $cartProductQuantity,
            );
            $cartTotal += $cartProductQuantity * $cartProductPrice;
            $numberOfItemKinds++;
            $totalNumberOfCartItems += $cartProductQuantity;
        }

        $return['avs']['cart_total_without_discounts'] = $cartTotal;
        $return['avs']['cart_total'] = (float) strip_tags($woocommerce->cart->get_cart_total());
        $return['avs']['number_of_item_kinds'] = $numberOfItemKinds;
        $return['avs']['total_number_of_cart_items'] = $totalNumberOfCartItems;
        $return['avs']['applied_coupons'] = join('|', $woocommerce->cart->get_applied_coupons());

        return $return;
    }

    protected static function getWooCommerceProductData()
    {
        global $post;

        $return = array(
            'current_product.name' => '',
            'current_product.sku' => '',
            'current_product.price' => '',
            'current_product.stock' => '',
            'current_product.categories' => '',
            'current_product.tags' => '',
        );

        if (OptiMonkFront::isWooCommerceProductPage() === false) {
            return $return;
        }

        $product = new \WC_Product($post->ID);

        $return['current_product.name'] = $product->get_title();
        $return['current_product.sku'] = $product->get_sku();
        $return['current_product.price'] = $product->get_price();
        $return['current_product.stock'] = $product->get_stock_quantity();
        $return['current_product.categories'] = strip_tags($product->get_categories('|'));
        $return['current_product.tags'] = strip_tags($product->get_tags('|'));

        return $return;
    }

    protected static function isWooCommerce()
    {
        global $woocommerce;

        if (
            isset($woocommerce) === false
            || class_exists('\WC_Product') === false
        ) {
            return false;
        }

        return true;
    }

    protected static function isWooCommerceProductPage()
    {
        return self::isWooCommerce() && get_post_type() === 'product';
    }

    protected static function getAdapterSet(array $data)
    {
        $string = array();

        foreach ($data as $key => $value) {
            $string[] = 'adapter.attr("wp_' . $key . '", "' . $value . '");';
        }

        return $string;
    }

    protected static function getCartSetRows()
    {
        $wooCommerceCartData = OptiMonkFront::getWooCommerceCartData();

        $string = array();

        foreach ($wooCommerceCartData['cart'] as $cartItem) {
            $string[] = 'adapter.Cart.add("' . $cartItem['sku'] .
                '", {quantity:' . (float)$cartItem['quantity'] .
                ', price:' . (float)$cartItem['price'] .
                '});';
        }

        $string = array_merge($string, self::getAdapterSet($wooCommerceCartData['avs']));

        return $string;
    }
}
