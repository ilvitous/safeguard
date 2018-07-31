<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title><?php


	global $page, $paged;
	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	?></title>

     <link rel="shortcut icon" href="<?php echo IMAGES_DIR ?>/favicon.ico" />

    <?php wp_head(); ?>


  </head>
  <body>


  <header id="safe_header">

      <button id="mobile_menu_open" type="button" name="mobile_menu" class="d-flex d-lg-none">

      </button>


      <a href="<?php echo BLOG_URL ?>" title="Safeguard Wholesale Supply">
        <img id="main_logo_desk" src="<?php echo IMAGES_DIR ?>/main_logo_desk.png" alt="Safeguard Wholesale Supply">
      </a>

      <nav id="main_navigation_desk">
        <!-- main navigation -->
        <div class="menu_wrapper d-none d-lg-block">
        <?php wp_nav_menu( array( 'theme_location' => 'main-home' ) ); ?>
        </div>
        <!-- main navigation -->

        <ul id="utility_desktop">
          <li><button title="Search" type="button" name="search" class="d-none d-sm-block"><img src="<?php echo IMAGES_DIR ?>/search.svg" width="31" height="31" alt="search"></button></li>
          <li><button title="Account" type="button" name="account" class="d-none d-sm-block"><img src="<?php echo IMAGES_DIR ?>/account.svg" width="31" height="31" alt="account"></button></li>
          <li><button title="Cart" type="button" name="cart"><img src="<?php echo IMAGES_DIR ?>/cart.svg" width="31" height="31" alt="cart"></button></li>
        </ul>

      </nav>

  </header>
