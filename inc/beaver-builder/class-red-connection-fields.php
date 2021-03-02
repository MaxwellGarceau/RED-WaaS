<?php

class Red_Connection_Fields {

  /**
   * Hooks
   */
  public static function init() {
    add_action( 'fl_page_data_add_properties', 'Red_Connection_Fields::red_add_red_connection_group' );
    add_action( 'fl_page_data_add_properties', 'Red_Connection_Fields::register_custom_connection_fields' );
    add_filter( 'fl_builder_register_settings_form', array( __CLASS__, 'add_connection_field_to_image_width' ), 10, 2 );
  }

  public static function add_connection_field_to_image_width( $form, $slug ) {
    if ( $slug == 'photo' ) {
      $form['style']['sections']['general']['fields']['width']['connections'] = array( 'string' );
    }
    return $form;
  }

  /**
   * Register Connection Fields
   */
  public static function red_add_red_connection_group() {
    FLPageData::add_group( 'red', array(
      'label' => 'RED'
    ) );

    FLPageData::add_group( 'dynamic_ld', array(
      'label' => 'Dynamic Light or Dark'
    ) );
  }

  public static function register_custom_connection_fields() {

    /**
     * SPECIFIC Dynamic Color Settings (for header, footer, buttons, etc)
     */

    /* Top Header Text Color */
    FLPageData::add_post_property( 'red_top_header_text_color', array(
        'label'   => 'Top Header Text Color',
        'group'   => 'red',
        'type'    => 'color',
        'getter'  => 'Red_Connection_Fields::red_top_header_text_color',
    ) );

    /* Footer Text Color */
    FLPageData::add_post_property( 'red_footer_text_color', array(
        'label'   => 'Footer Text Color',
        'group'   => 'red',
        'type'    => 'color',
        'getter'  => 'Red_Connection_Fields::red_footer_text_color',
    ) );

    /* Secondary Overlay Color */
    FLPageData::add_post_property( 'red_secondary_overlay_color', array(
        'label'   => 'Secondary Overlay Color',
        'group'   => 'red',
        'type'    => 'color',
        'getter'  => 'Red_Connection_Fields::red_secondary_overlay_color',
    ) );

    /* Text against Secondary Background for Callout Module */
    FLPageData::add_post_property( 'red_text_against_secondary_background_callout_module', array(
        'label'   => 'Callout Module Text Against Secondary Background',
        'group'   => 'red',
        'type'    => 'color',
        'getter'  => 'Red_Connection_Fields::red_text_against_secondary_background_callout_module',
    ) );

    /**
     * GENERAL Dynamic Color Settings (for text against secondary background, etc)
     */

     /* Text against Secondary Background */
     FLPageData::add_post_property( 'red_main_dynamic_ld', array(
         'label'   => 'Color - Main (Dynamic Light or Dark Color)',
         'group'   => 'dynamic_ld',
         'type'    => 'color',
         'getter'  => 'Red_Connection_Fields::red_main_dynamic_ld',
     ) );

     /* Text against Secondary Background */
     FLPageData::add_post_property( 'red_secondary_dynamic_ld', array(
         'label'   => 'Color - Secondary (Dynamic Light or Dark Color)',
         'group'   => 'dynamic_ld',
         'type'    => 'color',
         'getter'  => 'Red_Connection_Fields::red_secondary_dynamic_ld',
     ) );

     /* Highlight Text Color - dynamically chooses light or dark color for a background set to Highlight Text Color */
     FLPageData::add_post_property( 'red_highlight_dynamic_ld', array(
         'label'   => 'Color - Highlight (Dynamic Light or Dark Color)',
         'group'   => 'dynamic_ld',
         'type'    => 'color',
         'getter'  => 'Red_Connection_Fields::red_highlight_dynamic_ld',
     ) );

     /* Highlight Text Color Hover - dynamically chooses light or dark color for a background set to Highlight Cover Hover */
     FLPageData::add_post_property( 'red_highlight_hover_dynamic_ld', array(
         'label'   => 'Color - Highlight Hover (Dynamic Light or Dark Color)',
         'group'   => 'dynamic_ld',
         'type'    => 'color',
         'getter'  => 'Red_Connection_Fields::red_highlight_hover_dynamic_ld',
     ) );

    /**
     * Misc
     */

     FLPageData::add_post_property( 'red_formatted_phone_number', array(
         'label'   => 'Phone Number (Formatted)',
         'group'   => 'red',
         'type'    => 'url',
         'getter'  => 'Red_Connection_Fields::red_formatted_phone_number',
     ) );

     FLPageData::add_post_property( 'red_email_mailto', array(
         'label'   => 'Email (mailto:)',
         'group'   => 'red',
         'type'    => 'url',
         'getter'  => 'Red_Connection_Fields::red_email_mailto',
     ) );

     FLPageData::add_post_property( 'red_google_maps_url', array(
         'label'   => 'Google Maps URL',
         'group'   => 'red',
         'type'    => 'url',
         'getter'  => 'Red_Connection_Fields::red_google_maps_url',
     ) );

     FLPageData::add_post_property( 'red_google_maps_embed', array(
         'label'   => 'Google Maps Embed',
         'group'   => 'red',
         'type'    => 'html',
         'getter'  => 'Red_Connection_Fields::red_google_maps_embed',
     ) );

     FLPageData::add_post_property( 'red_logo_width', array(
         'label'   => 'Logo Width',
         'group'   => 'red',
         'type'    => 'string',
         'getter'  => 'Red_Connection_Fields::red_logo_width',
     ) );
  }

  /**
   * Connection Field Getter Functions
   */

  /* Specific Dynamic Functions */
  public static function red_top_header_text_color() {
    $header_background_color = Red_Style_Variables::get_header_top_background();
    return Red_Automatic_Colors::is_light_color( $header_background_color ) ? Red_Style_Variables::get_dark_text_color() : Red_Style_Variables::get_light_text_color();
  }

  public static function red_footer_text_color() {
    $footer_background_color = Red_Style_Variables::get_secondary(); // Footer uses secondary color
    return Red_Automatic_Colors::is_light_color( $footer_background_color ) ? Red_Style_Variables::get_dark_text_color() : Red_Style_Variables::get_light_text_color();
  }

  public static function red_secondary_overlay_color() {
    $secondary_color = Red_Style_Variables::get_secondary();
    $secondary_rgb = Red_Automatic_Colors::hex_to_rgb( $secondary_color, 'commas' );
    return 'rgba(' . $secondary_rgb . ',0.9)';
  }

  public static function red_highlight_dynamic_ld() {
    $button_background_color = Red_Style_Variables::get_highlight();
    return Red_Automatic_Colors::is_light_color( $button_background_color ) ? Red_Style_Variables::get_dark_text_color() : Red_Style_Variables::get_light_text_color();
  }

  public static function red_highlight_hover_dynamic_ld() {
    $button_background_color_hover = Red_Style_Variables::get_highlight_hover();
    return Red_Automatic_Colors::is_light_color( $button_background_color_hover ) ? Red_Style_Variables::get_dark_text_color() : Red_Style_Variables::get_light_text_color();
  }

  // Callout module requires the '#' to be stripped from the hex code
  public static function red_text_against_secondary_background_callout_module() {
    $secondary_background = Red_Style_Variables::get_secondary();
    $secondary_text_color = Red_Automatic_Colors::is_light_color( $secondary_background ) ? Red_Style_Variables::get_dark_text_color() : Red_Style_Variables::get_light_text_color();
    return preg_replace( "/\#/", "", $secondary_text_color ); // Callout module needs to strip '#' for color
  }

  /* General Dynamic Functions */
  public static function red_main_dynamic_ld() {
    $main_color = Red_Style_Variables::get_main();
    return Red_Automatic_Colors::is_light_color( $main_color ) ? Red_Style_Variables::get_dark_text_color() : Red_Style_Variables::get_light_text_color();
  }

  public static function red_secondary_dynamic_ld() {
    $secondary_background = Red_Style_Variables::get_secondary();
    return Red_Automatic_Colors::is_light_color( $secondary_background ) ? Red_Style_Variables::get_dark_text_color() : Red_Style_Variables::get_light_text_color();
  }

  /* Misc */
  public static function red_formatted_phone_number() {
    $phone_number = get_field( 'phone_number', 'options' );
    $phone_number_formatted = Red_Helper::format_phone_us( $phone_number );
    return $phone_number_formatted;
  }

  public static function red_email_mailto() {
    $email = get_field( 'social_links_email', 'options' );
    $email_mailto = Red_Helper::format_email_mailto( $email );
    return $email_mailto;
  }

  public static function red_google_maps_url() {
    $address = get_field( 'locations', 'options' );
    return Red_Helper::format_google_maps_url( $address );
  }

  public static function red_google_maps_embed() {
    $address = get_field( 'locations', 'options' );
    return Red_Helper::get_google_map_iframe_embed( $address );
  }

  public static function red_logo_width() {
    $site_logo_id = get_field( 'site_logo', 'options' );
    $attachement = wp_get_attachment_metadata( $site_logo_id );
    $width = $attachement['width'] / 2; // Divide by 2 because logo is uploaded @2x
    return (string) $width;
  }

}
Red_Connection_Fields::init();
