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
 * Let's remove some of the nav_menu_css_class classes we don't need.
 */

if ( ! function_exists( 'collaborate_filter_menu_class' ) ) {
	function collaborate_filter_menu_class( $classes, $item, $args ){

		if ( in_array( 'menu-item-ancestor', $classes ) ) {
			unset ( $classes );
    		$classes[] = 'menu-item-ancestor';
		} else {
			unset ( $classes );
		}

		$custom_classes = get_post_meta($item->ID, '_menu_item_classes');

		if ( is_array( $custom_classes[0] ) ) {
			$custom_classes = $custom_classes[0];
		}

		foreach ( $custom_classes as $class ) {
			if ( trim( $class ) != '' ) {
				$classes[] = sanitize_html_class( $class );
			}
		}

		$classes[] = 'menu-item';

		if ( $item->current || $item->current_item_ancestor || $item->current_item_parent ) {
			$classes[] = 'menu-item-active';
		}

		return array_unique( $classes );
	}

	add_filter( 'nav_menu_css_class', 'collaborate_filter_menu_class', 8, 3 );
}

/**
 * We need to filter so we can replace WordPress default menu-item-has-children
 */
if ( ! function_exists( 'collaborate_filter_nav_menu_objects' ) ) {
	function collaborate_filter_nav_menu_objects( $sorted_menu_items, $args ) {

		foreach ( $sorted_menu_items as $menu ) {
			$menu->classes = str_replace( 'menu-item-has-children', 'menu-item-ancestor', $menu->classes );
		}

		return $sorted_menu_items;
	}

	add_filter( 'wp_nav_menu_objects', 'collaborate_filter_nav_menu_objects', 8, 2 );
}

/**
 * Let's remove some of the comment_class classes we don't need.
 */
if ( ! function_exists( 'collaborate_filter_comment_class' ) ) {
	function collaborate_filter_comment_class( $classes, $custom_classes, $comment_id, $post_id ) {
		global $comment_alt, $comment_depth, $comment_thread_alt;
		$comment = get_comment( $comment_id );
		$post = get_post( $post_id );

		// Remove all the WordPress comment classes
		unset( $classes );
		$classes = array();

		$classes[] = 'comment';

		// If the comment author has an id (registered), then print the log in name
		if ( $comment->user_id > 0 && $post && ( $comment->user_id === $post->post_author ) ) {
			// For comment authors who are the author of the post
			$classes[] = 'bypostauthor';
		}

		// $comment_alt has been increased by the filter runs
		if ( ! ( $comment_alt % 2 ) ) {
			$classes[] = 'alt';
		}

		// Alt for top-level comments
		// $comment_thread_alt has been increased by the time the filter runs
		if ( 1 == $comment_depth ) {
			if ( ! ( $comment_thread_alt % 2 ) ) {
				$classes[] = 'thread-alt';
			}
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

	add_filter( 'comment_class', 'collaborate_filter_comment_class', 8, 4 );
}