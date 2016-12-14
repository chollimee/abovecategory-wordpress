
  <div class="journal">
    <div class="row">
      <div class="col-sm-6">
        <div class="content-block">
          <div class="journal-featured-image">
            <?php
                $attachment_id = get_post_thumbnail_id();
                $img_src = wp_get_attachment_image_url( $attachment_id );
                $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

                $full_src = wp_get_attachment_image_src($attachment_id, 'full', true);
                ?>
                <img src="<?php echo esc_url( $img_src ); ?>"
                     srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url($full_src[0]); ?> 2760w"
                     sizes="100vw">
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="content-block">
          <div class="journal-title">
            <h2><?php the_title();?></h2>
          </div>

          <div class="journal-excerpt">
          <?php the_excerpt(); ?>
          </div>

          <div class="journal-action clearfix">
            <a href="<?php echo get_permalink($post->ID);?>" class="btn btn-info btn-acc pull-sm-right">READ MORE <i class="fa fa-angle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
