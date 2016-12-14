<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Abovecategorycycling
 * @subpackage Black
 */
?>

  </div>

  <footer id="site-colophon" class="site-footer hidden-md-down" role="contentinfo">
    <div class="container-acc">
      <div class="footer-links">
        <div class="row">
          <div class="col-sm-6">
            <div class="site-links">
              <div class="row">
                <nav class="col-sm-4">
                  <ul>
                    <li><a href="https://www.abovecategorycycling.com/contact">Contact Us</a></li>
                    <li><a href="https://www.abovecategorycycling.com/faq">FAQs</a></li>
                    <li><a href="https://www.abovecategorycycling.com/galleries">Galleries</a></li>
                  </ul>
                </nav>
                <nav class="col-sm-4">
                  <ul>
                    <li><a href="https://www.abovecategorycycling.com/faq">Shipping Information</a></li>
                    <li><a href="https://www.abovecategorycycling.com/faq">Returns and Exchanges</a></li>
                  </ul>
                </nav>
                <nav class="col-sm-4">
                  <ul>
                    <li><a href="https://abovecategory.myshopify.com/collections/men">Mens</a></li>
                    <li><a href="https://abovecategory.myshopify.com/collections/women">Womens</a></li>
                    <li><a href="https://abovecategory.myshopify.com/collections/bikes">Bikes</a></li>
                    <li><a href="https://abovecategory.myshopify.com/collections/accessories">Accessories</a></li>
                    <li><a href="http://www.abovecategorycycling.com/journals">Journal</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <nav class="social-links text-sm-right" role="navigation">
              <a href="https://twitter.com/abovecategory"><i class="fa fa-twitter"></i></a>
              <a href="https://www.facebook.com/AboveCategoryCycling"><i class="fa fa-facebook"></i></a>
              <a href="https://www.instagram.com/abovecategory/"><i class="fa fa-instagram"></i></a>
            </nav>
          </div>
        </div>
      </div>

      <div class="text-sm-right">
        <img src="<?php echo get_template_directory_uri()?>/html/images/logo-sm.png"/>
      </div>

      <div class="site-info">
        <div class="row">
          <div class="col-sm-6">
            &copy; 2016 All Rights Reserved
          </div>
          <div class="col-sm-6 text-sm-right">
            <a href="">Terms of Use</a>
            <a href="">Privacy Policy</a>
          </div>
        </div>
      </div>
    </div>
  </footer>


  <footer id="mobile-colophon" class="site-footer hidden-lg-up" role="contentinfo">
    <div class="container">
      <div class="footer-links text-xs-center">

        <div class="site-links">
          <div class="row">
            <nav class="col-sm-4">
              <ul>
                <li><a href="https://www.abovecategorycycling.com/contact">Contact Us</a></li>
                <li><a href="https://www.abovecategorycycling.com/faq">FAQs</a></li>
                <li><a href="https://www.abovecategorycycling.com/galleries">Galleries</a></li>
              </ul>
            </nav>
            <nav class="col-sm-4">
              <ul>
                <li><a href="https://www.abovecategorycycling.com/faq">Shipping Information</a></li>
                <li><a href="https://www.abovecategorycycling.com/faq">Returns and Exchanges</a></li>
              </ul>
            </nav>
            <nav class="col-sm-4">
              <ul>
                <li><a href="https://abovecategory.myshopify.com/collections/men">Mens</a></li>
                <li><a href="https://abovecategory.myshopify.com/collections/women">Womens</a></li>
                <li><a href="https://abovecategory.myshopify.com/collections/bikes">Bikes</a></li>
                <li><a href="https://abovecategory.myshopify.com/collections/accessories">Accessories</a></li>
                <li><a href="http://www.abovecategorycycling.com/journals">Journal</a></li>
              </ul>
            </nav>
          </div>
        </div>

        <nav class="social-links text-xs-center" role="navigation">
          <a href="https://twitter.com/abovecategory"><i class="fa fa-twitter"></i></a>
          <a href="https://www.facebook.com/AboveCategoryCycling"><i class="fa fa-facebook"></i></a>
          <a href="https://www.instagram.com/abovecategory/"><i class="fa fa-instagram"></i></a>
        </nav>
      </div>

      <div class="text-xs-center">
        <img src="<?php echo get_template_directory_uri()?>/html/images/logo-sm.png"/>
      </div>

      <div class="site-info">

          <div class="policy-links text-xs-center">
            <a href="">Terms of Use</a>&nbsp;&nbsp;&nbsp;
            <a href="">Privacy Policy</a>
          </div>

          <div class="copyright text-xs-center">
            &copy; 2016 All Rights Reserved
          </div>
          
      </div>
    </div>
  </footer>
  <div id="bottom"></div>
</div>
<div id="zoom">
  <div class="zoom-header text-sm-right"><a href="#" class="btn-close-zoom mz mz-close"></a></div>
  <div class="zoom-content"></div>
  <div class="zoom-footer"></div>
</div>

<script>
  $('.btn-close-zoom').click(function(){
    App.close_zoom();
  });
</script>
<?php wp_footer(); ?>
</body>
</html>