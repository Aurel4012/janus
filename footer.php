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
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'janus' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'janus' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'janus' ), 'janus', '<a href="https://www.digitalstrategie.fr">Digital Stratégie</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
