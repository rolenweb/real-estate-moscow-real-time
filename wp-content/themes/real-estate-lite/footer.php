<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package real-estate-lite
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="col-center bottom-border">

	<div class="<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>three-col <?php else : ?>no-col<?php endif; ?>">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>

	<div class="<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>three-col <?php else : ?>no-col<?php endif; ?>">
		<?php dynamic_sidebar( 'footer-2' ); ?>
	</div>

	<div class="<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>three-col <?php else : ?>no-col<?php endif; ?>">
		<?php dynamic_sidebar( 'footer-3' ); ?>
	</div>

	<div class="<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>three-col <?php else : ?>no-col<?php endif; ?>">
		<?php dynamic_sidebar( 'footer-4' ); ?>
	</div>
	</div><!--col center-->
	<div class="col-center">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'real-estate-lite' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'real-estate-lite' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
<?php
$url = 'https://thepixeltribe.com/template/real-estate/';
$link = sprintf( wp_kses( __( 'Real Estate Theme by <a href="%s">PixelTribe</a>.', ' real-estate-lite' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) );
echo $link;
?>


		</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
