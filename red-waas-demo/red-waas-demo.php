<?php
/*
 Plugin Name: Red WaaS Demo
 Plugin URI: https://redearthdesign.com/
 Description: Demo settings, content, and options for RED WaaS
 Version: 1.0.0
 Author: Red Earth Design
 Author URI: https://redearthdesign.com/
 License: Trade Secret
 */

/* NOTE: Copied from Beaer Builder core plugin. Modified to fit needs. */
if ( ! class_exists( 'Red_Waas_Demo' ) ) {

	/**
	 * Responsible for setting up builder constants, classes and includes.
	 */
	final class Red_Waas_Demo {

		/**
		 * Load the builder if it's not already loaded, otherwise
		 * show an admin notice.
		 *
		 * @since 1.8
		 * @return void
		 */
		static public function init() {
			// if ( ! function_exists( 'is_plugin_active' ) ) {
			// 	include_once ABSPATH . 'wp-admin/includes/plugin.php';
			// }

			self::define_constants();

			/* Load files based on if demo site or live site */
			if ( ! self::is_demo_site() || RED_IS_TEST_MODE ) {
				self::require_install_files();
				self::init_install_modules();
			} else {
				self::require_demo_files();
				self::init_demo_modules();
			}
		}

		public static function is_demo_site() {
			return get_site_url() === 'https://demo1.redearthdesign.com';
		}

		/**
		 * Define builder constants.
     *
		 * @return void
		 */
		static private function define_constants() {
			define( 'RED_WAAS_DEMO_VERSION', '1.0.0' );
			define( 'RED_WAAS_DEMO_DIR', get_template_directory() . '/red-waas-demo' );
			define( 'RED_WAAS_DEMO_URL', get_template_directory_uri() . '/red-waas-demo' );

			// /* Plugin File Paths */
			// define( 'RED_WAAS_DEMO_FILE', trailingslashit( dirname( dirname( __FILE__ ) ) ) . 'red-waas-demo/red-waas-demo.php' );
			// define( 'RED_WAAS_DEMO_DIR', plugin_dir_path( RED_WAAS_DEMO_FILE ) );
			// define( 'RED_WAAS_DEMO_URL', plugins_url( '/', RED_WAAS_DEMO_FILE ) );
		}

		/**
		 * Loads demo classes and includes.
		 *
		 * @return void
		 */
		static private function require_demo_files() {

			/**
       * Classes
       */

      require RED_WAAS_DEMO_DIR . '/inc/class-rwd-content.php';
		}

		/**
		 * Loads new site install classes and includes.
		 *
		 * @return void
		 */
		static private function require_install_files() {

			/**
			 * Classes
			 */

			require RED_WAAS_DEMO_DIR . '/inc/class-rwd-add-site-to-wp-main.php';
			require RED_WAAS_DEMO_DIR . '/inc/class-rwd-uninstall.php'; // here for now
		}

		/**
		 * Init demo modules
		 */
		static private function init_demo_modules() {
      Red_Waas_Demo_Content::init();
		}

		/**
		 * Init new site install modules
		 */
		static private function init_install_modules() {
			// Red_Waas_Demo_Add_Site_To_WP_Main::init();
		}

	}
}

Red_Waas_Demo::init();
