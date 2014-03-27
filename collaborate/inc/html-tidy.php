<?php
/**
 * This file will contain all our actions and filters to clean up extra CSS classes that WordPress adds around the place
 */

/**
 * Let's remove some of the body_class styles we don't need.
 */

if ( ! function_exists( 'collaborate_filter_body_class' ) ) {
	function collaborate_filter_body_class( $classes, $custom_classes ){

		$post_id = get_the_ID();

		// Remove all the WordPress body classes
		unset( $classes );
		$classes = array();

		if ( is_home() || is_archive() ) {
			$classes[] = 'list';
			if ( 'post' == get_post_type() ) {
				$classes[] = 'all_blog';
			}
		}
		if ( is_search() ) {
			$classes[] = 'list';
		}
		if ( is_singular() || is_404() ) {
			$classes[] = 'singular';

			if ( ( 'post' == get_post_type() ) || ( 'attachment' == get_post_type() ) ) {
				$classes[] = 'all_blog';
			}
		}

		if ( is_page_template() ) {
			$template_name = get_post_meta( $post_id, '_wp_page_template', true );
			$template_name = preg_replace( '#([\w\d]+)\/#', '', $template_name );
			$template_name = str_replace( '.php', '', $template_name );
			$classes[] = $template_name;
		}

		if ( is_admin_bar_showing() ) {
			$classes[] = 'admin-bar';
		}

		if ( ! empty( $custom_classes ) ) {
			if ( ! is_array( $custom_classes ) ) {
				$custom_classes = preg_split( '#\s+#', $custom_classes );
			}
			$classes = array_merge( $classes, $custom_classes );
		}

		return array_unique( $classes );
	}

	add_filter( 'body_class', 'collaborate_filter_body_class', 8, 2 );

}