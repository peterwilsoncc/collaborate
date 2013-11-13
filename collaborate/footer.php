<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Collaborate
 * @since Collaborate 0.1
 */
?>
<footer class="footer foot">
	<?php
	if ( is_active_sidebar( 'footer-widget-area' ) ) :
		echo '<div class="widgetized widgetized--footer">';
		dynamic_sidebar( 'footer-widget-area' );
		echo '</div>';
	endif;
	?>
	
	<div class="colophon" role="contentinfo">
		<p><?php printf( __( 'Copyright &copy; %s', 'collaborate' ), get_bloginfo( 'name' ) ); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>