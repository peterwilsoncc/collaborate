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
			$classes[] = 'page-template-' . sanitize_html_class( str_replace( '.', '-', get_post_meta( $post_id, '_wp_page_template', true ) ), '' );
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

	add_filter( 'body_class', 'collaborate_filter_body_class', 10, 2 );

}

/**
 * Let's remove some of the post_class classes we don't need.
 */
if ( ! function_exists( 'collaborate_filter_post_class' ) ) {
	function collaborate_filter_post_class( $classes, $custom_classes, $post_id ) {
		$post = get_post( $post_id );

		// Remove all the WordPress post classes
		unset( $classes );
		$classes = array();

		$classes[] = 'hentry';

		$classes[] = $post->post_type;
		
		// Post Format
		if ( post_type_supports( $post->post_type, 'post-formats' ) ) {
			$post_format = get_post_format( $post->ID );

			if ( $post_format && ! is_wp_error( $post_format ) )
				$classes[] = 'format-' . sanitize_html_class( $post_format );
			else
				$classes[] = 'format-standard';
		}


		if ( ! empty($custom_classes) ) {
			if ( ! is_array( $custom_classes ) )
				$custom_classes = preg_split( '#\s+#', $custom_classes );
			$classes = array_merge( $classes, $custom_classes );
		}

		$classes = array_map( 'esc_attr', $classes );

		return $classes;
	}

	add_filter( 'post_class', 'collaborate_filter_post_class', 8, 3 );
}