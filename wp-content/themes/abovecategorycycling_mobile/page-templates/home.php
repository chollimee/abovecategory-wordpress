<?php
/**
 * Template Name: Home
 *
 * @package Abovecategorycycling
 * @subpackage Black
 */

get_header();
the_post();
?>

  <div id="home-page">

    <div id="content">
      <div id="home-slider">
     

        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                  if( have_rows('slides') ):
                      while ( have_rows('slides') ) : the_row();
                      ?>
                        <div class="swiper-slide">
                          <div class="image">
                            <?php
                            $attachment_id = get_sub_field('image')['id'];
                            $img_src = wp_get_attachment_image_url( $attachment_id );
                            $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

                            ?>
                            <img src="<?php echo esc_url( $img_src ); ?>"
                                 srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url( get_sub_field('image')['url'] ); ?> 2760w"
                                 sizes="100vw">
                          </div>
                          <div class="caption">
                            <h2 class="caption-heading"><?php echo get_sub_field('caption_heading'); ?></h2>
                            <p class="caption-text"><?php echo get_sub_field('caption_text'); ?></p>
                            <p class="caption-link"><a href="<?php echo get_sub_field('caption_link'); ?>">READ MORE</a></p>
                          </div>
                          
                        </div>
                      <?php
                      endwhile;
                  endif;
                ?>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
            
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>
        
      </div>
    </div>

  </div>

  <script>        
  var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    
    // If we need pagination
    pagination: '.swiper-pagination',
    
    // Navigation arrows
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
  })        
  </script>

<?php get_footer(); ?>
