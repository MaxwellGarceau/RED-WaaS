<?php
class Red_Social_Icons {
  public static function get_social_icons_html() {
    $social_links = get_field( 'social_links', 'options' );
    $facebook = $social_links['facebook'];
    $twitter = $social_links['twitter'];
    $instagram = $social_links['instagram'];
    $linked_in = $social_links['linked_in'];
    $email = $social_links['email'];

    if ( self::has_social_icons() ) :

      $html .= '<div class="red-social-icons">';

      if ( $facebook ) {
        $html .= '<a class="social-icon" href="' . $facebook . '" target="_blank"><i class="fab fa-facebook-f"></i></a>';
      }

      if ( $twitter ) {
        $html .= '<a class="social-icon" href="' . $twitter . '" target="_blank"><i class="fab fa-twitter"></i></a>';
      }

      if ( $instagram ) {
        $html .= '<a class="social-icon" href="' . $instagram . '" target="_blank"><i class="fab fa-instagram"></i></a>';
      }

      if ( $linked_in ) {
        $html .= '<a class="social-icon" href="' . $linked_in . '" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
      }

      if ( $email ) {
        $html .= '<a class="social-icon" href="mailto:' . $email . '" target="_blank"><i class="fas fa-envelope"></i></a>';
      }

      $html .= '</div>';

    endif;

    return $html;
  }

  public static function get_social_icons() {
    return get_field( 'social_links', 'options' );
  }

  public static function has_social_icons() {
    $social_links = self::get_social_icons();
    return ! empty( array_filter( $social_links, function( $social_link ) {
      return $social_link;
    } ) );
  }

  public static function social_icons_shortcode() {
    return self::get_social_icons_html();
  }
}
add_shortcode( 'red_social_icons', 'Red_Social_Icons::social_icons_shortcode' );
