  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="bike">
        <div class="content-block">
          <div class="bike-image">
            <?php
                $attachment_id = get_field('category_image')['id'];
                $img_src = wp_get_attachment_image_url( $attachment_id );
                $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

                $full_src = wp_get_attachment_image_src($attachment_id, 'full', true);
                ?>
                 <a href="<?php echo get_permalink($post->ID);?>"><img src="<?php echo esc_url( $img_src ); ?>"
                     srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url($full_src[0]); ?> 2760w"
                     sizes="100vw"></a>
          </div>

          <div class="bike-title">
            <a href="<?php echo get_permalink($post->ID);?>"><?php the_title();?></a>
          </div>

          <div class="bike-brand">
          <?php 
            $terms = wp_get_post_terms($post->ID, 'bike_category');
            $terms = wp_list_pluck($terms, 'name');
            echo join(',', $terms);
          ?>
          </div>

        </div>
      </div>
  </div>
