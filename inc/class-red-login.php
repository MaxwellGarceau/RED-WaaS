<?php
/**
 * NOTE: This is a forked version of the RED Login plugin
 */

class Red_Login {

  public static function init() {
    add_filter( 'login_headerurl', __CLASS__ . '::login_logo_url' );
    add_filter( 'login_headertitle', __CLASS__ . '::login_logo_url_title' );
    add_action( 'login_enqueue_scripts', __CLASS__ . '::login_logo' );
    add_action( 'login_headertext', array( __CLASS__, 'login_logo_html' ) );
  }

  /* Make logo URL go to our site, not wordpress.org */
  public static function login_logo_url() {
    return home_url();
  }

  /* Make logo alt tag say our site name, not Powered by Wordpress */
  public static function login_logo_url_title() {
   return get_bloginfo( 'name' );
  }

  public static function login_logo_html( $login_header_text ) {
    $site_logo = get_field( 'site_logo', 'options' );
    $site_logo_url = wp_get_attachment_url( $site_logo );
    return '<img class="red-login-logo" src="' . $site_logo_url . '" />';
  }

  /* Customize Login Page */
  public static function login_logo() {
    $site_logo = get_field( 'site_logo', 'options' );
    $site_logo_url = wp_get_attachment_url( $site_logo );

    if ( $site_logo_url ) { ?>

      <style type="text/css" id="red-login-styles">
        /* Login Logo */
        body.login div#login h1 a {
          text-indent: unset;
          width: auto;
          height: auto;
          background-image: none;
        }
        body.login div#login h1 img.red-login-logo {
          width: 100%;
          object-fit: cover;
        }
      </style>

    <?php }
  }

}
Red_Login::init();
