<?php
add_action('wp_enqueue_scripts', 'enqueue_site_mobile_scripts');
function enqueue_site_mobile_scripts()
{
  wp_enqueue_style('acc_mobile_style',  get_stylesheet_uri());
}