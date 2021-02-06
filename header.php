<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package red_underscores
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'red_underscores' ); ?></a>

  <?php

  /*
   * Code for header is in /templates/header/header-default.php.
   * If Beaver Builder Themer plugin is enabled then header and a header is created
   * then is edited in Beaver Builder through the admin.
   */

    do_action( 'red_before_header' );
   
    do_action( 'red_get_header' );

    do_action( 'red_after_header' );
  ?>

	<div id="content" class="site-content">
