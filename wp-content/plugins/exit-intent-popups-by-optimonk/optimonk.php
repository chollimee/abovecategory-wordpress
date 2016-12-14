<?php
/*
  Plugin Name: OptiMonk
  Plugin URI: https://www.optimonk.com/
  Description: OptiMonk is an exit-intent popup technology
  Author: OptiMonk
  Version: 1.1.9
  Text Domain: optimonk
  Domain Path: /languages
  Author URI: http://www.optimonk.com/
  License: GPLv2
*/

if (!defined('ABSPATH')) {
    die('');
}

if (is_admin() && session_id() === '') {
    session_start();
}

require_once(dirname(__FILE__) . "/optimonk-admin.php");
require_once(dirname(__FILE__) . "/optimonk-front.php");

if (class_exists('OptiMonkAdmin') && class_exists('OptiMonkFront')) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443)
        ? "https://"
        : "http://";
    $currentUrl = $protocol . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

    if (!is_admin() && strpos($currentUrl, wp_login_url()) !== 0) {
        add_action('wp_print_footer_scripts', array('OptiMonkFront', 'init'));
    }

    register_activation_hook(__FILE__, array('OptiMonkAdmin', 'activate'));
    add_action('admin_init', array('OptiMonkAdmin', 'redirectToSettingPage'));

    $optiMonkAdmin = new OptiMonkAdmin(__FILE__);
    $optiMonkFront = new OptiMonkFront();
}
