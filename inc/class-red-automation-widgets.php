<?php
class Red_Automation_Widgets {
  public static function init() {
    add_action( 'init', function() {
      add_shortcode( 'phone_number', __CLASS__ . '::phone_number_embed' );
    } );
  }

  public static function phone_number_embed( $atts ) {
    $a = shortcode_atts( array(
      'display_text' => 'Call',
    ), $atts );
    $phone_number = get_field( 'phone_number', 'options' );
    $phone_number = Red_Helper::format_phone_us( $phone_number );
    $link = '<a href="' . $phone_number . '">' . $a['display_text'] . '</a>';
    return $link;
  }
}
Red_Automation_Widgets::init();
