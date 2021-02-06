<?php
/**
 * red_underscores functions and definitions
 *
 * @package red_underscores
 */

if ( ! function_exists( 'red_underscores_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function red_underscores_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on red_underscores, use a find and replace
	 * to change 'red_underscores' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'red_underscores', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'red_underscores' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'red_underscores_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Additional image sizes - uncomment if appropriate
	if ( function_exists( 'add_image_size' ) ) {
	 	//add_image_size( 'header-image', 1800, 200, true ); //cropped
	 	//add_image_size( 'post-featured-image', 768, 350, true);
        add_image_size( 'midsized-image', 600, '', false);
        add_image_size( 'wide-image', 1200, '', false);
	}
}
endif; // red_underscores_setup
add_action( 'after_setup_theme', 'red_underscores_setup' );

// Make new image size available in the editor - uncomment if you add additional images sizes
add_filter('image_size_names_choose', 'custom_image_sizes');
function custom_image_sizes($sizes) {
	$addsizes = array(
		"midsized-image" => __( "Mid-Sized Image"),
		"wide-image" => __( "Wide Image")
		);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function red_underscores_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'red_underscores_content_width', 1200 );
}
add_action( 'after_setup_theme', 'red_underscores_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function red_underscores_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'red_underscores' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'red_underscores_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

// Add unsemantic grid system with support for IE7+
function add_unsemantic_grid () {
    // html5 shiv for IE
    echo '<!--[if lt IE 9]>';
    echo '<script src="'.get_template_directory_uri() . '/unsemantic/scripts/html5.js"></script>';
    echo '<![endif]-->';

    // css reset
    echo '<link rel="stylesheet" href="'.get_template_directory_uri() . '/unsemantic/stylesheets/reset.css" />';

    // unsemantic grid for all non-IE browsers and for certain IEs
    echo '<!--[if (gt IE 8) | (IEMobile)]><!-->';
    echo '<link rel="stylesheet" href="'.get_template_directory_uri() . '/unsemantic/stylesheets/unsemantic-grid-responsive-tablet.css" />';
    echo '<!--<![endif]-->';

    // unsemantic grid for IE
    echo '<!--[if (lt IE 9) & (!IEMobile)]>';
    echo '<link rel="stylesheet" href="'.get_template_directory_uri() . '/unsemantic/stylesheets/ie.css" />';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_unsemantic_grid', 5);

/**
 * Dynamic variables from the theme settings
 */
function red_print_style_variables() {
	/* Variables */

	// Located in /inc/class-red-style-variables.php (to be able to call them from anywhere)
	$main = Red_Style_Variables::get_main();
	$secondary = Red_Style_Variables::get_secondary();
	$highlight = Red_Style_Variables::get_highlight();
	$highlight_hover = Red_Style_Variables::get_highlight_hover();
	$text_color = Red_Style_Variables::get_text_color();
	$dark = Red_Style_Variables::get_dark();
	?>

	<style id="red-style-variables">
	:root { /* usage    color: var(--highlight); */
		--main: <?php echo $main ?>;
		--secondary: <?php echo $secondary ?>;
			--highlight: <?php echo $highlight ?>;
			--highlight-hover: <?php echo $highlight_hover ?>;
			--text-color: <?php echo $text_color ?>;
			--dark: <?php echo $dark ?>;
	}
	</style>

	<?php
}
add_action( 'wp_head', 'red_print_style_variables' );

function red_underscores_scripts() {
  wp_enqueue_style( 'red_underscores-style', get_stylesheet_uri(), array(), filemtime(get_template_directory()) );

	wp_enqueue_script( 'red_underscores-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'red_underscores-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// wp_enqueue_script(
	// 	'functions',
	// 	get_stylesheet_directory_uri() . '/js/functions.js',
	// 	array( 'jquery' )
	// );
	// wp_enqueue_script( 'retina_js', get_template_directory_uri() . '/js/retina.min.js', '', '', true );
}
add_action( 'wp_enqueue_scripts', 'red_underscores_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Load theme templates
 */
require get_template_directory() . '/templates/templates-loader.php';

/**
 * Add theme support for beaver builder
 */
require get_template_directory() . '/inc/beaver-builder/class-red-add-theme-support-for-bb.php';

/**
 * Red Helper Functions
 */
require get_template_directory() . '/inc/class-red-helper.php';

/**
 * Red Automatic Colors
 */
require get_template_directory() . '/inc/class-red-style-variables.php';

/**
 * Red Automatic Colors
 */
require get_template_directory() . '/inc/class-red-automatic-colors.php';

/**
 * Custom Connection Fields
 */
require get_template_directory() . '/inc/beaver-builder/class-red-connection-fields.php';
Red_Connection_Fields::init(); // Loads hooks

/**
 * Favicon
 */
require get_template_directory() . '/inc/favicon.php';

/**
 * Dynamic Styles
 */
require get_template_directory() . '/inc/dynamic-styles.php';

/**
 * Social Icons
 */
require get_template_directory() . '/inc/social-icons.php';

/**
 * Custom functions that act independently of the theme templates.
 */
//require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';

function show_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>

	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'say_theme' ); ?></h2>
		<div class="nav-links">
			<div class="nav-previous"><?php previous_post_link('%link', '<span class="nav-left"><img src="'.get_template_directory_uri().'/images/nav-icon-left.png" /></span><span class="nav-title">%title</span>', TRUE) ?></div>
			<div class="nav-next"><?php next_post_link('%link', '<span class="nav-title">%title</span><span class="nav-right"><img src="'.get_template_directory_uri().'/images/nav-icon-right.png" /></span>', TRUE) ?></div>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

function wp_pagenavi() {
	global $wp_query, $wp_rewrite;
  	$pages = '';
  	$max = $wp_query->max_num_pages;
  	if (!$current = get_query_var('paged')) $current = 1;
  	$args['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  	$args['total'] = $max;
  	$args['current'] = $current;

  	$total = 1;
  	$args['mid_size'] = 4;
  	$args['end_size'] = 1;
  	$args['prev_text'] = '<img src="'.get_template_directory_uri().'/images/nav-icon-left.png" />';
  	$args['next_text'] = '<img src="'.get_template_directory_uri().'/images/nav-icon-right.png" />';

  	if ($max > 1) echo '
	<div class="wp-pagenavi">';
 	//if ($total == 1 && $max > 1) $pages = '';
 	echo $pages . paginate_links($args);
 	if ($max > 1) echo '</div>
	';
}

wp_enqueue_style( 'load-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:ital,wght@0,400;1,400;1,500;1,600;1,700;1,800' );


// https://www.advancedcustomfields.com/resources/acf_add_options_page/
add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

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


// Redirect tags, search, and category requests to homepage
function red_underscores_redirect() {
   if( is_search()  || is_404() ) {
        wp_redirect( home_url(), 301 );
        exit();
    }
}
add_action( 'template_redirect', 'red_underscores_redirect' );

/* Tech Support Role */
function red_add_tech_support_role() {
	add_role( 'tech-support', 'Tech Support', get_role( 'administrator' )->capabilities );
}
add_action( 'init', 'red_add_tech_support_role' );
