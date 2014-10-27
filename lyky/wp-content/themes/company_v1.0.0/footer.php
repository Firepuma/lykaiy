<?php 
	$themename = wp_get_theme()->Name;
	$shortname = strtolower(wp_get_theme()->Name);
?>
	
	<div class="clear"></div>
	
	<?php if(get_option($shortname.'_footer_ad_enable') == 'on') { ?>
		<div class="footer-ad">
			<?php echo get_option($shortname.'_footer_ad_code'); ?>
		</div><!-- .footer-ad -->
	<?php } ?>

	<footer id="footer">
	
		<?php if ( is_active_sidebar( 'footer-col-1' ) || is_active_sidebar( 'footer-col-2' ) || is_active_sidebar( 'footer-col-3' ) || is_active_sidebar( 'footer-col-4' )) { ?>
		
			<div id="footer-columns">
				<div class="container">
			
					<div class="footer-column-1">
						<?php if ( is_active_sidebar( 'footer-col-1' ) ) :  dynamic_sidebar( 'footer-col-1'); endif; ?>
					</div><!-- .footer-column-1 -->
					
					<div class="footer-column-2">
						<?php if ( is_active_sidebar( 'footer-col-2' ) ) :  dynamic_sidebar( 'footer-col-2'); endif; ?>
					</div><!-- .footer-column-2 -->
	
					<div class="footer-column-3">
						<?php if ( is_active_sidebar( 'footer-col-3' ) ) :  dynamic_sidebar( 'footer-col-3'); endif; ?>
					</div><!-- .footer-column-3 -->
	
					<div class="footer-column-4">
						<?php if ( is_active_sidebar( 'footer-col-4' ) ) :  dynamic_sidebar( 'footer-col-4'); endif; ?>
					</div><!-- .footer-column-4 -->								
								
					<div class="clear"></div>
					
				</div><!-- .container -->
					
			</div><!-- #footer-columns -->
		
		<?php } ?>
				
		<div id="copyright" class="container clearfix">
		<div class="left">
				<p><img src="<?php echo get_option($shortname.'_footer_logo'); ?>" alt="<?php bloginfo('name'); ?>" / >
				
					<?php if(get_option($shortname.'_rss_link') <> null) : ?>
						<a href="<?php echo get_option($shortname.'_rss_link'); ?>"><i class="icon-rss"></i></a>
					<?php endif; ?>
					
					<?php if(get_option($shortname.'_subscription_link') <> null) : ?>
						<a href="<?php echo get_option($shortname.'_subscription_link'); ?>"><i class="icon-envelope-alt"></i></a>
					<?php endif; ?>

					<?php if(get_option($shortname.'_twitter_link') <> null) : ?>
						<a href="<?php echo get_option($shortname.'_twitter_link'); ?>"><i class="icon-twitter"></i></a>
					<?php endif; ?>
														
					<?php if(get_option($shortname.'_facebook_link') <> null) : ?>
						<a href="<?php echo get_option($shortname.'_facebook_link'); ?>"><i class="icon-facebook"></i></a>
					<?php endif; ?>

					<?php if(get_option($shortname.'_google_plus_link') <> null) : ?>
						<a href="<?php echo get_option($shortname.'_google_plus_link'); ?>"><i class="icon-google-plus"></i></a>
					<?php endif; ?>				
				</p>
		</div>

				<div class="right">

				<p>&copy; <?php echo mysql2date('Y',current_time('timestamp')); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>. <?php echo get_option($shortname.'_footer_credit'); ?></p>
				</div>				
		</div><!-- #copyright -->
		
	</footer><!-- #footer -->
	
<?php wp_footer(); ?>

</body>
</html>