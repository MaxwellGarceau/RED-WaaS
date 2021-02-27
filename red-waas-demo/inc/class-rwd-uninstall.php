<?php
/* Only let this plugin run on the demo site */
class Red_Waas_Demo_Uninstall {

  public static function remove_demo_specific_code() {
    if ( get_site_url() !== 'https://demo1.redearthdesign.com' ) {
      self::delete_plugins();
    } else {
      $error_message = 'You clicked a button to remove demo specific content. However you are currently on <a href="' . get_site_url() . '">' . get_site_url() . '</a>. This error message is a safeguard to prevent deleting demo content on the demo site. If this is a mistake please contact the <a href="mailto:support@redearthdesign.com">webmaster</a>.';
      wp_die( $error_message );
    }
  }

  public static function delete_plugins() {
    $plugins_to_delete = array(
      // 'red-waas-demo/red-waas-demo.php',
      'mainwp/mainwp.php',
    );
    deactivate_plugins( $plugins_to_delete );
    delete_plugins( $plugins_to_delete );
  }

}
