<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package theme1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		the_title( '<h1 class="entry-title-single">', '</h1>' );

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta-single">
			<?php theme1_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<?php
	theme1_organize_series_nav();
	?>
	<div class="entry-content-single">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'theme1' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			// wp_link_pages( array(
			// 	'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme1' ),
			// 	'after'  => '</div>',
			// ) );

		?>
	</div><!-- .entry-content -->
	<?php
		theme1_tag_list();
	?>
	<div class="entry-share-wrap">
		<label class="entry-share-label"><?php echo __('please_share', 'theme1') ?></label>
		<?php echo do_shortcode('[Sassy_Social_Share]'); ?>
	</div>
	<footer class="entry-footer">
		<?php theme1_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
