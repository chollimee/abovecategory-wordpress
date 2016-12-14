<?php
/**
 * Template Name: Contact
 *
 * @package Abovecategorycycling
 * @subpackage Black
 */

get_header();
the_post();

?>
<div id="content-contact" class="contact">

  <div class="content-before">
    <div id="bread-crumbs">
      <div class="container-acc">

        <span class="crumb crumb-step1">About</span>
        <span class="crumb crumb-angle"><strong class="fa fa-angle-right"></strong></span>
        <span class="crumb crumb-step2">Contact</span>

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

    </div>
  </div>
  
  <div class="content-body">
    <?php echo get_template_part("content", "contact"); ?>
  </div>
</div>

<?php
get_footer();
