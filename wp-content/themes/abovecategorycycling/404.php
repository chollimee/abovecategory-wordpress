<?php
/**
 * @package Abovecategorycycling
 * @subpackage Black
 */

get_header();
the_post();
?>

  <div id="not-found">

    <div class="content-before text-xs-center">
      <div id="featured">
        <?php
          $attachment_id = get_post_thumbnail_id();
          $attachment_id = 77;
          $img_src = wp_get_attachment_image_url( $attachment_id );
          $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

          $full_src = wp_get_attachment_image_src($attachment_id, 'full', true);
          ?>
          <img src="<?php echo esc_url( $img_src ); ?>"
               srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url($full_src[0]); ?> 2760w"
               sizes="100vw">
      </div>

      <div class="container-acc">
        <div id="heading">
          <h2>THIS PAGE SEEMS TO BE BROKEN</h2>
          <p>LET’S GET YOU WHERE YOU NEED TO GO...</p>
        </div>
      </div>


      <div class="container-acc">
        <form id="form-not-found" role="search" method="get" action="http://loc.abovecategorycycling.com/">
          <div class="input-group search">
            <span class="input-group-addon">
              <i class="fa fa-search"></i>
            </span>
            <input type="text" value="" name="s" id="s" class="form-control" placeholder="SEARCH">
          </div>
        </form>
      </div>

    </div>

    <div class="content-body">
      <div class="contact">
        <?php
          $contact_page = get_page_by_title( "Contact" );
          $post = $contact_page;

          echo get_template_part("content", "contact");
        ?>
      </div>
    </div>

  </div>

<?php get_footer(); ?>
