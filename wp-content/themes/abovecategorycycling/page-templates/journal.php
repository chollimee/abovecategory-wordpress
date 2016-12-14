<?php
/**
 * Template Name: Journal
 *
 * @package Abovecategorycycling
 * @subpackage Black
 */
use Underscore\Types\Arrays;

get_header();
the_post();

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$query_params = array(
  'post_type' => 'journal',
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
        'taxonomy' => 'category',
        'field'    => 'slug',
        'terms'    => $filtered_term
      );
  }
  
  $query_params['tax_query'] = $tax_query;
}

$featured_journal_query = new WP_Query(
  array(
    'post_type' => 'journal'
    )
  );

//$featured_journal = get_field("featured_journal", $featured_journal->ID);
$featured_journal_query->the_post();
$featured_journal = $post;
wp_reset_postdata();

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

<div id="content-journals" class="journals">

  <div class="content-before">
    <div id="bread-crumbs">
      <div class="container-acc">
        <span class="crumb crumb-step2">Journal</span>
      </div>
    </div>
    <div id="featured">
      <div class="featured featured-journal-image text-sm-center content-relative">
         <?php
          $attachment_id = get_post_thumbnail_id($featured_journal->ID);
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
      </div>

      <div class="featured-journal-content">
        <div class="container-acc">
          <div class="row">
            <div class="col-sm-6 content-relative">
              <div class="hidden-sm-down" style="height: 90%; border-right: 1px solid #ededed; position: absolute; right: 0;"></div>
              <h1 class="journal-title"><?php echo get_the_title($featured_journal->ID); ?></h1>
              <div class="journal-meta">
                <div class="clearfix">
                  <div class="pull-sm-left journal-meta-left">
                    <ul>
                      <li>
                        <label>Words:</label>
                        <span><?php echo get_field("words_by", $featured_journal->ID);?></span>
                      </li>
                      <li>
                        <label>Images:</label>
                        <span><?php echo get_field("images_by", $featured_journal->ID);?></span>
                      </li>
                    </ul>
                    
                  </div>

                  <div class="pull-sm-left journal-meta-right">
                    <ul>
                      <li>
                        <label>Posted:</label>
                        <span><?php echo get_the_date('F j, Y', $featured_journal->ID);?></span>
                      </li>
                      <li>
                        <?php $featured_journal_categories = wp_get_post_categories($featured_journal->ID);?>
                        <label>Category:</label>
                        <span><?php echo implode(', ', Arrays::pluck(get_the_category($featured_journal->ID), "name"));?></span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="journal-excerpt">
                <div><?php echo get_the_excerpt($featured_journal->ID);?></div>
              </div>
              <div>
                <a href="<?php echo get_permalink($featured_journal->ID);?>" class="btn btn-info btn-acc pull-sm-right">READ MORE <i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    
    <div id="heading">
      <div class="filter">
        <div class="container-acc">
          <div class="terms block-acc-expand pull-sm-left">
            <span>Category<i class="fa fa-angle-down"></i></span>
            <div class="categories dropdown">
              <?php 
                $terms = get_terms( 'category', array(
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
          <div class="block-acc-expand">
            <span class="results"><?php echo $query->found_posts;?> results</span>
            <?php 
              if(!empty($_GET['terms'])):
            ?>
              <span class="filters">
                <strong class="filter-title">category:</strong>
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
  </div>
  
  <div class="content-body">
    <div class="container-acc">
      <div class="block-acc-expand">

          <?php 
            while ($query->have_posts() ) : $query->the_post();
              get_template_part( 'content', 'journal' );
            endwhile; 
          ?>
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

</div>

<?php
get_footer();
