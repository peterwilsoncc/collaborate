<?php
/**
 * Collaborate functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Collaborate
 * @since Collaborate 0.1
 */

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Collaborate supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Collaborate 1.0
 */
function collaborate_setup() {
	/*
	 * Makes Collaborate available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Collaborate, use a find and replace
	 * to change 'collaborate' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'collaborate', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'collaborate' ) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );

}
add_action( 'after_setup_theme', 'collaborate_setup' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Collaborate 1.0
 */
function collaborate_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Header Widget Area', 'collaborate' ),
		'id' => 'header-widget-area',
		'description' => __( 'Appears in the header of the theme', 'collaborate' ),
		'before_widget' => '<div id="%1$s" class="widget widget--header %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<span class="widget__title">',
		'after_title' => '</span>',
	) );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'collaborate' ),
		'id' => 'main-sidebar',
		'description' => __( 'Appears on posts and pages', 'collaborate' ),
		'before_widget' => '<aside id="%1$s" class="widget widget--sidebar %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget__title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'collaborate' ),
		'id' => 'footer-widget-area',
		'description' => __( 'The widget area in the footer', 'collaborate' ),
		'before_widget' => '<div id="%1$s" class="widget widget--footer %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget__title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'collaborate_widgets_init' );