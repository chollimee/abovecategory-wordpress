<?php
/**
 * @package Abovecategorycycling
 * @subpackage Black
 */
use Underscore\Types\Arrays;
get_header();
the_post();
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=264298037099456";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="content-single-journal" class="single-journal">

  <div class="content-before">
    <div id="bread-crumbs">
      <div class="container-acc">

            <span class="crumb crumb-step1">Journal</span>
            <span class="crumb crumb-angle"><strong class="fa fa-angle-right"></strong></span>
            <span class="crumb crumb-step2"><?php the_title();?></span>

      </div>
    </div>

    <div id="featured" class="featured content-relative text-sm-center">

       <?php
        $attachment_id = get_post_thumbnail_id();
        $img_src = wp_get_attachment_image_url( $attachment_id );
        $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

        $full_src = wp_get_attachment_image_src($attachment_id, 'full', true);
        ?>
        <img class="content-centered-md-down" src="<?php echo esc_url( $img_src ); ?>"
             srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url($full_src[0]); ?> 2760w"
             sizes="100vw">

        <div class="content-centered-vertical content-full-width">
          <h1 class="featured-title"><?php the_title();?></h1>
          <div class="content-relative">
            <a href="#journal-content-body" id="screen-to-bottom" class="content-centered-horizontal icon-round scroll-to"><i class="fa fa-angle-down"></i></a>
          </div>
        </div>
    </div>


    <div class="container-narrow">
          <div class="journal-meta clearfix">
            <div class="pull-sm-left journal-meta-left content-relative">
              <div class="hidden-sm-down" style="height: 90%; border-right: 1px solid #ededed; position: absolute; right: 0;"></div>

              <ul>
                <li>
                  <label>Words:</label>
                  <span><?php echo get_field("words_by");?></span>
                </li>
                <li>
                  <label>Images:</label>
                  <span><?php echo get_field("images_by");?></span>
                </li>
              </ul>
              
            </div>

            <div class="pull-sm-left journal-meta-right">
              <ul>
                <li>
                  <label>Posted:</label>
                  <span><?php echo get_the_date('F j, Y', $post->ID);?></span>
                </li>
                <li>
                  <?php $featured_journal_categories = wp_get_post_categories();?>
                  <label>Category:</label>
                  <span><?php echo implode(', ', Arrays::pluck(get_the_category(), "name"));?></span>
                </li>
              </ul>
            </div>
          </div>
    </div>

  </div>
  
  <div class="content-body" id="journal-content-body">
    <?php the_content(); ?> 
  </div>
  <div class="container-narrow">
    <div class="text-sm-center share-buttons">
      <div class="share-this-story-label">SHARE THIS STORY</div>
      <div class="addthis_inline_share_toolbox_t2sj"></div>
    </div>
  </div>
  <div class="container-narrow">
    <div class="comments">
      <div class="fb-comments" data-href="<?php echo get_permalink();?>" data-width="100%" data-numposts="3"></div>
    </div>
  </div>

  <?php
  $next_journal = get_previous_post();
  if(!empty($next_journal)){
  ?>
  <div class="journal-next text-xs-center">

    <h2 class="container-acc-expand">NEXT JOURNAL</h2>
    <div class="text-sm-center content-relative next-image">

       <?php

            $attachment_id = get_post_thumbnail_id( $next_journal->ID );
            $img_src = wp_get_attachment_image_url( $attachment_id );
            $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

            $full_src = wp_get_attachment_image_src($attachment_id, 'full', true);
            ?>
            <img class="content-centered" src="<?php echo esc_url( $img_src ); ?>"
                 srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url($full_src[0]); ?> 2760w"
                 sizes="100vw">

      <div class="content-centered-vertical">
        <h1 class="next-title"><?php echo $next_journal->post_title;?></h1>
        <div class="next-link">
          <a href="<?php echo get_permalink($next_journal->ID);?>" class="btn btn-info">GO THERE <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
?>
</div>
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53aaf0275b415e45"></script> 

<?php
get_footer();
?>