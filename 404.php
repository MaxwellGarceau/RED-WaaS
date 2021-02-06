<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package red_underscores
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="grid-container">

				<div class="grid-100 grid-parent">
					<div class="main-page-block">

						<section class="error-404 not-found">
							<header class="page-header">
								<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'red_underscores' ); ?></h1>
							</header><!-- .page-header -->

							<div class="page-content">
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'red_underscores' ); ?></p>

								<?php get_search_form(); ?>

								<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

								<?php if ( red_underscores_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
								<div class="widget widget_categories">
									<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'red_underscores' ); ?></h2>
									<ul>
									<?php
										wp_list_categories( array(
											'orderby'    => 'count',
											'order'      => 'DESC',
											'show_count' => 1,
											'title_li'   => '',
											'number'     => 10,
										) );
									?>
									</ul>
								</div><!-- .widget -->
								<?php endif; ?>

								<?php
									/* translators: %1$s: smiley */
									$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'red_underscores' ), convert_smilies( ':)' ) ) . '</p>';
									the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
								?>

								<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

							</div><!-- .page-content -->
						</section><!-- .error-404 -->


					</div> <!-- main-page-block -->
				</div>

			</div> <!-- grid-container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
