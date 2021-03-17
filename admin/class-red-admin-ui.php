<?php
class Red_Admin_UI {
  public static function init() {
    add_action( 'acf/init', __CLASS__ . '::theme_settings_init' );
    add_action( 'restrict_manage_posts', __CLASS__ . '::add_post_filter_to_themer_layouts_admin' );
    add_action( 'admin_init', __CLASS__ . '::default_bb_fl_theme_layouts_edit_page_to_current_template_layouts' );
    add_action( 'admin_enqueue_scripts', __CLASS__ . '::enqueue' );
    add_action( 'wp_head', array( __CLASS__, 'themer_layout_edit_control' ) );
  }

  // https://www.advancedcustomfields.com/resources/acf_add_options_page/
  public static function theme_settings_init() {
    // Check function exists.
    if ( function_exists('acf_add_options_page') ) {
      // Register options page.
      $option_page = acf_add_options_page(array(
        'page_title'    => __('Theme Settings'),
        'menu_title'    => __('Theme Settings'),
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'position'      => 31
      ));
    }
  }

  public static function enqueue() {
    wp_enqueue_style( 'admin-options', get_template_directory_uri() . '/admin/css/style.css' );
  }

  /***************************************************************************
   * Beaver Themer Admin - Extend UI
   ***************************************************************************/

  /**
   * Add category filters to BB Themer Layouts
   * Source: https://wordpress.stackexchange.com/questions/578/adding-a-taxonomy-filter-to-admin-list-for-a-custom-post-type
   */
  public static function add_post_filter_to_themer_layouts_admin() {
    // only display these taxonomy filters on desired custom post_type listings
    global $typenow;
    if ( $typenow == 'fl-theme-layout' ) {

      // create an array of taxonomy slugs you want to filter by - if you want to retrieve all taxonomies, could use get_taxonomies() to build the list
      $filters = array( 'fl-builder-template-category' );

      foreach ( $filters as $tax_slug ) {
  	    // retrieve the taxonomy object
  	    $tax_obj = get_taxonomy( $tax_slug );
  	    $tax_name = $tax_obj->labels->name;
  	    // retrieve array of term objects per taxonomy
  	    $terms = get_terms( $tax_slug );

  	    // output html for taxonomy dropdown filter
  	    echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
  	    echo "<option value=''>Show All $tax_name</option>";
  	    foreach ( $terms as $term ) {
          /* Filtering by post status so don't select filter */
          if ( isset( $_GET['post_status'] ) ) {
            $selected = '';
          }
  				/* Check that the category filter is in use */
  				else if ( isset( $_GET['fl-builder-template-category'] ) && ! empty( $_GET['fl-builder-template-category'] ) ) {
  					/* Output each select option line, check against the last $_GET to show the current option selected */
  					$selected = $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '';
  				} else {
  					/* If category filter is not in use then default to show Themer Layouts for currently selected template */
  					$selected = get_field( 'template_selector', 'options' ) == $term->slug ? ' selected="selected"' : '';
  				}
          echo '<option value='. $term->slug, $selected,'>' . $term->name .' (' . $term->count .')</option>';
  	    }
  	    echo "</select>";
      }

    }
  }

  /**
   * Default BB Themer Layouts edit.php page to current template selectors layouts
   * Source: https://wordpress.stackexchange.com/questions/52114/admin-page-redirect
   */
  public static function default_bb_fl_theme_layouts_edit_page_to_current_template_layouts() {
    global $pagenow;

    /* If we're navigating to the edit.php fl-theme-layout page and we haven't specified a category default the page to the current template selector category */
    if ( $pagenow == 'edit.php' && isset( $_GET['post_type'] ) && $_GET['post_type'] == 'fl-theme-layout' && ! isset( $_GET['fl-builder-template-category'] ) && ! isset( $_GET['post_status'] ) ) {
  		$current_template = get_field( 'template_selector', 'options' );
      wp_redirect( admin_url( 'edit.php?post_type=fl-theme-layout&fl-builder-template-category=' . $current_template ) );
      exit;
    }
  }

  /**
   * Prevent users ability to edit a BB page directly if a single themer layout is active for it
   */
  public static function themer_layout_edit_control() {
  	/* Bail early if no one is logged in */
  	if ( ! is_user_logged_in() ) {
  		return;
  	}

  	global $post;
  	$template = get_field( 'template_selector', 'option' );

  	/* Query themer layouts that are singular, set to this post, and show on this template */
  	$args = array(
  		'post_type' => 'fl-theme-layout',
  		'post_status' => array( 'publish' ),
  		'posts_per_page' => -1,
  		'meta_query' => array(
  			array(
  				'key' => '_fl_theme_layout_type',
  				'value' => array( 'singular' ),
  				'compare' => 'IN',
  			),
  			array(
  				'key' => '_fl_theme_builder_locations',
  				'value' => $post->ID,
  				'compare' => 'LIKE'
  			),
  			array(
  				'key' => '_fl_theme_builder_logic',
  				'value' => $template,
  				'compare' => 'LIKE'
  			),
  		),
  	);
  	$singular_themer_layouts_query = new WP_Query( $args );

  	/**
  	 * If any themer singular layouts are attached to this post, hide the default BB edit controls.
  	 * Hiding default controls will prevent users from editing page directly instead of assigned layout.
  	 */
  	if ( ! empty( $singular_themer_layouts_query->posts ) ) {
  		ob_start(); ?>
  		<style id="red-themer-layout-edit-control">
  			/**
  			 * Hides the ability to edit current page in beaver builder from the admin toolbar.
  			 * Prompts user to edit Themer Layouts.
  			 */
  			body:not(.fl-theme-layout-template-default) #wpadminbar #wp-admin-bar-fl-theme-builder-frontend-edit-link {
  				display: none;
  			}
  			body:not(.fl-theme-layout-template-default) #wpadminbar #wp-admin-bar-fl-builder-frontend-edit-link > a.ab-item {
  				pointer-events: none;
  			}
  			body:not(.fl-theme-layout-template-default) #wpadminbar #wp-admin-bar-fl-builder-frontend-edit-link {
  				cursor: pointer !important;
  			}
  			body:not(.fl-theme-layout-template-default) #wpadminbar #wp-admin-bar-fl-builder-frontend-edit-link-default {
  				padding: 0 0 6px;
  			}
  		</style>
  		<?php
  		echo ob_get_clean();
  	}
  }

}
Red_Admin_UI::init();
