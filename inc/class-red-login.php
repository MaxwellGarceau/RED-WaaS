<?php
/**
 * NOTE: This is a forked version of the RED Login plugin
 */

class Red_Login {

  public static function init() {
    add_filter( 'login_headerurl', __CLASS__ . '::login_logo_url' );
    add_filter( 'login_headertitle', __CLASS__ . '::login_logo_url_title' );
    add_action( 'login_enqueue_scripts', __CLASS__ . '::login_logo' );
  }

  /* Make logo URL go to our site, not wordpress.org */
  public static function login_logo_url() {
    return home_url();
  }

  /* Make logo alt tag say our site name, not Powered by Wordpress */
  public static function login_logo_url_title() {
   return get_bloginfo( 'name' );
  }

  /* Customize Login Page */
  public static function login_logo() {
    $site_logo = get_field( 'site_logo', 'options' );
    $site_logo_url = wp_get_attachment_url( $site_logo );

    if ( $site_logo_url ) { ?>

      <style type="text/css" id="red-login-styles">
        /* Login Logo */
        body.login div#login h1 a {
          background-image: url(<?php echo $site_logo_url; ?>);
          background-size: contain;
          background-position: center;
          width: 320px;
          height: 320px;
        }
      </style>

    <?php }
  }

}
Red_Login::init();
