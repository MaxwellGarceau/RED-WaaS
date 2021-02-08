<?php
/**
 * All the variables that are set in the admin or other global variables that
 * need to be controlled from a single location are called from here.
 */
class Red_Style_Variables {
  public static function init() {
    add_action( 'wp_head', __CLASS__ . '::red_print_style_variables' );
    add_action( 'wp_head', __CLASS__ . '::red_dynamic_styles' );
  }

  public static function get_main() {
    return get_field( 'color_main', 'options' );
  }
  public static function get_secondary() {
    return get_field( 'color_secondary', 'options' );
  }
  public static function get_highlight() {
    return get_field( 'color_highlight', 'options' );
  }
  public static function get_highlight_hover() {
    return get_field( 'color_highlight_hover', 'options' );
  }
  public static function get_header_top_background() {
    return get_field( 'header_top_background', 'options' );
  }
  public static function get_header_main_background() {
    return get_field( 'header_main_background', 'options' );
  }
  public static function get_text_color() {
    return '#231f20';
  }
  public static function get_dark_text_color() {
    return '#231f20';
  }
  public static function get_light_text_color() {
    return '#ffffff';
  }
  public static function get_dark() {
    return '#333333';
  }

  /**
   * Dynamic variables from the theme settings
   */
  public static function red_print_style_variables() {
  	/* Variables */

  	// Located in /inc/class-red-style-variables.php (to be able to call them from anywhere)
  	$main = self::get_main();
  	$secondary = self::get_secondary();
  	$highlight = self::get_highlight();
  	$highlight_hover = self::get_highlight_hover();
  	$text_color = self::get_text_color();
  	$dark = self::get_dark();
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

  public static function red_dynamic_styles() { ?>
    <style id="dynamic-styles">

    <?php if ( self::get_main() === self::get_highlight() ) : ?>
      /**
       * If main color is the same as the highlight color then make links nested in
       * header tags the secondary color for contrast
       */
      h1 a,
      h2 a,
      h3 a,
      h4 a,
      h5 a,
      h6 a {
      	color: var(--secondary);
      }
    <?php endif; ?>

    </style>
  <?php }
}
Red_Style_Variables::init();
