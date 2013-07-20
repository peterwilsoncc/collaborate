<footer class="footer foot">
	<?php
	if ( is_active_sidebar( 'footer-widget-area' ) ) :
		echo '<div class="widgetized widgetized--footer">';
		dynamic_sidebar( 'footer-widget-area' );
		echo '</div>';
	endif;
	?>
</footer>
<?php wp_footer(); ?>
</body>
</html>