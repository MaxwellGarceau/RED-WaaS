<?php
class Red_Template_Automation {
  public static function init() {
    add_filter( 'acf/update_value/name=template_selector', __CLASS__ . '::toggle_layout_header_footer_on_template_selector_change', 10, 3 );
  }

  /**
   * Publish and Unpublish appropriate Header/Footer Layouts when Template Selector Changes
   *
   * Reason: A header/footer layout can not be edited if other header/footer layouts are active
   */
  public static function toggle_layout_header_footer_on_template_selector_change( $template_selector_new_value, $post_id, $field ) {
  	/* Check if template_selector value changed */
  	$template_selector_old_value = get_post_meta( $post_id, $field['name'], true );
  	if ( $template_selector_new_value != $template_selector_old_value ) {

  		/* Get template specific header/footer themer layouts */
  		$args = array(
  			'post_type' => 'fl-theme-layout',
  			'post_status' => array( 'publish', 'draft' ),
  			'posts_per_page' => -1,
        'fields' => 'ids',
  			'meta_query' => array(
  				array(
  					'key' => '_fl_theme_layout_type',
  					'value' => array( 'header', 'footer' ),
  					'compare' => 'IN',
  				),
  			),
        'tax_query' => array(
          array(
            'taxonomy' => 'fl-builder-template-category',
            'field' => 'slug',
            'terms' => $template_selector_new_value, // Template selectors have the same slug as BB Template Category terms
            // 'include_children' => false
          ),
        ),
  		);
  		$template_layouts_query = new WP_Query( $args );

      /* Bail early if no header or footer layouts are assigned to the current template */
      if ( empty( $template_layouts_query->posts ) ) {
        return $template_selector_new_value;
      }

      /* Get all header/footer themer layouts minus template specific */
  		$args = array(
  			'post_type' => 'fl-theme-layout',
  			'post_status' => array( 'publish', 'draft' ),
  			'posts_per_page' => -1,
        'fields' => 'ids',
        'post__not_in' => $template_layouts_query->posts,
  			'meta_query' => array(
  				array(
  					'key' => '_fl_theme_layout_type',
  					'value' => array( 'header', 'footer' ),
  					'compare' => 'IN',
  				),
  			),
  		);
  		$non_template_layouts_query = new WP_Query( $args );

      /* Unpublish non template header/footer layouts */
      foreach( $non_template_layouts_query->posts as $themer_layout_id ) {
        wp_update_post(
          array(
          'ID'    =>  $themer_layout_id,
          'post_status'   =>  'draft',
          )
        );
      }

      /* Publish theme specific header/footer layouts */
      foreach( $template_layouts_query->posts as $themer_layout_id ) {
		    wp_publish_post( $themer_layout_id );
      }

  	}

  	return $template_selector_new_value;
  }
}
Red_Template_Automation::init();
