<?php /*
 * Template Name: Three columns, Sidebars Left and Right
 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */
get_header(); ?>

		<section id="container">
	
			<div id="content" role="main">

	<?php get_template_part( 'content', 'page'); ?>

			</div><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #container -->


<?php get_footer(); ?>