<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package red_underscores
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="grid-container">

				<?php while ( have_posts() ) : the_post(); ?>

					<div class="grid-100 tablet-grid-100 grid-parent">
						<div class="main-page-block">

						<?php get_template_part( 'template-parts/content', 'page' ); ?>

						</div> <!-- main-page-block -->
					</div>

				<?php endwhile; // End of the loop. ?>
                
			</div> <!-- grid-container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
