<?php
/**
 * @package Abovecategorycycling
 * @subpackage Black
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <?php wp_head(); ?>
  <script>
    var App = require('scripts/App.js');
  </script>


<script>
//<![CDATA[
    (function() {
      function asyncLoad() {
        var urls = ["https:\/\/cdn.shopify.com\/s\/files\/1\/1234\/3118\/t\/2\/assets\/mm-init.js?8229559791247676849\u0026shop=abovecategory.myshopify.com"];
        for (var i = 0; i < urls.length; i++) {
          var s = document.createElement('script');
          s.type = 'text/javascript';
          s.async = true;
          s.src = urls[i];
          var x = document.getElementsByTagName('script')[0];
          x.parentNode.insertBefore(s, x);
        }
      }
      window.attachEvent ? window.attachEvent('onload', asyncLoad) : window.addEventListener('load', asyncLoad, false);
    })();
//]]>
</script>
</head>

<body class="mobile <?php if(wp_is_mobile()){ echo "mobile"; }?>">

<div id="mobile-navigation" off-canvas="left-sidebar left reveal">
  <div id="search-box">
    <form role="search" method="get" id="search-form" action="https://shop.abovecategorycycling.com/search">
      <input type="hidden" name="type" value="product">
      <div class="input-group search">
        <span class="input-group-addon">
          <i class="fa fa-search"></i>
        </span>
        <input type="text" value="" name="q" id="q" class="form-control" placeholder="Search"/>
      </div>
    </form>
  </div>
  <div id="cart-links" class="text-xs-center">
    <ul class="row">
      <li class="col-xs-6">
        <a href="https://shop.abovecategorycycling.com/account/register" id="customer_register_link">Join</a> /
        <a href="https://shop.abovecategorycycling.com/account/login" id="customer_login_link">Login</a>
      </li>
      <li class="col-xs-6">
        <a href="https://shop.abovecategorycycling.com/cart"><i class="fa fa-shopping-cart"></i></a>
      </li>
    </ul>
  </div>
  <?php
    $shared_menu_mobile_url = get_field('shared_menu_mobile_url', 'option', false);
    echo get_url_content($shared_menu_mobile_url);
  ?>
</div>

<div id="page" canvas="container">
  
  <header id="mobile-masthead" class="hidden-lg-up">
    <div id="navbar-main-area">
      <nav id="navbar-main" class="navbar navbar-default navbar-fixed-top bg-faded" role="navigation">
        <div class="navbar-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-4">
                <a role="button" id="toggle-menu-button">
                  &#9776;
                </a>
              </div>

              <div class="col-xs-4">
                <div id="site-logo" class="text-xs-center">
                  <a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri()?>/html/images/logo.png"/></a>
                </div>
              </div>
              </div>
            </div>
          </div>
      </nav>
    </div>
  </header>

  <header id="site-masthead" class="hidden-md-down">
    <div id="site-branding" class="container-fluid">
      <div class="row">

        <div class="col-xs-6 col-sm-4 offset-sm-4">
          <div id="site-logo" class="text-sm-center">
            <a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri()?>/html/images/logo.png"/></a>
          </div>
        </div>

        <div class="col-xs-6 col-sm-4">
          <form role="search" method="get" id="search-form" class="pull-sm-right" action="https://shop.abovecategorycycling.com/search">
            <input type="hidden" name="type" value="product">
            <div class="input-group search">
              <span class="input-group-addon">
                <i class="fa fa-search"></i>
              </span>
              <input type="text" value="<?php echo get_search_query(); ?>" name="q" id="q" class="form-control" placeholder="Search"/>
            </div>
          </form>
        </div>

      </div>
    </div>

    <div id="site-navigation">
      <div class="container-fluid text-block">
        <div class="row">

          <div class="col-md-3">
            <div id="welcome-text">
              WELCOME TO ABOVE CATEGORY CYCLING
            </div>
          </div>
          <div class="col-md-6">
              <?php 
                $shared_menu_url = get_field('shared_menu_url', 'option', false);
                echo get_url_content($shared_menu_url);
              ?>
          </div>

          <div class="col-md-3">

            <div id="cart-links" class="text-sm-right">
                <a href="https://abovecategory.myshopify.com/account/register" id="customer_register_link">Join</a>
                <span>/</span>
                <a href="https://abovecategory.myshopify.com/account/login" id="customer_login_link">Log in</a>
                    
                <a href="https://abovecategory.myshopify.com/cart" class="cart"><i class="fa fa-shopping-cart"></i></a>
            </div>

          </div>

        </div>
      </div>
    </div>
  </header>

  <div id="content">