<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package red_underscores
 */

?>

	</div><!-- #content -->

  <?php
    /**
     * Code for footer is in /templates/footer/footer-default.php.
     * If Beaver Builder Themer plugin is enabled and a footer is created then footer
     * is edited in Beaver Builder through the admin.
     */

    do_action( 'red_before_footer' );

    do_action( 'red_get_footer' );

    do_action( 'red_after_footer' );
  ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
