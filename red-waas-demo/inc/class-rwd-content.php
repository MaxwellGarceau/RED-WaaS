<?php

class Red_Waas_Demo_Content {
  public static function init() {
    add_action( 'init', array( __CLASS__, 'set_template_by_query_param' ) );
    add_filter( 'acf/update_value', array( __CLASS__, 'change_demo_content_on_template_change' ), 10, 3 );
  }

  public static function set_template_by_query_param() {
    $template = $_GET['template_selector'];
    if ( $template ) {
      $field_object = get_field_object( 'template_selector', 'options' );

      /* If query param is a template selector choice then set template to that choice */
      if ( $field_object['choices'][ $template ] ) {
        update_field( 'template_selector', $template, 'options' );
      }
    }
  }

  public static function get_demo_template_settings() {
    return array(
      'red-waas' => array(
        /* Colors */
        'header_top_background' => '#641818',
        'header_main_background' => '#ffffff',
        'menu_text_color' => '#641818',
        'menu_text_color_hover_active' => '#65768c',
        'color_main' => '#641818',
        'color_secondary' => '#473249',
        'color_highlight' => '#641818',
        'color_highlight_hover' => '#d1d1d1',
      ),
      'ootp-silvanos' => array(
        /* Colors */
        'header_top_background' => '#641818',
        'header_main_background' => '#ffffff',
        'menu_text_color' => '#641818',
        'menu_text_color_hover_active' => '#596a80',
        'color_main' => '#641818',
        'color_secondary' => '#596a80',
        'color_highlight' => '#641818',
        'color_highlight_hover' => '#8c8f91',
      ),
      'ootp-abb' => array(
        /* Colors */
        'header_top_background' => '#efefef',
        'header_main_background' => '#ffffff',
        'menu_text_color' => '#335186',
        'menu_text_color_hover_active' => '#ff1e3d',
        'color_main' => '#002668',
        'color_secondary' => '#335186',
        'color_highlight' => '#ff1e3d',
        'color_highlight_hover' => '#ea0003',
      ),
    );
  }

  public static function change_demo_content_on_template_change( $value, $post_id, $field ) {
    if ( $field['name'] == 'template_selector' ) {
      /* Load demo content here based on template_selector value */
      $demo_settings = self::get_demo_template_settings();
      $new_template = $demo_settings[ $value ];
      foreach ( $new_template as $field_name => $field_value ) {
        update_field( $field_name, $field_value, 'options' );
      }
    }
    return $value;
  }
}
