<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */
get_header(); 
if ($mantra_frontpage=="Enable" && is_front_page() ) {
mantra_frontpage_generator();
} 
else {
?>
		<section id="container">
	
			<div id="content" role="main">
			<?php cryout_before_content_hook(); ?>

	<?php get_template_part( 'content', 'page'); ?>

			<?php cryout_after_content_hook(); ?>
			</div><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #container -->


<?php } // else
get_footer(); ?>
