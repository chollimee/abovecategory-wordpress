
  <div class="gallery">

      <div class="gallery-featured-image">
        <?php
            $attachment_id = get_post_thumbnail_id();

            if(!$attachment_id){
              if( have_rows('gallery') ):
                  while ( have_rows('gallery') ) : the_row();
                      $attachment_id = get_sub_field('image')['id'];
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
      </div>

      <div class="gallery-title">
        <h3><?php the_title();?></h3>
      </div>

      <div class="gallery-action">
        <a href="<?php echo get_permalink($post->ID);?>" class="btn btn-info">View Gallery <i class="fa fa-angle-right"></i></a>
      </div>
  </div>
