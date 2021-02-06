<?php

/**
 * A class for misc and general purpose helper functions
 */
class Red_Helper {

  // Source: https://thebarton.org/php-format-phone-number-function/
  public static function format_phone_us( $phone ) {
    // note: making sure we have something
    if ( ! isset( $phone{3} ) ) {
      return '';
    }

    // note: strip out everything but numbers
    $phone = preg_replace( "/[^0-9]/", "", $phone );
    $length = strlen( $phone );
    switch( $length ) {
      // Note: 7 digit phone numbers shouldn't be entered
      // case 7:
      //   return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
      // break;
      case 10:
       return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "tel:+1-$1-$2-$3", $phone);
      break;
      case 11:
      return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "tel:+$1-$2-$3-$4", $phone);
      break;
      default:
        return $phone;
      break;
    }
  }

  public static function format_email_mailto( $email ) {
    return 'mailto:' . $email;
  }

  public static function format_google_maps_url( $address ) {
    $formatted_address = wp_strip_all_tags( $address );
    $formatted_address = preg_replace( '/[^a-z0-9\#+]+/i', '+', $formatted_address );
    $base_url = 'https://maps.google.com?q=';
    return $base_url . $formatted_address;
  }

  public static function get_google_map_iframe_embed( $address ) {
    /* Format URL */
    $formatted_address = wp_strip_all_tags( $address );
    $formatted_address = urlencode( $formatted_address );
    $url = 'https://maps.google.com/maps?q=' . $formatted_address . '&t=&z=15&ie=UTF8&iwloc=&output=embed';

    /* iFrame */
    $iframe = '<iframe src="' . $url . '" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
    return $iframe;
  }
}
