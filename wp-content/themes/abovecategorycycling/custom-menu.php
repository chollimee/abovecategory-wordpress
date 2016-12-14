<?php
if($custom_menu_id)
{
  $page = get_post($custom_menu_id);
  echo $page->post_content;
}
else
{
  ?>
  <nav id="main-menu">
    <?php
      $menuParameters = array(
        'container'       => false,
        'echo'            => false,
        'items_wrap'      => '%3$s',
        'depth'           => 2,
        'theme_location' => 'main_navigation_menu',
        'menu_class'     => 'main-navigation-menu'
      );

      echo wp_nav_menu( $menuParameters );
      
    ?>
  </nav>
<?php
}
?>