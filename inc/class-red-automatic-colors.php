<?php

class Red_Automatic_Colors {

  /**
   * Helpers
   */

  // Same as HTMLToRGB_bit_shift, but outputs raw rgb value
  public static function hex_to_rgb( $htmlCode, $output_format = false ) {
    if ( $htmlCode[0] == '#' ) {
      $htmlCode = substr($htmlCode, 1);
    }

    if ( strlen( $htmlCode ) == 3 ) {
      $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
    }

    $rgb = array();
    $rgb['r'] = hexdec( $htmlCode[0] . $htmlCode[1] );
    $rgb['g'] = hexdec( $htmlCode[2] . $htmlCode[3] );
    $rgb['b'] = hexdec( $htmlCode[4] . $htmlCode[5] );

    // Format (default is to return array)
    if ( $output_format === 'commas' ) {
      $rgb = implode( ',', $rgb );
    } else if ( $output_format === 'int' ) {
      $rgb = (int) implode( '', $rgb );
    }

    return $rgb;
  }

  // Source: https://stackoverflow.com/questions/12228644/how-to-detect-light-colors-with-php#answer-12228733
  public static function HTMLToRGB_bit_shift( $htmlCode ) {
    if ( $htmlCode[0] == '#' ) {
      $htmlCode = substr($htmlCode, 1);
    }

    if ( strlen( $htmlCode ) == 3 ) {
      $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
    }

    $r = hexdec( $htmlCode[0] . $htmlCode[1] );
    $g = hexdec( $htmlCode[2] . $htmlCode[3] );
    $b = hexdec( $htmlCode[4] . $htmlCode[5] );

    return $r . $g . $b;

    return $b + ( $g << 0x8 ) + ( $r << 0x10 );
  }

  // Source: https://stackoverflow.com/questions/12228644/how-to-detect-light-colors-with-php#answer-12228733
  public static function RGBToHSL( $RGB ) {
      $r = 0xFF & ( $RGB >> 0x10 );
      $g = 0xFF & ( $RGB >> 0x8 );
      $b = 0xFF & $RGB;

      $r = ( (float) $r ) / 255.0;
      $g = ( (float) $g ) / 255.0;
      $b = ( (float) $b ) / 255.0;

      $maxC = max( $r, $g, $b );
      $minC = min( $r, $g, $b );

      $l = ( $maxC + $minC ) / 2.0;

      if ( $maxC == $minC ) {
        $s = 0;
        $h = 0;
      } else {

        if ( $l < .5 ) {
          $s = ($maxC - $minC) / ($maxC + $minC);
        } else {
          $s = ($maxC - $minC) / (2.0 - $maxC - $minC);
        }

        if ( $r == $maxC ) {
          $h = ($g - $b) / ($maxC - $minC);
        }
        if ( $g == $maxC ) {
          $h = 2.0 + ($b - $r) / ($maxC - $minC);
        }
        if ( $b == $maxC ) {
          $h = 4.0 + ($r - $g) / ($maxC - $minC);
        }

        $h = $h / 6.0;
      }

    $h = (int) round( 255.0 * $h );
    $s = (int) round( 255.0 * $s );
    $l = (int) round( 255.0 * $l );

    return (object) Array (
      'hue' => $h,
      'saturation' => $s,
      'lightness' => $l
    );
  }

  public static function is_light_color( $color ) {
    $rgb = self::HTMLToRGB_bit_shift( $color );
    $hsl = self::RGBToHSL( $rgb );
    return $hsl->lightness > 125;
  }

}
