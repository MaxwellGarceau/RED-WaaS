<?php
function red_header_default() { ?>
  <header id="masthead" class="site-header" role="banner">

    <div class="grid-container">
      <div class="grid-100 grid-parent">

        <div class="grid-30">   
          <section id="logo-header-top">
                <a id="main-header-logo" href=" <?php echo esc_url( home_url( '/' ) ); ?> " rel="home"><img src="<?php echo get_stylesheet_directory_uri().'/images/logo.png' ?>" alt="Logo" /></a>
              </section>
          </div>

          <div class="grid-70">
          <nav id="site-navigation" class="main-navigation" role="navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'red_underscores' ); ?></button>
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
          </nav><!-- #site-navigation -->
        </div>

      </div>
    </div> <!-- grid-container -->

  </header><!-- #masthead -->
<?php }
  add_action( 'red_get_header', 'red_header_default' );
?>
