<?php
/*
Template Name: about
*/
?><?php get_header(); ?>
<div id="all">			
<!--Container-->
<div id="container">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
     <div id="content">
	<!--content_text-->
		<div class="content_text">
		<div class="content_banner">
		<div class="text"><?php the_content(); ?>
			 </div>
			 </div>
        </div><!--content_text-->
		 <div id="comments" class="comment"><?php comments_template('', true); ?></div>
      </div>
<?php endwhile;?><?php endif; ?>

   <?php get_sidebar(); ?>	
</div><!--Container End-->
</div><!--all-->



<?php get_footer(); ?>