<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>

	<div class="page-header">
	
		<h1 class="page-title container"><?php the_title(); ?></h1>
		
	</div><!-- .page-header -->

	<div id="main" class="clearfix">

		<div id="content" class="one-col">
		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
			<div class="entry-content">
			
				<?php the_content(''); ?>
								
			</div><!-- .entry-content -->
			
			<?php edit_post_link('('.__('Edit', 'junkie').')', '<span class="entry-edit">', '</span>'); ?>
				
			<?php endwhile; endif; ?>
			
		</div><!-- #content .one-col -->

	</div><!-- #main -->

	
<?php get_footer(); ?>