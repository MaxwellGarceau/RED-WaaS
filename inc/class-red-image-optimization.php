<?php
class Red_Image_Optimization {

  public static function resize( $attachement_id, $resize_dimensions = array() ) {
    /* Handle resize dimensions */
    $resize_dimensions['width'] = isset( $resize_dimensions['width'] ) ? $resize_dimensions['width'] : null;
    $resize_dimensions['height'] = isset( $resize_dimensions['height'] ) ? $resize_dimensions['height'] : null;
    if ( is_null( $resize_dimensions['width'] ) && is_null( $resize_dimensions['height'] ) ) {
      return new WP_Error( 'resize_dimensions', 'No resize dimensions have been given.' );
    }

    $attachement_path = get_attached_file( $attachement_id );
    if ( ! $attachement_path ) {
      return new WP_Error( 'attachement_path', 'Attachement path could not be returned. Please check that the attachement you are trying to resize exists.' );
    }

    $wp_image_editor = wp_get_image_editor( $attachement_path );
    if ( is_wp_error( $wp_image_editor ) ) {
      return $wp_image_editor;
    }

    $current_dimensions = $wp_image_editor->get_size();

    /* Check to make sure existing width and height are greater than what we want to resize to */
    if ( ( isset( $current_dimensions['width'] ) && ! is_null( $current_dimensions['width'] ) && $current_dimensions['width'] >= $resize_dimensions['width'] )
      || ( isset( $current_dimensions['height'] ) && ! is_null( $current_dimensions['height'] ) && $current_dimensions['height'] >= $resize_dimensions['height'] ) ) {

      $resize_result = $wp_image_editor->resize( $resize_dimensions['width'], $resize_dimensions['height'], false );
      if ( is_wp_error( $resize_result ) ) {
        return $resize_result;
      }

      $set_quality_result = $wp_image_editor->set_quality( 100 ); // 100% compression, highest quality
      if ( is_wp_error( $set_quality_result ) ) {
        return $set_quality_result;
      }

      $save_results = $wp_image_editor->save( $attachement_path );
      if ( is_wp_error( $save_results ) ) {
        return $save_results;
      }

      /* Get attachment meta */
      $image_meta = get_post_meta( $attachement_id, '_wp_attachment_metadata', true );

      /* If attachment values in database are different then save values */
      if ( $image_meta['height'] != $save_results['height'] || $image_meta['width'] != $save_results['width'] ) {
        /* We need to change width and height in metadata */
        $image_meta['height'] = $save_results['height'];
        $image_meta['width']  = $save_results['width'];
        $update_post_meta = wp_update_attachment_metadata( $attachement_id, $image_meta );

        if ( $update_post_meta ) {
          return $save_results;
        } else {
          return new WP_Error( 'update_post_meta', 'update_post_meta failed. Results: ' . $update_post_meta );
        }
      } else {
        return $save_results;
      }

    } else {
      return new WP_Error( 'current_dimensions', 'Current dimensions are smaller than the resize dimensions.' );
    }
  }

}
