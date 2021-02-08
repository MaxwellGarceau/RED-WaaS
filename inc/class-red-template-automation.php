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

  		/* Get all header/footer themer layouts */
  		$args = array(
  			'post_type' => 'fl-theme-layout',
  			'post_status' => array( 'publish', 'draft' ),
  			'posts_per_page' => -1,
  			'meta_query' => array(
  				array(
  					'key' => '_fl_theme_layout_type',
  					'value' => array( 'header', 'footer' ),
  					'compare' => 'IN',
  				),
  			),
  		);
  		$header_footer_themer_layouts = new WP_Query( $args );

  		foreach( $header_footer_themer_layouts->posts as $themer_layout ) {
  			/* Get term slugs for each layout */
  			$terms = get_the_terms( $themer_layout, 'fl-builder-template-category' );
  			$term_slugs = array_map( function( $term ) {
  				return $term->slug;
  			}, $terms );

  			/* If template_selector value is the same as a layouts term slug we activate (publish) the layout */
  			if ( in_array( $template_selector_new_value, $term_slugs ) ) {
  				wp_publish_post( $themer_layout->ID );
  			} else {
  				/* Otherwise we deactivate (unpublish) the layout */
  				wp_update_post(
  					array(
  					'ID'    =>  $themer_layout->ID,
  					'post_status'   =>  'draft',
  					)
  				);
  			}
  		}
  	}

  	return $template_selector_new_value;
  }
}
Red_Template_Automation::init();
