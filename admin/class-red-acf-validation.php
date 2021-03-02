<?php
class Red_ACF_Validation {

  public static $min_logo_width_2x = 412;

  public static function init() {
    add_filter( 'acf/validate_attachment', array( __CLASS__, 'logo_minimum_size' ), 10, 5 );
  }

  public static function get_min_logo_width_2x() {
    return self::$min_logo_width_2x;
  }

  public static function resize_logo_to_2x() {
    $logo_id = get_field( 'site_logo', 'options' );
    $resize_dimensions = array(
      'width' => self::get_min_logo_width_2x(),
    );
    if ( class_exists( 'Red_Image_Optimization' ) ) {
      $resize = Red_Image_Optimization::resize( $logo_id, $resize_dimensions );
      if ( is_wp_error( $resize ) ) {
        wp_die( $resize );
      }
    } else {
      wp_die( 'Could not resize logo. Class "Red_Image_Optimization" not loaded.' );
    }
    // die();
  }

  /**
   * Make sure logo is at least 412px
   */
  public static function logo_minimum_size( $errors, $file, $attachment, $field, $context ) {
    if ( $field['name'] == 'site_logo' && $attachment['width'] < self::get_min_logo_width_2x() ) {
      $errors[] = __( 'Logo must be at least ' . self::get_min_logo_width_2x() . 'px wide.' );
    }
    return $errors;
  }
}
Red_ACF_Validation::init();
