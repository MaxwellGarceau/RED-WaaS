<?php
/**
 * NOTE: This is a forked version of the RED Login plugin
 */

class Red_Login {

  public static function init() {
    add_filter( 'login_headerurl', __CLASS__ . '::login_logo_url' );
    add_filter( 'login_headertitle', __CLASS__ . '::login_logo_url_title' );
    add_action( 'login_enqueue_scripts', __CLASS__ . '::login_css' );
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
  public static function login_css() {

    /**
     * Options
     */

    $site_logo = get_field( 'site_logo', 'options' );
    $site_logo_url = wp_get_attachment_url( $site_logo );
    $background_color = get_field( 'login_background_color', 'options' );
    $text_color = get_field( 'login_text_color', 'options' );

    /* Automatically set hover link defaults */
    if ( ! empty( $background_color ) ) {
      $text_hover_color = Red_Style_Variables::get_highlight_hover();

      /* Default dark link color */
      if ( Red_Automatic_Colors::is_light_color( $background_color ) && Red_Automatic_Colors::is_light_color( $text_hover_color ) ) {
        $text_hover_color = '#4a4a4a';
      }

      /* Default light link color */
      if ( ! Red_Automatic_Colors::is_light_color( $background_color ) && ! Red_Automatic_Colors::is_light_color( $text_hover_color ) ) {
        $text_hover_color = '#d1d1d1';
      }

    }

    /**
     * Compile CSS
     */

    ob_start();

    if ( $site_logo_url ) { ?>

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

      <?php
    }

    if ( $background_color ) { ?>

      /* Background Color */
      body.login {
        background-color: <?php echo $background_color; ?>;
      }

      <?php
    }

    if ( $text_color ) { ?>

      /* Text Color */
      body.login #nav a,
      body.login #backtoblog a {
        color: <?php echo $text_color; ?>;
      }

      /* Text Hover Color */
      body.login #nav a:hover,
      body.login #nav a:focus,
      body.login #backtoblog a:hover,
      body.login #backtoblog a:focus {
        color: <?php echo $text_link_color; ?>;
      }

      <?php
    }

    if ( isset( $text_hover_color ) && $text_hover_color ) { ?>

      /* Text Hover Color */
      body.login #nav a:hover,
      body.login #nav a:focus,
      body.login #backtoblog a:hover,
      body.login #backtoblog a:focus {
        color: <?php echo $text_hover_color; ?>;
      }

      <?php
    }

    $css = ob_get_clean();

    /**
     * Output CSS if any exists
     */

    if ( ! empty( $css ) ) { ?>

      <style type="text/css" id="red-login-styles">
        <?php echo $css; ?>
      </style>

    <?php }
  }

}
Red_Login::init();
