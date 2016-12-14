<?php
/**
 * @package Abovecategorycycling
 * @subpackage Black
 */

get_header();
the_post();

$term = get_term(get_field('brand'));
?>
<div id="content-single-bike" class="single-bike">

  <div class="content-before">
    <div id="bread-crumbs">
      <div class="container-acc">

            <span class="crumb crumb-step1"><a href="/bikes?category=<?php echo strtolower($term->name); ?>"><?php echo $term->name; ?></a></span>
            <span class="crumb crumb-angle"><strong class="fa fa-angle-right"></strong></span>
            <span class="crumb crumb-step2"><?php the_title();?></span>

      </div>
    </div>
  </div>
  
  <div class="content-body">

        <div class="featured content-relative">
<div id="bike-slider">
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
                    
                  </div>
                <?php
                endwhile;
            endif;
          ?>
      </div>
      <!-- If we need pagination -->
      <div class="swiper-pagination"></div>
      
      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
      <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
  </div>
  
</div>
        </div>

<script>        
var bikeSwiper = new Swiper ('#bike-slider .swiper-container', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  
  // If we need pagination
  pagination: '.swiper-pagination',
  paginationClickable: true,

  preventClicksPropagation: false,
  preventClicks: false,
  
  // Navigation arrows
  nextButton: '.swiper-button-next',
  prevButton: '.swiper-button-prev'
})        
</script>


        <div class="inquire">
          <div class="container-acc">
            <div class="row">
              <div class="col-xl-7">
                <a class="btn btn-info btn-acc" href="mailto:sales@abovecategorycycling.com?subject=Inquire <?php the_title();?>">INQUIRE</a>
              </div>
              <div class="col-xl-5">
                <div class="col-right">
                  <script>
                  $(document).ready(function(){
                    $('ul.tabs li').click(function(){
                      var tab_id = $(this).attr('data-tab');
                      $('ul.tabs li').removeClass('current');
                      $('.tab-content').removeClass('current');
                      $(this).addClass('current');
                      $("#"+tab_id).addClass('current');
                    });
                  });
                  </script>
                  <ul class="tabs">
                    <li class="tab-link text-xs-left current" data-tab="tab-1">
                      <span class="tab-label">
                        <span>Description</span>
                        <span class="bottom-bar"></span>
                      </span>
                    </li>
                    <li class="tab-link text-xs-center" data-tab="tab-2">
                      <span class="tab-label">
                        <span>Sizing</span>
                        <span class="bottom-bar"></span>
                      </span>
                    </li>
                    <li class="tab-link text-xs-right" data-tab="tab-3">
                      <span class="tab-label">
                        <span>Articles</span> &amp; <span>Reviews</span>
                        <span class="bottom-bar"></span>
                      </span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tab-contents">
          <div id="tab-1" class="tab-content current">
            <div class="container-acc">
              <h1><?php the_title(); ?></h1>
              <div class="row">
                <div class="col-xl-7">
                  <?php the_content(); ?>
                </div>
                <div class="col-xl-5">
                  <div class="col-right">
                    <?php if( have_rows('features') ): ?>
                      <ul>
                      <?php while ( have_rows('features') ) : the_row(); ?>
                        <li><?php echo get_sub_field('feature');?></li>
                      <?php endwhile; ?>
                      </ul>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="tab-2" class="tab-content">
            <div class="container-acc">
              <?php echo get_field('sizing');?>
            </div>
          </div>

          <div id="tab-3" class="tab-content">
            <?php 
             $reviews = get_product_reviews(array('bike_id'=>$post->ID));
            ?>
            <div id="product-reviews">
              <div class="container-acc">
                <div class="row">
                  <?php if(count($reviews['ac']) > 0 || count($reviews['media']) > 0 ): ?>
                    <div class="col-md-6">
                      <h1>OUR TAKE</h1>
                      <?php foreach($reviews['ac'] as $item):?>
                      <div class="items ac col-expand-left">
                        <h2><?php echo $item->post_title?></h2>
                        <p><?php echo $item->post_excerpt?></p>
                        <p clalss="text-sm-right">
                          <a href="<?php echo $item->link;?>" class="btn btn-info btn-acc">READ MORE <i class="fa fa-angle-right"></i></a>
                        </p>
                      </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="col-md-6">
                      <h1>Media Reviews</h1>
                      <?php foreach($reviews['media'] as $item):?>
                      <div class="items media col-expand-right">
                        <h2><?php echo $item->post_title?></h2>
                        <p><?php echo $item->post_excerpt?></p>
                        <p clalss="text-sm-right">
                          <a href="<?php echo $item->link;?>" class="btn btn-info btn-acc">READ MORE <i class="fa fa-angle-right"></i></a>
                        </p>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  <?php else: ?>
                    <div class="col-sm-12">
                      <p>There is no reviews yet.</p>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="lifestyles">
     
          <div id="lifestyle-slider" class="swiper-container content-relative">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                  if( have_rows('images') ):
                      while ( have_rows('images') ) : the_row();
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

            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
            
            <div class="swiper-buttons content-centered-vertical">
              <div class="container">
                <div class="content-relative">
                  <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
                  <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                </div>
              </div>
            </div>
          </div>
        
        </div>
  </div>
  <div class="actions content-relative">
    <a href="#top" id="screen-to-top" class="center icon-round"><i class="fa fa-angle-up"></i></a>
  </div>
</div>

<script> 

  var swiperGallery = $('#lifestyle-slider').swiper({
    // Optional parameters
    direction: 'horizontal',

    // If we need pagination
    pagination: '.swiper-pagination',
    paginationClickable: true,

    // Navigation arrows
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    watchActiveIndex: true
  });

  var App = require('scripts/App.js');

  $('.btn-zoom').click(function(){
    App.open_zoom('#featured-image');
  });
</script>

<?php
get_footer(); ?>