<?php
require __DIR__ . '/vendor/autoload.php';
require_once('lib/wp_bootstrap_navwalker.php');
require_once('api.php');

use Underscore\Types\Arrays;

function register_acc_nav_menus()
{
  register_nav_menus( array(
    'main_navigation_menu' => 'Main Navigation Menu',
  ) );
}

function register_acc_post_types_and_taxonomies(){
  //demo bikes
  $args = array(
    'public' => true,
    'label'  => 'Demo Bikes',
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
  );
  register_post_type( 'demo_bike', $args );

  //galleries
  $args = array(
    'public' => true,
    'label'  => 'Galleries',
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
  );
  register_post_type( 'gallery', $args );

  register_taxonomy(
    'brand',
    'gallery',
    array(
      'label' => __( 'Brands' ),
      'rewrite' => array( 'slug' => 'brand' ),
      'hierarchical' => true,
    )
  );

  //journals
  $args = array(
    'public' => true,
    'label'  => 'Journals',
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
  );
  register_post_type( 'journal', $args );

  register_taxonomy(
    'category',
    'journal',
    array(
      'label' => __( 'Categories' ),
      'rewrite' => array( 'slug' => 'category' ),
      'hierarchical' => true,
    )
  );

  //products
  $args = array(
    'public' => true,
    'label'  => 'Products',
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
  );
  register_post_type( 'product', $args );

  //product map
  $args = array(
    'public' => true,
    'label'  => 'Products Shows',
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
  );
  register_post_type( 'products_show', $args );


  //product reviews
  $args = array(
    'public' => true,
    'label'  => 'Product Reviews',
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
  );
  register_post_type( 'product_review', $args );

  register_taxonomy(
    'review_type',
    'product_review',
    array(
      'label' => __( 'Review Types' ),
      'rewrite' => array( 'slug' => 'review_type' ),
      'hierarchical' => true,
    )
  );
  
  // bikes
  $args = array(
    'public' => true,
    'label'  => 'Bikes',
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
  );
  register_post_type( 'bike', $args );

  register_taxonomy(
    'bike_category',
    'bike',
    array(
      'label' => __( 'Bike Categories' ),
      'rewrite' => array( 'slug' => 'bike_category' ),
      'hierarchical' => true,
    )
  );

  flush_rewrite_rules();
}

function enqueue_site_scripts()
{
	wp_enqueue_style('acc-black-style',  get_template_directory_uri() . '/html/css/app.css');
  wp_enqueue_style('acc-main-style',  get_template_directory_uri() . '/style.css');

  wp_enqueue_script('acc-vendor-script',  get_template_directory_uri() . '/html/js/vendor.js');
  wp_enqueue_script('acc-black-script',  get_template_directory_uri() . '/html/js/app.js');
  wp_enqueue_script('acc-main-script',  get_template_directory_uri() . '/script.js');
}

function abovecategorycycling_init() {
  register_acc_post_types_and_taxonomies();
  register_acc_nav_menus();

  add_theme_support( 'post-thumbnails');
  add_post_type_support( 'page', 'excerpt' );
}


function remove_page_fields() {
  remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' );
  remove_meta_box( 'commentsdiv' , 'page' , 'normal' );
  remove_meta_box( 'authordiv' , 'page' , 'normal' ); 
}

function add_acc_metaboxes(){
  add_meta_box('acc_product_position_above_photo', 'Product Position', 'acc_product_position_above_photo', 'products_show', 'normal', 'default');
}

add_action('acf/input/admin_footer', 'acc_product_position_above_photo');

function acc_product_position_above_photo()
{

  ?>
    <script>
      var ProductsShow = require('admin/scripts/ProductsShow.js');
      ProductsShow.initialize();
    </script>
    <p><a href="javascript:ProductsShow.add_product();" id="add-product-to-show"><i class="fa fa-plus"></i> Add Product With Current Position</a></p>

    <p>
      <strong>Point X:</strong> <span id="point_x">0</span>,
      <strong>Point Y:</strong> <span id="point_y">0</span>
    </p>
  <?php
}

function enqueue_admin_scipts($hook) {

  global $post;

  if($hook!='post.php' && $hook!='edit.php')
  {
    return;
  }

  if($post->post_type == 'products_show'){
    wp_enqueue_script( 'acc-admin-script', get_template_directory_uri() . '/html/js/admin.js' );
    wp_enqueue_style( 'acc-admin-style', get_template_directory_uri() . '/html/css/admin.css' );
  }
}

add_filter('show_admin_bar', '__return_false');
add_action( 'admin_menu' , 'remove_page_fields' );
add_action('wp_enqueue_scripts', 'enqueue_site_scripts');
add_action('init', 'abovecategorycycling_init');
add_action('add_meta_boxes', 'add_acc_metaboxes');
add_action( 'admin_enqueue_scripts', 'enqueue_admin_scipts' );


// short code goes right here
function productshow_func( $atts ) {
  $atts = shortcode_atts( array("id"=>"-1"), $atts, 'productshow' );
  $productshow = get_post($atts["id"]);

  $attachment_id = get_field('image', $productshow->ID)['id'];
  $img_src = wp_get_attachment_image_url( $attachment_id );
  $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

  ob_start();

  ?>
  <div class="product-show product-show<?php echo $productshow->ID; ?>">
    <img src="<?php echo esc_url( $img_src ); ?>"
         srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url( get_field('image', $productshow->ID)['url'] ); ?> 2760w"
         sizes="100vw">

    <?php while ( have_rows('products', $productshow->ID) ) : the_row($productshow->ID); 
          $left = get_sub_field('point_x');
          $top = get_sub_field('point_y');

          $product = get_sub_field('product');
    ?>

      <a class="product-marker" href="#product<?php echo $product->ID?>" style="left: <?php echo $left; ?>%; top: <?php echo $top; ?>%;"></a>

      <div class="product" id="product<?php echo $product->ID?>">
        <div class="product-image">
          <a href="<?php echo get_field('checkout_link', $product->ID);?>"><img src="<?php echo get_field('image', $product->ID)['url'];?>"></a>
        </div>
        <div class="product-title">
          <a href="<?php echo get_field('checkout_link', $product->ID);?>"><?php echo $product->post_title;?></a>
        </div>
        <div class="product-description">
          <?php echo get_field('description', $product->ID);?>
        </div>
        <div class="product-price">
          $<?php echo get_field('price', $product->ID);?>
        </div>
      </div>
    <?php endwhile; ?>

    <script>
      var ProductShow = require("scripts/ProductShow.js");
      ProductShow.initialize();
    </script>
  </div>

  <?php
  $output = ob_get_contents();
  ob_clean();

  return $output;
?>
  
<?php
}

function get_url_content($url) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

add_shortcode( 'productshow', 'productshow_func' );