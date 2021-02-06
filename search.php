<?php
/**
 * The template for displaying search results pages.
 *
 * @package red_underscores
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="grid-container">

			<?php if ( have_posts() ) : ?>

				<div class="grid-70 tablet-grid-100 grid-parent">
					<div class="main-page-block">

					<header class="page-header">
						<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'red_underscores' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header><!-- .page-header -->

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );
						?>

					<?php endwhile; ?>

					<?php //the_posts_navigation(); 
						if(function_exists('wp_pagenavi')) {
							wp_pagenavi();
						} else { ?>
							<div class="navigation"><p><?php posts_nav_link('&#8734;','&laquo;&laquo; Previous Posts','Older Posts &raquo;&raquo;'); ?></p></div>
						<?php 
						} 
					?>

					</div> <!-- main-page-block -->
				</div>

			<?php else : ?>

				<div class="grid-70 tablet-grid-100 grid-parent">
					<div class="main-page-block">

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

					</div> <!-- main-page-block -->
				</div>

			<?php endif; ?>

				<div class="grid-30 tablet-grid-100 grid-parent">
					<?php get_sidebar(); ?>
				</div>

			</div> <!-- grid-container -->
		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
