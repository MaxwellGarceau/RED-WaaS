<?php

class Red_Add_Theme_Support_For_BB {

  function __construct() {
    add_action( 'after_setup_theme', array( $this, 'red_bb_theme_header_footer_support' ) );
    add_action( 'wp', array( $this, 'red_bb_theme_header_footer_render' ) );
    add_filter( 'fl_theme_builder_part_hooks', array( $this, 'red_bb_theme_register_part_hooks' ) );
  }

  function red_bb_theme_header_footer_support() {
    add_theme_support( 'fl-theme-builder-headers' );
    add_theme_support( 'fl-theme-builder-footers' );
    add_theme_support( 'fl-theme-builder-parts' );
  }

  function red_bb_theme_register_part_hooks() {
    return array(
      array(
        'label' => 'Header',
        'hooks' => array(
          'red_before_header' => 'Before Header',
          'red_after_header'  => 'After Header'
        ),
        'label' => 'Footer',
        'hooks' => array(
          'red_before_footer' => 'Before Footer',
          'red_after_footer'  => 'After Footer'
        )
      )
    );
  }

  function red_bb_theme_header_footer_render() {
    // Get the header ID.
    $header_ids = FLThemeBuilderLayoutData::get_current_page_header_ids();
    // If we have a header, remove the theme header and hook in Theme Builder's.
    if ( ! empty( $header_ids ) ) {
      remove_action( 'red_get_header', 'red_header_default' );
      add_action( 'red_get_header', 'FLThemeBuilderLayoutRenderer::render_header' );
    }

    // Get the footer ID.
    $footer_ids = FLThemeBuilderLayoutData::get_current_page_footer_ids();
    // If we have a footer, remove the theme footer and hook in Theme Builder's.
    if ( ! empty( $footer_ids ) ) {
      remove_action( 'red_get_footer', 'red_footer_default' );
      add_action( 'red_get_footer', 'FLThemeBuilderLayoutRenderer::render_footer' );
    }
  }

}

if ( class_exists( 'FLThemeBuilderLayoutData' ) ) {
  $red_add_theme_support_for_bb = new Red_Add_Theme_Support_For_BB();
}
