<div class="content">
	<main role="main" class="main">
		<!-- loop goes here -->
	</main>
	
	<?php
	if ( is_active_sidebar( 'main-sidebar' ) ) :
		echo '<div class="widgetized widgetized--sidebar">';
		dynamic_sidebar( 'main-sidebar' );
		echo '</div>';
	endif;
	?>
</div>