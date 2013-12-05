<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <main>
 *
 * @package WordPress
 * @subpackage Collaborate
 * @since Collaborate 0.1
 */
?><!DOCTYPE html>
<html <?php body_class( 'no-js' ); ?> <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|' ); ?></title>
	<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'')+' js'})(document.documentElement)</script>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body class="hfeed">
	<header role="banner">

		<div class="site">
			<h1 class="site__name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<p class="site__strap-line"><?php bloginfo( 'description' ); ?></p>
		</div>

		<?php 
			$primary_nav = wp_nav_menu( array( 
				'theme_location' => 'primary',
				'container' => false,
				'menu_class' => 'nav primary-nav',
				'fallback_cb' => false,
				'depth' => 3,
				'echo' => 0
			) );

			if ( $primary_nav ) :
				echo '<nav role="navigation">';
				echo $primary_nav;
				echo '</nav>';
			endif; 

			if ( is_active_sidebar( 'header-widget-area' ) ) :
				echo '<div class="widgetized widgetized--header">';
				dynamic_sidebar( 'header-widget-area' );
				echo '</div>';
			endif;
		?>
		
	</header>