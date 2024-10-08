<?php
/* Customizations to the ACF theme settings page */
class Red_ACF_Options {

  public static function init() {
    add_action( 'init', array( __CLASS__, 'init_ajax' ) );
    add_action( 'acf/input/admin_head', array( __CLASS__, 'dev_ops_meta_box' ), 20 );
  }

  /**
   * Add button to remove demo plugins
   */
   public static function init_ajax() {
     if ( class_exists( 'Red_Ajax' ) ) {
       if ( class_exists( 'Red_Waas_Demo_Uninstall' ) ) {
         $args = self::uninstall_demo_plugins_ajax_args();
         new Red_Ajax( $args ); // Sets up the ajax handles
       }

       if ( class_exists( 'Red_Waas_Demo_Add_Site_To_WP_Main' ) ) {
         $args = self::add_site_to_main_wp_ajax_args();
         new Red_Ajax( $args ); // Sets up the ajax handles
       }

       // if ( class_exists( 'Red_Image_Optimization' ) ) {
       //   $args = self::resize_logo_to_2x_wp_ajax_args();
       //   new Red_Ajax( $args ); // Sets up the ajax handles
       // }
     } else {
       /* Error Message */
       write_log( 'Red_Ajax not available in ' . dirname( __FILE__ ) );
     }
   }

   public static function uninstall_demo_plugins_ajax_args() {
     $action = 'remove_demo_specific_code'; // name that goes on all ajax handlers, also the nonce handler
     return array(
           'callback' => array( new Red_Waas_Demo_Uninstall, $action ),
           'action' => $action,
           'nonce' => wp_create_nonce( $action ),
         );
   }

   public static function add_site_to_main_wp_ajax_args() {
     $action = 'add_site_to_main_wp'; // name that goes on all ajax handlers, also the nonce handler
     return array(
           'callback' => array( new Red_Waas_Demo_Add_Site_To_WP_Main, $action ),
           'action' => $action,
           'nonce' => wp_create_nonce( $action ),
         );
   }

   // public static function resize_logo_to_2x_wp_ajax_args() {
   //   $action = 'resize_logo_to_2x'; // name that goes on all ajax handlers, also the nonce handler
   //   return array(
   //         'callback' => array( new Red_ACF_Validation, $action ),
   //         'action' => $action,
   //         'nonce' => wp_create_nonce( $action ),
   //       );
   // }

   public static function render_dev_ops_content() {
     ob_start();

     /* Uninstall Demo Plugins */
     if ( class_exists( 'Red_Waas_Demo_Uninstall' ) ) {
       $args = self::uninstall_demo_plugins_ajax_args();
       echo '<a class="button button-primary button-large" href="' . admin_url( 'admin-ajax.php?action=' . $args['action'] . '&nonce=' . $args['nonce'] ) . '">Uninstall Demo Plugins</a>';
     }

     /* Add site to Main WP */
     if ( class_exists( 'Red_Waas_Demo_Add_Site_To_WP_Main' ) ) {
       $args = self::add_site_to_main_wp_ajax_args();
       echo '<a class="button button-primary button-large" href="' . admin_url( 'admin-ajax.php?action=' . $args['action'] . '&nonce=' . $args['nonce'] ) . '">Add Site to Main WP</a>';
     }

     // /* Resize Image Logo to @2x */
     // if ( class_exists( 'Red_Image_Optimization' ) ) {
     //   $args = self::resize_logo_to_2x_wp_ajax_args();
     //   echo '<a class="button button-primary button-large" href="' . admin_url( 'admin-ajax.php?action=' . $args['action'] . '&nonce=' . $args['nonce'] ) . '">Resize Logo to @2x (currently hardcoded to 412px)</a>';
     // }

     $output = ob_get_clean();

     /* No output fallback message */
     if ( $output == '' ) {
       $output = 'These options are only available when not on the demo site.';
     }

     echo $output;
   }

   public static function dev_ops_meta_box() {
     $screen = get_current_screen();
     $user = wp_get_current_user();
      if ( $screen->id == 'toplevel_page_theme-settings' && in_array( 'tech-support', (array) $user->roles ) ) {
        add_meta_box(
           'dev-ops',
           __( 'Dev Ops' ),
           array( __CLASS__, 'render_dev_ops_content' ),
           'acf_options_page',
           'normal',
           'high'
        );
      }
   }
}
Red_ACF_Options::init();
