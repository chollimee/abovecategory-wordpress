<?php
the_post();
get_header(); ?>
<div class="product-review">
  <div id="featured" class="featured content-relative text-sm-center">
       <?php
        $attachment_id = get_post_thumbnail_id();
        if(!$attachment_id)
        {
          $attachment_id = get_post_thumbnail_id(get_field('product_id'));
          $attachment_id = get_field('default_featured_image', 'option', false);
        }

        if(!$attachment_id)
        {
          $attachment_id = get_field('default_featured_image', 'option', false);
        }

        $img_src = wp_get_attachment_image_url( $attachment_id );
        $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

        $full_src = wp_get_attachment_image_src($attachment_id, 'full', true);
        ?>
        <img class="content-centered-md-down" src="<?php echo esc_url( $img_src ); ?>"
             srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url($full_src[0]); ?> 2760w"
             sizes="100vw">

        <div class="content-centered-vertical content-full-width">
          <h1 class="featured-title"><?php echo get_the_title();?></h1>
          <div class="content-relative">
            <a href="#journal-content-body" id="screen-to-bottom" class="content-centered-horizontal icon-round scroll-to"><i class="fa fa-angle-down"></i></a>
          </div>
        </div>
  </div>

  <div class="container-acc">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
          <a href="<?php echo get_permalink(); ?>"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></a>
        </header>

        <div>
          <?php the_content(); ?>
        </div>
      </article>
  </div>
</div>
<?php get_footer(); ?>
