<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Janus
 * @subpackage janustheme
 * @since janus 1.0.0
 */

?>

	<footer id="colophon" class="site-footer mx-2">
		<div class="site-info container-fluid my-2 p-2  rgba-white-strong rounded z-depth-1">
			
			  <?php
			  /* translators: 1: Theme name, 2: Theme author. */
			  printf( esc_html__( 'Theme: %1$s par %2$s.', 'janus' ), 'janus', '<a href="https://www.digitalstrategie.fr">Digital Stratégie</a>' );
			  ?>
		
		

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
