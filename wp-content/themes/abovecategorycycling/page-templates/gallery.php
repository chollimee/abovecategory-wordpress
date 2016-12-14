<?php
/**
 * Template Name: Gallery
 *
 * @package Abovecategorycycling
 * @subpackage Black
 */

get_header();
the_post();

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$query_params = array(
  'post_type' => 'gallery', 
  'paged' => $paged 
  );

if(isset($_GET['orderby']) && !empty($_GET['orderby']))
{
  $query_params['orderby'] = $_GET['orderby'];
}

if(isset($_GET['order']) && !empty($_GET['order']))
{
  $query_params['order'] = $_GET['order'];
}

if(isset($_GET['terms']) && !empty($_GET['terms']))
{

  $tax_query = array('relation'=>'OR');
  $filtered_terms = explode(',', $_GET['terms']);

  foreach($filtered_terms as $filtered_term)
  {
    $tax_query[] = array(
        'taxonomy' => 'brand',
        'field'    => 'slug',
        'terms'    => $filtered_term
      );
  }
  
  $query_params['tax_query'] = $tax_query;
}

$query = new WP_Query( $query_params );

?>
<script>
  var Filter = require("scripts/Filter.js");
  Filter.initialize("<?php echo get_permalink();?>", { 
    filter: "<?php echo $_GET["terms"];?>", 
    orderby: "<?php echo $_GET["orderby"]?>", 
    order: "<?php echo $_GET["order"]?>"
  });
</script>

<div id="content-galleries" class="galleries">

  <div class="content-before">
    <div id="bread-crumbs">
      <div class="container-acc">
        <span class="crumb crumb-step2">Gallery</span>
      </div>
    </div>
    <div id="featured" class="featured text-sm-center content-relative">

         <?php

          $attachment_id = get_post_thumbnail_id();
          $img_src = wp_get_attachment_image_url( $attachment_id );
          $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

          $full_src = wp_get_attachment_image_src($attachment_id, 'full', true);
          ?>
          <img class="content-centered-md-down" src="<?php echo esc_url( $img_src ); ?>"
               srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url($full_src[0]); ?> 2760w"
               sizes="100vw">

          <h1 class="featured-title content-centered"><?php echo get_the_excerpt()?></h1>
    </div>

    
    <div id="heading">
      <div class="filter">
        <div class="container-acc">
            <div class="terms block-acc-expand pull-sm-left">
              <span>Refine By Brand<i class="fa fa-angle-down"></i></span>
              <div class="brands dropdown">
                <?php 
                  $terms = get_terms( 'brand', array(
                      'hide_empty' => false,
                  ) );

                  foreach($terms as $term):
                ?>
                  <a href="javascript: Filter.add_filter_and_redirect('<?php echo $term->name;?>');"><?php echo $term->name;?></a>
                <?php 
                endforeach;
                ?>
              </div>
            </div>
            <div class="sort pull-sm-right">
              <span>Sort<i class="fa fa-angle-down"></i></span>
              <div class="sort-items dropdown">
                <a href="javascript: Filter.sort_and_redirect('date', 'DESC')">Newest</a>
                <a href="javascript: Filter.sort_and_redirect('author', 'DESC')">Author (A-Z)</a>
              </div>
            </div>
        </div>
      </div>
      <div class="heading-results">
        <div class="container-acc">
          <span class="results"><?php echo $query->found_posts;?> results</span>
          <?php 
            if(!empty($_GET['terms'])):
          ?>
            <span class="filters">
              <strong class="filter-title">brand:</strong>
              <?php 
                $filtered_terms = explode(',', $_GET['terms']);

                foreach($filtered_terms as $filtered_term)
                {
                ?>
                  <span class="filter-bage"><?php echo $filtered_term?> <a href="javascript: Filter.remove_filter_and_redirect('<?php echo $filtered_term;?>');" class="filter-close">&nbsp;</a></span>
                <?php
                }
              ?>
            </span>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  
  <div class="content-body">
    <div class="container-acc">
      <div class="block-acc-expand">
        <div class="row">
          <?php 
            while ($query->have_posts() ) : $query->the_post();
            ?>
              <div class="col-md-6">
                <?php
                  get_template_part( 'content', 'gallery' );
                ?>
              </div>
            <?php
            endwhile; 
          ?>
        </div>
      </div>
    </div>
    <div class="pagination text-xs-center">
    <?php
      $big = 999999999; // need an unlikely integer

      echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'prev_text'=>"PREVIOUS",
        'next_text'=>"NEXT",
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $query->max_num_pages
      ) );
      ?>
    </div>
    <?php wp_reset_postdata(); ?>
  </div>

  <div class="actions content-relative">
    <a href="#top" id="screen-to-top" class="center icon-round"><i class="fa fa-angle-up"></i></a>
  </div>
</div>

<?php
get_footer();
