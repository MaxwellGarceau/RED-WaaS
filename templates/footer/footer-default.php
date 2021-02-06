<?php
function red_footer_default() { ?>
  <footer id="colophon" class="site-footer" role="contentinfo">

        <div class="grid-container">
            <div class="grid-100 grid-parent">

            <div class="site-info">
              <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'red_underscores' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'red_underscores' ), 'WordPress' ); ?></a>
              <span class="sep"> | </span>
              <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'red_underscores' ), 'red_underscores', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
            </div><!-- .site-info -->

            </div>
        </div> <!-- grid-container -->

  </footer><!-- #colophon -->
<?php }
  add_action( 'red_get_footer', 'red_footer_default' );
?>