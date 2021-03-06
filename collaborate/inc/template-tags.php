<?php
/**
 * Custom template tags for this theme.
 *
 * @package WordPress
 * @subpackage Collaborate
 * @since Collaborate 0.1
 */

if ( ! function_exists( 'collaborate_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function collaborate_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'collaborate' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

			<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'collaborate' ) . '</span> %title' ); ?>
			<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'collaborate' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'collaborate' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'collaborate' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // collaborate_content_nav

if ( ! function_exists( 'collaborate_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function collaborate_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'collaborate' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function collaborate_categorized_blog() {
	if ( false === ( $collaborate_all_the_categories = get_transient( 'collaborate_all_the_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$collaborate_all_the_categories = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$collaborate_all_the_categories = count( $collaborate_all_the_categories );

		set_transient( 'collaborate_all_the_categories', $collaborate_all_the_categories );
	}

	if ( '1' != $collaborate_all_the_categories ) {
		// This blog has more than 1 category so collaborate_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so collaborate_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in collaborate_categorized_blog
 */
function collaborate_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'collaborate_all_the_categories' );
}
add_action( 'edit_category', 'collaborate_category_transient_flusher' );
add_action( 'save_post',     'collaborate_category_transient_flusher' );
