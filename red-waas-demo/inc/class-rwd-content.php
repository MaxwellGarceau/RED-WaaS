<?php

class Red_Waas_Demo_Content {
  public static function init() {
    add_action( 'init', __CLASS__ . '::set_template_by_query_param' );
    // add_filter( 'acf/update_value', 'change_demo_content_on_template_change', 10, 3 );
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

  public static function change_demo_content_on_template_change( $value, $post_id, $field ) {
    if ( $field['name'] == 'template_selector' ) {
      /* Load demo content here based on template_selector value */
      
    }
    return $value;
  }
}
