<?php
function red_dynamic_styles() { ?>
  <style id="dynamic-styles">

  <?php if ( Red_Style_Variables::get_main() === Red_Style_Variables::get_highlight() ) : ?>
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
add_action( 'wp_head', 'red_dynamic_styles' );
