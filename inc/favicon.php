<?php
function red_favicon() {
  $favicon = get_field( 'favicon', 'options' );
  if ( $favicon ) {
    $favicon_url = wp_get_attachment_url( $favicon );
    echo '<link rel="shortcut icon" href="' . $favicon_url . '?v=2" />';
  }
}
add_action( 'wp_head', 'red_favicon' );
add_action( 'admin_head', 'red_favicon' );

function red_apple_touch_icon() {
  $favicon = get_field( 'favicon', 'options' );
  if ( $favicon ) {
    $favicon_url = wp_get_attachment_url( $favicon );
    echo '<link rel="apple-touch-icon" href="' . $favicon_url . '" />';
  }
}
add_action( 'wp_head', 'red_apple_touch_icon' );
