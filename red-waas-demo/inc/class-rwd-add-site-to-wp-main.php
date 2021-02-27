<?php
class Red_Waas_Demo_Add_Site_To_WP_Main {

  public static $consumer_key = 'ck_5c108c41ebc12b62248e2e1df3c0443b495e40ea';
  public static $consumer_secret = 'cs_4c64614b657fdbf2af575523955bb7f254531529';

  // public static function init() {
  //   // add_action( 'init', __CLASS__ . '::add_site_to_main_wp' );
  // }

 /****************************************************
  * Trigger
  ****************************************************/

  public static function add_site_to_main_wp() {
    if ( self::wp_main_child_exists() ) {
      $all_sites_resp = self::get_all_sites();
      if ( wp_remote_retrieve_response_code( $all_sites_resp ) == 200 ) {
        $all_sites = json_decode( wp_remote_retrieve_body( $all_sites_resp ), true );
        $this_url = get_site_url();
        $has_this_site = array_search( $this_url, array_column( $all_sites, 'url' ) ) !== false;
        if ( ! $has_this_site ) {
          self::refresh_main_wp_child();
          $add_site_resp = self::add_site_request();
          if ( is_wp_error( $add_site_resp ) ) {
            // Admin error message here
            write_log( 'This site was not added to the Main WP master dashboard. More info below.' );
            write_log( $add_site_resp );
            wp_die( 'This site was not added to the Main WP master dashboard. Response in the error log (if it was enabled).' );
          } else {
            wp_die( 'Site successfully added! Back to <a href="' . get_site_url() . '/wp-admin/admin.php?page=theme-settings' . '">theme settings</a>.' );
          }
        } else {
          wp_die( 'This site has already been added to Main WP.' );
        }
      } else {
        write_log( 'Could not get sites from Main WP.' );
        write_log( $all_sites_resp );
        wp_die( 'Could not get sites from Main WP. Response in the error log (if it was enabled).' );
      }
    } else {
      wp_die( 'Main WP Child is not installed on this site.' );
    }
  }

 /****************************************************
  * Helpers
  ****************************************************/

  public static function wp_main_child_exists() {
    $plugins = get_plugins();
    return isset( $plugins['mainwp-child/mainwp-child.php'] );
  }

  public static function get_red_admin_username() {
    $red_admin_username = '';
    if ( username_exists( 'redearth' ) ) {
      $red_admin_username = 'redearth';
    } else if ( username_exists( 'ootpsupport' ) ) {
      $red_admin_username = 'ootpsupport';
    } else {
      /* If red user names don't exist on site just grab the first name from all the admins */
      $args = array( 'role__in' => array( 'administrator' ) );
      $users = get_users( $args );
      if ( ! empty( $users ) ) {
        $red_admin_username = $users[0]->user_login;
      }
    }
    return $red_admin_username;
  }

 /****************************************************
  * Core Functionality
  ****************************************************/

  public static function refresh_main_wp_child() {
    if ( is_plugin_active( 'mainwp-child/mainwp-child.php' ) ) {
      deactivate_plugins( 'mainwp-child/mainwp-child.php' );
    }
    activate_plugins( 'mainwp-child/mainwp-child.php' );
  }

  public static function get_all_sites() {
    $url = 'https://demo1.redearthdesign.com/wp-json/mainwp/v1/sites/all-sites?consumer_key=' . self::$consumer_key . '&consumer_secret=' . self::$consumer_secret;
    $headers = array();
    $headers['Content-Type'] = 'application/json; charset=utf-8';
    $resp = wp_remote_get(
      $url,
      array(
        'method'  => 'GET',
        'timeout' => 45,
        'headers' => $headers,
        // 'body'    => $body,
      )
    );
    return $resp;
  }

  public static function add_site_request() {
    $url = 'https://demo1.redearthdesign.com/wp-json/mainwp/v1/site/add-site';
    $uniqueId = get_option( 'mainwp_child_uniqueId' ) ? get_option( 'mainwp_child_uniqueId' ) : '';
    $admin = self::get_red_admin_username();
  	$body = array(
  		'consumer_key'    => self::$consumer_key,
  		'consumer_secret' => self::$consumer_secret,
  		'name' => get_bloginfo( 'name' ),
  		'url' => get_site_url(),
  		'admin' => $admin,
      'uniqueid' => $uniqueId,
  	);
  	$body = wp_json_encode( $body );
  	$headers = array();
  	$headers['Content-Type'] = 'application/json; charset=utf-8';
  	$resp = wp_remote_post(
  		$url,
  		array(
  			'method'  => 'POST',
  			'timeout' => 45,
  			'headers' => $headers,
  			'body'    => $body,
  		)
  	);
    return $resp;
  }
}
