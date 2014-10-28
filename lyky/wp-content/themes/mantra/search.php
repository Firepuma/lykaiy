<?php
/**
 * The template for displaying Search results pages.
 *
 * @package Cryout Creations
 * @subpackage Mantra
 * @since Mantra 1.0
 */

get_header(); ?>

		<section id="container">
			<div id="content" role="main">
	<?php cryout_before_content_hook(); ?>
	
			<?php if ( have_posts() ) : ?>

				
				<?php mantra_content_nav( 'nav-above' ); ?>
				<span class="page-title"><?php printf( __( 'Search Results for: %s', 'mantra' ), '<span>' . get_search_query() . '</span>' ); ?></span>
	<div class="contentsearch"><?php get_search_form(); ?></div>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

									<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'content', get_post_format() );
				?>
										<?php endwhile; ?>

				<?php if($mantra_pagination=="Enable") mantra_pagination(); else mantra_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
	<span class="page-title"><?php printf( __( 'No search results for: %s', 'mantra' ), '<span>' . get_search_query() . '</span>' ); ?></span>
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'mantra' ); ?></h1>
					</header><!-- .entry-header -->
					<br /><div class="contentsearch"><?php get_search_form(); ?></div>
					</article><!-- #post-0 -->
				<?php endif; ?>


			<?php cryout_after_content_hook(); ?>
			</div><!-- #content -->
		<?php get_sidebar(); ?>
		</section><!-- #primary -->

<?php get_footer(); ?>
