<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package theme1
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<h2 class="comments-title">
		<?php
		// unapproved comments aren't counted here, but could still be displayed,
		// therefore the number could be inconsistent
		$comment_count = get_comments_number();
		printf( // WPCS: XSS OK.
			/* translators: 1: comment count number, 2: title. */
			__('%1$s number_of_comments', 'theme1'),
			$comment_count
		);
		?>
	</h2><!-- .comments-title -->

	<?php
	if ( have_comments() ) : ?>
		<?php the_comments_navigation(); ?>


		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
					'callback'   => 'theme1_comment_entry',
				) );
			?>
		</ul><!-- .comment-list -->

		<?php the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		// NO!
		// if ( ! comments_open() ) : ?>
			<!-- <p class="no&#45;comments"><?php esc_html_e( 'Comments are closed.', 'theme1' ); ?></p> -->
		<?php
		// endif;

	endif; // Check for have_comments().

	$comment_field = '<p class="comment-form-comment">';
	$comment_field .= '<textarea id="comment" name="comment" cols=45 rows=6 placeholder="';
	$comment_field .= __('comment_label', 'theme1') . '" aria-required="true"></textarea></p>';

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
		'author' =>
			'<p class="comment-form-author"><input id="author" name="author" type="text" placeholder="' .
			__('comment_name_label', 'theme1') . '" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30"' . $aria_req . ' /></p>',

		'email' =>
			'<p class="comment-form-email"><input id="email" name="email" type="text" placeholder="' .
			__('comment_email_label', 'theme1') . '" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'" size="30"' . $aria_req . ' /></p>',

		// 'url' =>
		// 	'<p class="comment-form-url"><input id="url" name="url" type="text" placeholder="' .
		// 	__('comment_url_label', 'theme1') . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
		// 	'" size="30" /></p>',
	);

	$comment_notes_before = '<p class="comment-notes">' . __('comment_notes', 'theme1') . '</p>';

	comment_form(array(
		'comment_field'        => $comment_field,
		'fields'               => $fields,
		'cancel_reply_link'    => __('cancel_reply', 'theme1'),
		'title_reply'          => __('title_reply', 'theme1'),
		'label_submit'         => __('submit_reply', 'theme1'),
		'comment_notes_before' => $comment_notes_before,
	));
	?>

</div><!-- #comments -->
