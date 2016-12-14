<?php
/**
 * Template Name: Demo Bikes
 *
 * @package Abovecategorycycling
 * @subpackage Black
 */

get_header();
the_post();

?>
<div id="content-demo-bokes" class="demo-bikes">

  <div class="content-before">
    <div id="featured" class="featured text-sm-center content-relative">

         <?php
          $attachment_id = get_post_thumbnail_id();
          $img_src = wp_get_attachment_image_url( $attachment_id );
          $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

          $full_src = wp_get_attachment_image_src($attachment_id, 'full', true);
          ?>
          <img src="<?php echo esc_url( $img_src ); ?>"
               srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url($full_src[0]); ?> 2760w"
               sizes="100vw" class="content-centered-md-down">

    </div>

    
    <div id="heading">
      <div class="container-acc">
        <div class="heading-title">
      
          <div class="row">
            <div class="col-xs-12 text-xs-center">
              <div class="block">
                <h2>AC DEMO PROGRAM</h2>
                <p>LOREM IPSUM RUBBER HITS ERE ETHOS LITHIUM VISCUM</p>
              </div>
            </div>
          </div>

        </div>
        
        <div class="heading-text text-normal hidden-sm-down">

          <div class="row">
            <div class="col-sm-6 col-xs-12">
              <div class="block-expand-right" style="padding-right: 3rem;">
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac tortor condimentum, euismod ante eu,euismod nulla. Maecenas pulvinaro lutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellenvers tesque ac tortor condimentum, euismod ante eu, euismod nulla. Maecenas pulvinar volutpat. I’m keeping this going right here to show that the parben graph can continue over on the other side of this page I’m almost there je couple more you did it Tony good job now this good job now this page I’m almost there just a couple 
                </p>
              </div>
            </div>

            <div class="col-sm-6 col-xs-12">
              <div class="block-expand-left" style="padding-left: 3rem;">
              <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac tort condimentum, euismod ante eu,euismod nulla. Maecenas pulvinar volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac mo condimentum, euismod ante eu, euismod nulla. Maecenas pulvinar volutpat. I’m keeping this going right here to show that the paragraph.
              </p>

              <a href="#" class="reserve-bike-link">RESERVE YOUR DREAM BIKE</a>
              </div>
            </div>
          </div>

        </div>


        <div class="heading-text text-normal hidden-md-up">

          <div class="row">
            <div class="col-xs-12">
              <div class="block">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac tortor condimentum, euismod ante eu,euismod nulla. Maecenas pulvinaro lutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellenvers tesque ac tortor condimentum, euismod ante eu, euismod nulla. Maecenas pulvinar volutpat. I’m keeping this going right here to show that the parben graph can continue over on the other side of this page I’m almost there je couple more you did it Tony good job now this good job now this page I’m almost there just a couple 
              </div>
            </div>

            <div class="col-xs-12">
              <div class="block">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac tort condimentum, euismod ante eu,euismod nulla. Maecenas pulvinar volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac mo condimentum, euismod ante eu, euismod nulla. Maecenas pulvinar volutpat. I’m keeping this going right here to show that the paragraph.
              <a href="#" class="reserve-bike-link">RESERVE YOUR DREAM BIKE</a>
              </div>
            </div>
          </div>

        </div>


      </div>
    </div>
  </div>
  
  <div class="content-body">
    <?php 
      $args = array('post_type' => 'demo_bike');
      $query = new WP_Query( $args );
      while ($query->have_posts() ) : $query->the_post();

        get_template_part( 'content', 'demo-bike' );

      endwhile; 
    wp_reset_postdata(); ?>
  </div>
</div>

<?php
get_footer();
