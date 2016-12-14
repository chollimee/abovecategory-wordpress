<?php
/**
 * Template Name: Bikes
 *
 * @package Abovecategorycycling
 * @subpackage Black
 */
use Underscore\Types\Arrays;

get_header();
the_post();

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$query_params = array(
  'post_type' => 'bike',
  'paged' => $paged 
  );

$filtered_terms = [];

$category = '';

if(isset($_GET['category']) && !empty($_GET['category']))
{
  $category = strtolower($_GET['category']);
}

if(isset($_GET['terms']) && !empty($_GET['terms']))
{

  $tax_query = array('relation'=>'OR');
  $filtered_terms = explode(',', $_GET['terms']);

  foreach($filtered_terms as $filtered_term)
  {
    $tax_query[] = array(
        'taxonomy' => 'bike_category',
        'field'    => 'slug',
        'terms'    => $filtered_term
      );
  }
  
  $query_params['tax_query'] = $tax_query;
}else{
  
}

$terms = get_terms( 'bike_category', array('hide_empty' => false) );
$filtered_terms = Arrays::pluck($terms, "name");

$query = new WP_Query( $query_params );
?>

<script>
  var Filter = require("scripts/Filter.js");
  Filter.initialize("<?php echo get_permalink();?>", { 
    filter: "<?php echo $_GET["terms"];?>", 
    orderby: "<?php echo $_GET["orderby"]?>", 
    order: "<?php echo $_GET["order"]?>"
  });

  var category = '<?php echo $category; ?>';

  jQuery(function($){
    if(category!='')
    {
      App.scrollTo('#' + category);
    }
  });
</script>

<div id="content-bikes" class="bikes">

  <div class="content-before">
    <div id="featured">
      <div class="featured featured-journal-image content-relative featured-xl-down">
         <?php

          $featured_journal = get_field("featured_journal");
          $attachment_id = get_post_thumbnail_id($featured_journal);
          $img_src = wp_get_attachment_image_url( $attachment_id );
          $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

        $full_src = wp_get_attachment_image_src($attachment_id, 'full', true);
        ?>
          <img class="content-centered-xl-down" src="<?php echo esc_url( $img_src ); ?>"
               srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url($full_src[0]); ?> 2760w"
               sizes="100vw">
          <div class="content-centered-vertical">
            <div class="container-acc">
              <div class="featured-content">
              <?php the_content();?>
              <div class="content-relative">
                <a href="#bottom" id="screen-to-bottom" class="content-centered-horizontal icon-round"><i class="fa fa-angle-down"></i></a>
              </div>
              </div>
            </div>
          </div>
      </div>

      <div id="bread-crumbs">
        <div id="page-title" class="container-acc">
          <span class="crumb">BICYCLES</span>
        </div>
      </div>
    </div>

    
    <div id="heading">
      <div class="filter">
        <div class="container-acc">
            <div class="categories hidden-md-down">
              <div class="list">
                <?php 
                  $terms = get_terms( 'bike_category', array(
                      'hide_empty' => false,
                  ) );

                  foreach($terms as $term):
                ?>
                  <span><a class="ac-link scroll-to" href="#<?php echo strtolower($term->name);?>"><?php echo $term->name;?></a></span>
                <?php 
                endforeach;
                ?>
              </div>
            </div>


            <h3 class="hidden-lg-up">Brand</h3>
            <div class="categories terms hidden-lg-up">
              <span>Select<i class="fa fa-angle-down"></i></span>
              <div class="sort-items dropdown">
                <?php foreach($terms as $term): ?>
                  <a class="ac-link scroll-to" href="#<?php echo $term->name;?>"><?php echo $term->name;?></a>
                <?php endforeach; ?>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="content-body">
    <div class="container-acc">
          <?php 
          foreach($filtered_terms as $filtered_term)
          {
            $tax_query = [];
            $tax_query[] = array(
                'taxonomy' => 'bike_category',
                'field'    => 'slug',
                'terms'    => $filtered_term
              );
            $query_params['tax_query'] = $tax_query;
            $query = new WP_Query( $query_params );

            $category = get_term_by('name', $filtered_term, 'bike_category');
            include(locate_template('content-bike-category.php'));

            wp_reset_postdata();
          }
          ?>
    </div>
  </div>

</div>
<?php
get_footer();
