<?php
/**
 * The template for displaying pages
 *
 * @package WordPress
 * @subpackage Collaborate
 * @since Collaborate 0.1
 */

get_header(); ?>

<div class="content">
	<main role="main" class="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'parts/content', 'page' ); ?>

			<?php collaborate_content_nav( 'nav-below' ); ?>

		<?php endwhile; // end of the loop. ?>

	</main>
</div><!-- .content -->

<?php get_footer();