<?php
/**
 * Template part for displaying excerpts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package theme1
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if (has_post_thumbnail()) {
		?>
		<a class="entry-image-link" href="<?php echo esc_url(get_permalink()); ?>">
		<?php
			// the sizes should already be set in css, so this is a bit reduntdant
			the_post_thumbnail(array(320, 200));
		?>
		</a>
		<?php
			}
			the_excerpt();
		?>
	</div><!-- .entry-content -->
	<?php
		read_more();
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php theme1_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif;
	?>

</article><!-- #post-<?php the_ID(); ?> -->
