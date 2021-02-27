<?php
/* Only let this plugin run on the demo site */
class Red_Install {

  public static function init() {
    add_action( 'init', array( __CLASS__, 'remove_demo_specific_code' ), 999999 );
  }

  public static function remove_demo_specific_code() {
    if ( strpos( $_SERVER['HTTP_HOST'], 'demo1.redearthdesign.com' ) === false ) {
      self::delete_plugins();
    }
  }

  public static function delete_plugins() {
    $plugins_to_delete = array(
      'red-waas-demo/red-waas-demo.php',
      'mainwp/mainwp.php',
    );
    deactivate_plugins( $plugins_to_delete );
    // delete_plugins( $plugins_to_delete );
  }
}
Red_Install::init();
