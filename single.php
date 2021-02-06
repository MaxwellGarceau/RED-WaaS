<?php
/**
 * The template for displaying all single posts.
 *
 * @package red_underscores
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="grid-container">

				<?php while ( have_posts() ) : the_post(); ?>

					<div class="grid-70 tablet-grid-100 grid-parent">
						<div class="main-page-block">

						<?php get_template_part( 'template-parts/content', 'single' ); ?>

						<?php //the_post_navigation(); 
							show_post_navigation();
						?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>

						</div> <!-- main-page-block -->
					</div>

				<?php endwhile; // End of the loop. ?>

				<div class="grid-30 tablet-grid-100 grid-parent">
					<?php get_sidebar(); ?>
				</div>

			</div> <!-- grid-container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
