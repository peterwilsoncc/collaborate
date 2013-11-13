<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Collaborate
 * @since Collaborate 0.1
 */

get_header(); ?>

<div class="content">
	<main role="main" class="main">

		<?php if ( have_posts() ) : ?>

	        <?php /* Start the Loop */ ?>
	        <?php while ( have_posts() ) : the_post(); ?>

	                <?php
	                        /* Include the Post-Format-specific template for the content.
	                         * If you want to override this in a child theme, then include a file
	                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	                         */
	                        get_template_part( 'parts/content', get_post_format() );
	                ?>

	        <?php endwhile; ?>

	        <?php collaborate_content_nav( 'nav-below' ); ?>

		<?php else : ?>

	        <?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</main>
	
	<?php
	if ( is_active_sidebar( 'main-sidebar' ) ) :
		echo '<div class="widgetized widgetized--sidebar">';
		dynamic_sidebar( 'main-sidebar' );
		echo '</div>';
	endif;
	?>
</div>

<?php get_footer(); ?>