<?php
/**
 * All the variables that are set in the admin or other global variables that
 * need to be controlled from a single location are called from here.
 */
class Red_Style_Variables {
  public static function get_main() {
    return get_field( 'color_main', 'options' );
  }
  public static function get_secondary() {
    return get_field( 'color_secondary', 'options' );
  }
  public static function get_highlight() {
    return get_field( 'color_highlight', 'options' );
  }
  public static function get_highlight_hover() {
    return get_field( 'color_highlight_hover', 'options' );
  }
  public static function get_header_top_background() {
    return get_field( 'header_top_background', 'options' );
  }
  public static function get_header_main_background() {
    return get_field( 'header_main_background', 'options' );
  }
  public static function get_text_color() {
    return '#231f20';
  }
  public static function get_dark_text_color() {
    return '#231f20';
  }
  public static function get_light_text_color() {
    return '#ffffff';
  }
  public static function get_dark() {
    return '#333333';
  }
}
