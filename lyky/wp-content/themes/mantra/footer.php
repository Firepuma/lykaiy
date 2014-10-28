<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */
?>	<div style="clear:both;"></div>

	</div> <!-- #forbottom -->
	</div><!-- #main -->


	<footer id="footer" role="contentinfo">
		<div id="colophon">
		
			<?php get_sidebar( 'footer' );?>
			
		</div><!-- #colophon -->

		<div id="footer2">
		
			<?php cryout_footer_hook(); ?>
			
		</div><!-- #footer2 -->

	</footer><!-- #footer -->

</div><!-- #wrapper -->

<?php	wp_footer(); ?>

</body>
</html>
