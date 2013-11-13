<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Collaborate
 * @since Collaborate 0.1
 */

get_header(); ?>

<div class="content">
	<main role="main" class="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'parts/content', 'single' ); ?>

			<?php collaborate_content_nav( 'nav-below' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

	</main>
</div><!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>