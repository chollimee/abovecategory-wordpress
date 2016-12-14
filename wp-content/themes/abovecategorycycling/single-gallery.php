<?php
/**
 * @package Abovecategorycycling
 * @subpackage Black
 */

get_header();
the_post();
?>

<div id="content-single-gallery" class="single-gallery">

  <div class="content-before">
    <div id="bread-crumbs">
      <div class="container-acc">

            <span class="crumb crumb-step1">Gallery</span>
            <span class="crumb crumb-angle"><strong class="fa fa-angle-right"></strong></span>
            <span class="crumb crumb-step2"><?php the_title();?></span>

      </div>
    </div>
  </div>
  
  <div class="content-body">
    <div class="container-acc">
      <div class="block-acc-expand">
        <div id="gallery-slider">
     
          <div id="swiper-gallery" class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                  if( have_rows('gallery') ):
                      while ( have_rows('gallery') ) : the_row();
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
                        </div>
                      <?php
                      endwhile;
                  endif;
                ?>
            </div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev icon-round"><i class="fa fa-angle-left"></i></div>
            <div class="swiper-button-next icon-round"><i class="fa fa-angle-right"></i></div>
          </div>
        
        </div> 

        <div id="gallery-thumbnails" class="container-fluid">

          <div class="row">
            <!-- Slides -->
            <?php
              if( have_rows('gallery') ):
                  $image_index = 0;
                  while ( have_rows('gallery') ) : the_row();
                  $image_index ++;
                  ?>
                  <div class="col-sm-3 block-expand">

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

                  </div>
                  <?php
                  if($image_index%4==0){
                    echo "</div><div class='row'>";
                  }
                  
                  endwhile;
              endif;
            ?>

          </div>
        
        </div> 

        <div id="gallery-title">
          <div class="container-acc">
            <h2><?php the_title();?></h2>
          </div>
        </div>

        <div id="gallery-features" class="container-fluid">
          <div class="row">
            
            <div class="col-sm-6 block-expand">
              <ul class="features-left">
                <?php
                  if( have_rows('features_left') ):
                      while ( have_rows('features_left') ) : the_row();
                      ?>

                        <li><i class="fa fa-circle"></i><?php echo get_sub_field('feature');?></li>

                      <?php
                      endwhile;
                  endif;
                ?>
              </ul>
            </div>

            <div class="col-sm-6 block-expand">
              <ul class="features-right">
                <?php
                  if( have_rows('features_right') ):
                      while ( have_rows('features_left') ) : the_row();
                      ?>

                        <li><i class="fa fa-circle"></i><?php echo get_sub_field('feature');?></li>

                      <?php
                      endwhile;
                  endif;
                ?>
              </ul>
            </div>

          </div>
        </div> 

        <?php
          $next_gallery = get_previous_post();
          if(!empty($next_gallery)){
          ?>
          <div id="gallery-next" class="text-xs-center">
            <h2>NEXT GALLERY</h2>
            <div class="text-sm-center content-relative">

               <?php

                    $attachment_id = get_post_thumbnail_id( $next_gallery->ID );
                    
                    if(!$attachment_id){
                      if( have_rows('gallery',  $next_gallery->ID) ):
                          while ( have_rows('gallery',  $next_gallery->ID) ) : the_row( $next_gallery->ID );
                              $attachment_id = get_sub_field('image',  $next_gallery->ID)['id'];
                          endwhile;
                      endif;
                    }

                    $img_src = wp_get_attachment_image_url( $attachment_id );
                    $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

                    $full_src = wp_get_attachment_image_src($attachment_id, 'full', true);
                    ?>
                    <img src="<?php echo esc_url( $img_src ); ?>"
                         srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url($full_src[0]); ?> 2760w"
                         sizes="100vw">

              <div class="content-centered">
                <h1 class="next-title"><?php echo $next_gallery->post_title;?></h1>
                <div class="next-link">
                  <a href="<?php echo get_permalink($next_gallery->ID);?>" class="btn btn-info">GO THERE <i class="fa fa-angle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <?php
          }
        ?>



      </div>

      <div class="actions">
        <a href="#top" id="screen-to-top" class="center icon-round"><i class="fa fa-angle-up"></i></a>
      </div>

    </div>
  </div>
</div>

<script> 

  var swiperGallery = $('#swiper-gallery').swiper({
    // Optional parameters
    direction: 'horizontal',

    // Navigation arrows
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    watchActiveIndex: true,
    onSlideChangeStart : function(swiper){
      $('#gallery-thumbnails .active').removeClass('active');
      $('#gallery-thumbnails .image:eq(' + swiper.activeIndex + ')').addClass('active');
    }
  });   

  $('#gallery-thumbnails .image:eq(0)').addClass('active');

  $('#gallery-thumbnails img').on('click',function(e){
    e.preventDefault()
    var index = _.indexOf($('#gallery-thumbnails img').toArray(),this);
    swiperGallery.slideTo ( index );
  });

</script>

<?php
get_footer(); ?>