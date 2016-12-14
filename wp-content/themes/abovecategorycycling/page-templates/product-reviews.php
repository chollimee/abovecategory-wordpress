<?php
/**
 * Template Name: Product Reviews
 *
 * @package Abovecategorycycling
 * @subpackage Black
 */
use Underscore\Types\Arrays;

$post_ids = array();

// get ac reviews
if(isset($_GET['shopify_product_id']))
{
  $product_posts = get_posts(array(
  'post_type' => 'product',
  'meta_key' => 'shopify_id',
  'meta_value' => $_GET['shopify_product_id']
  ));

  $post_ids = Arrays::pluck($product_posts, 'ID');
}

if(isset($_GET['product_id']))
{
  $post_ids[] = $_GET['product_id'];
}

if(isset($_GET['bike_id']))
{
  $post_ids[] = $_GET['bike_id'];
}

$query = null;

if(isset($_GET['term']))
{
  $term = $_GET['term'];
  $query = new WP_Query(array(
  'post_type' => array('product_review','journal'),
  'meta_key' => 'product',
  'meta_value' => $post_ids,
  'tax_query' => array(
    'relation'=>'OR',
    array(
      'taxonomy'=>'category',
      'terms'=>$term,
      'field'=>'slug',
      'operator'=>'IN'
      ),
    array(
      'taxonomy'=>'review_type',
      'terms'=>$term,
      'field'=>'slug',
      'operator'=>'IN'
      )
    )
  ));
}else{
  $query = new WP_Query(array(
  'post_type' => array('product_review','journal'),
  'meta_key' => 'product',
  'meta_value' => $post_ids,
  'tax_query' => array(
    'relation'=>'OR',
    array(
      'taxonomy'=>'category',
      'terms'=>$term,
      'field'=>'slug',
      'operator'=>'IN'
      ),
    array(
      'taxonomy'=>'review_type',
      'terms'=>$term,
      'field'=>'slug',
      'operator'=>'IN'
      )
    )
  ));
}

get_header();
?>
<div class="product-reviews">
  <div id="featured" class="featured content-relative text-sm-center">
     <?php
      $attachment_id = get_post_thumbnail_id($post_ids[0]);
      if(!$attachment_id)
      {
        $attachment_id = get_field('default_featured_image', 'option', false);
      }

      $img_src = wp_get_attachment_image_url( $attachment_id );
      $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

      $full_src = wp_get_attachment_image_src($attachment_id, 'full', true);
      ?>
      <img class="content-centered-md-down" src="<?php echo esc_url( $img_src ); ?>"
           srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url($full_src[0]); ?> 2760w"
           sizes="100vw">

      <div class="content-centered-vertical content-full-width">
        <h1 class="featured-title">
          <?php if(count($post_ids) > 0 ):?>
            <?php echo get_the_title($post_ids[0]);?> Reviews</h1>
          <?php else: ?>
            <?php echo get_the_title();?></h1>
          <?php endif;?>
      </div>
  </div>

  <div class="container-acc">
    <?php
        while ($query->have_posts() ) : $query->the_post();

          get_template_part( 'content', 'single' );

        endwhile;
    ?>
  </div>
</div>
<?php
get_footer();
