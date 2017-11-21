<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package theme1
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main-single">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// the_post_navigation();


		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();

// If comments are open or we have at least one comment, load up the comment template.
// Here we only have 1 post, so putting this outside of the Loop is fine
if (comments_open()) :
	comments_template();
endif;

get_footer();
