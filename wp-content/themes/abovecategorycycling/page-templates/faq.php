<?php
/**
 * Template Name: FAQ
 *
 * @package Abovecategorycycling
 * @subpackage Black
 */

get_header();
the_post();

echo get_field('shared_menu', 'option');
?>
<script>
  jQuery(function($){
    if(window.location.hash)
    {
      $("a[href=\\"+ window.location.hash +"]").trigger('click');
    }
  });
</script>

<div id="content-faq" class="faq">

  <div class="content-before">
    <div id="bread-crumbs">
      <div class="container-acc">

        <span class="crumb crumb-step1">About</span>
        <span class="crumb crumb-angle"><strong class="fa fa-angle-right"></strong></span>
        <span class="crumb crumb-step2">FAQ</span>

      </div>
    </div>
    <div id="featured" class="featured text-sm-center content-relative">

         <?php
          $attachment_id = get_post_thumbnail_id();
          $img_src = wp_get_attachment_image_url( $attachment_id );
          $img_srcset = wp_get_attachment_image_srcset( $attachment_id );

          $full_src = wp_get_attachment_image_src($attachment_id, 'full', true);
          ?>
          <img src="<?php echo esc_url( $img_src ); ?>"
               srcset="<?php echo esc_attr( $img_srcset ); ?>, <?php echo esc_url($full_src[0]); ?> 2760w"
               sizes="100vw"
               class="content-centered-md-down"
               >

        <h1 class="featured-title content-centered">FREQUENT QUESTIONS</h1>

    </div>

    
    <div id="heading">
      <div class="container-acc">
        <div class='row'>
          <div class="col-xs-12">
            <div class="heading-menu">
              <strong class="pull-left">FAQ</strong>
              <div class="pull-left">
              <a data-parent="#accordion" data-toggle="collapse" href="#product" class="scroll-to" data-scroll-target="#panel1">PRODUCT</a>
              <a data-parent="#accordion" data-toggle="collapse" href="#shipping-information" class="scroll-to" data-scroll-target="#panel2">SHIPPING INFORMATION</a>
              <a data-parent="#accordion" data-toggle="collapse" href="#return-exchanges" class="scroll-to" data-scroll-target="#panel3">RETURN & EXCHANGES</a>
              <a data-parent="#accordion" data-toggle="collapse" href="#terms-conditions" class="scroll-to" data-scroll-target="#panel4">TERMS & CONDITIONS</a>
              <a data-parent="#accordion" data-toggle="collapse" href="#privacy-policy" class="scroll-to" data-scroll-target="#panel5">PRIVACY POLICY</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="content-body">
    <div class="container-acc">
      <div class="row">
        <div class="col-xs-12">
          <div id="accordion" class="accordion">
            <div class="panel" id="panel1">
              <div class="panel-heading">
                <h2>
                <a data-parent="#accordion" data-toggle="collapse" href="#product">
                  PRODUCT 
                  <i class="fa fa-caret-down pull-right"></i><i class="fa fa-caret-up pull-right"></i>
                </a>
                </h2>
              </div>
              <div id="product" class="panel-collapse collapse">
                <h3>I don’t see a certain product from a brand you carry</h3>
                <p>
                  Above Category is happy to make special orders for select products from manufacturers we currently work with. If you don’t see something listed on our site, simply call the shop or drop us a line via our <a href="#">contact</a> page.
                </p>
                <h3>
                  what size am I? 
                </h3>
                <p>
                  Sizing guides can be found on all of our product under the sizing tab. If you have more detailed questions about fit, please contact us for more information or visit <a href="#">the store</a>. 
                </p>
              </div>
            </div>

            <div class="panel" id="panel2">
              <div class="panel-heading">
                <h2>
                  <a data-parent="#accordion" data-toggle="collapse" href="#shipping-information">
                    SHIPPING INFORMATION
                    <i class="fa fa-caret-down pull-right"></i><i class="fa fa-caret-up pull-right"></i>
                  </a>
                </h2>
              </div>
              <div id="shipping-information" class="panel-collapse collapse">
                <h3>I don’t see a certain product from a brand you carry</h3>
                <p>
                  Above Category is happy to make special orders for select products from manufacturers we currently work with. If you don’t see something listed on our site, simply call the shop or drop us a line via our <a href="#">contact</a> page.
                </p>
                <h3>
                  what size am I? 
                </h3>
                <p>
                  Sizing guides can be found on all of our product under the sizing tab. If you have more detailed questions about fit, please contact us for more information or visit <a href="#">the store</a>. 
                </p>
              </div>
            </div>

            <div class="panel" id="panel3">
              <div class="panel-heading">
                <h2>
                  <a data-parent="#accordion" data-toggle="collapse" href="#return-exchanges">
                    RETURN & EXCHANGES
                    <i class="fa fa-caret-down pull-right"></i><i class="fa fa-caret-up pull-right"></i>
                  </a>
                </h2>
              </div>
              <div id="return-exchanges" class="panel-collapse collapse">
                <h3>I don’t see a certain product from a brand you carry</h3>
                <p>
                  Above Category is happy to make special orders for select products from manufacturers we currently work with. If you don’t see something listed on our site, simply call the shop or drop us a line via our <a href="#">contact</a> page.
                </p>
                <h3>
                  what size am I? 
                </h3>
                <p>
                  Sizing guides can be found on all of our product under the sizing tab. If you have more detailed questions about fit, please contact us for more information or visit <a href="#">the store</a>. 
                </p>
              </div>
            </div>

            <div class="panel" id="panel4">
              <div class="panel-heading">
                <h2>
                  <a data-parent="#accordion" data-toggle="collapse" href="#terms-conditions">
                    TERMS & CONDITIONS
                    <i class="fa fa-caret-down pull-right"></i><i class="fa fa-caret-up pull-right"></i>
                  </a>
                </h2>
              </div>
              <div id="terms-conditions" class="panel-collapse collapse">
                <h3>I don’t see a certain product from a brand you carry</h3>
                <p>
                  Above Category is happy to make special orders for select products from manufacturers we currently work with. If you don’t see something listed on our site, simply call the shop or drop us a line via our <a href="#">contact</a> page.
                </p>
                <h3>
                  what size am I? 
                </h3>
                <p>
                  Sizing guides can be found on all of our product under the sizing tab. If you have more detailed questions about fit, please contact us for more information or visit <a href="#">the store</a>. 
                </p>
              </div>
            </div>

            <div class="panel" id="panel5">
              <div class="panel-heading">
                <h2>
                  <a data-parent="#accordion" data-toggle="collapse" href="#privacy-policy">
                    PRIVACY POLICY
                    <i class="fa fa-caret-down pull-right"></i><i class="fa fa-caret-up pull-right"></i>
                  </a>
                </h2>
              </div>
              <div id="privacy-policy" class="panel-collapse collapse">
                <h3>I don’t see a certain product from a brand you carry</h3>
                <p>
                  Above Category is happy to make special orders for select products from manufacturers we currently work with. If you don’t see something listed on our site, simply call the shop or drop us a line via our <a href="#">contact</a> page.
                </p>
                <h3>
                  what size am I? 
                </h3>
                <p>
                  Sizing guides can be found on all of our product under the sizing tab. If you have more detailed questions about fit, please contact us for more information or visit <a href="#">the store</a>. 
                </p>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="actions">
        <a href="#top" id="screen-to-top" class="center icon-round"><i class="fa fa-angle-up"></i></a>
      </div>
    </div>
  </div>
</div>

<?php
get_footer();
