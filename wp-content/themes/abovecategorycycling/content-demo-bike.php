<div class="demo-bike">
  <div class="container-acc">

          

      <div class="row">
        <div class="col-sm-6 col-lg-7 col-xl-8">
          <div class="bike-image">
            <?php
              $attachment_id = get_field('image')['id'];
              $img_src = wp_get_attachment_image_url( $attachment_id );
              $img_srcset = wp_get_attachment_image_srcset( $attachment_id );
            ?>
            <img src="<?php echo esc_url( $img_src ); ?>"
                 srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url( get_field('image')['url'] ); ?> 2760w"
                 sizes="100vw" width="100%">
          </div>
        </div>

        <div class="col-sm-6 col-lg-5 col-xl-4">
          <div class="bike-title">
            <h3><?php the_title();?></h3>
          </div>
          <div class="bike-features">
            <?php
                if( have_rows('features') ):
                    while ( have_rows('features') ) : the_row();
                    ?>
                      <div class="bike-feature">
                        <i class="fa fa-circle"></i><?php echo get_sub_field('feature'); ?>
                      </div>
                    <?php
                    endwhile;
                endif;
            ?>
          </div>
          <div class="bike-book">
            <a href="#" class="btn btn-info">BOOK NOW <i class="fa fa-angle-right"></i></a>
          </div>
        </div>
      </div>

  </div>
</div>
