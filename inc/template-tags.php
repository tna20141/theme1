<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package theme1
 */

if ( ! function_exists( 'theme1_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function theme1_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date('j/n/Y') ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date('j/n/Y') )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'theme1' ), $time_string
		);

		// $byline = sprintf(
		// 	/* translators: %s: post author. */
		// 	esc_html_x( 'by %s', 'post author', 'theme1' ),
		// 	'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		// );

		// echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'theme1_entry_footer' ) ) :
	function theme1_entry_footer() {
		// if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		// 	echo '<span class="comments-link">';
		// 	comments_popup_link(
		// 		sprintf(
		// 			wp_kses(
		// 				/* translators: %s: post title */
		// 				__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'theme1' ),
		// 				array(
		// 					'span' => array(
		// 						'class' => array(),
		// 					),
		// 				)
		// 			),
		// 			get_the_title()
		// 		)
		// 	);
		// 	echo '</span>';
		// }

		// edit_post_link(
		// 	sprintf(
		// 		wp_kses(
		// 			/* translators: %s: Name of current post. Only visible to screen readers */
		// 			__( 'Edit <span class="screen-reader-text">%s</span>', 'theme1' ),
		// 			array(
		// 				'span' => array(
		// 					'class' => array(),
		// 				),
		// 			)
		// 		),
		// 		get_the_title()
		// 	),
		// 	'<span class="edit-link">',
		// 	'</span>'
		// );
	}
endif;

if (!function_exists('theme1_tag_list')):
	function theme1_tag_list() {
		$tag_list = get_the_tag_list('<ul class="entry-tag-list"><span class="entry-tag-label">' . __('tags', 'theme1') . ':</span><li class="entry-tag">', '</li><li class="entry-tag">', '</li></ul>');
		if ($tag_list) {
			printf('<div class="entry-tag-wrap">' . esc_html__('%1$s', 'theme1') . '</div>', $tag_list);
		}
	}
endif;

if (!function_exists('read_more')):
	/**
	 * Display read more button
	 */
	function read_more() {
		echo '<a class="more-link" href="' . esc_url(get_permalink()) . '">' . __('read_more', 'theme1') . '</a>';
	}
endif;

if (!function_exists('theme1_comment_entry')):
	function theme1_comment_entry() {
		$comment = get_comment();
		$comment_id_prefix = 'div-comment';
		$date_format = 'j/n/Y G:i';
		$cid = get_comment()->comment_ID;
		$output = '<li '. comment_class('', null, null, false) . ' id="li-comment-' . $cid . '">';
		$output .= '<article id="' . $comment_id_prefix . '-' . $cid . '" class="comment-body">';
		$output .= '<footer class="comment-meta">';
		// $output .= '<div class="comment-author vcard">' . get_avatar($comment, 40);
		$output .= '<div class="comment-author vcard">';
		$output .= '<b class="fn">' . get_comment_author_link() . '</b></div>';
		$output .= '<div class="comment-metadata"><span>' . get_comment_date($date_format) . '</span></div>';
		$output .= '</footer>';
		$output .= '<div class="comment-content">' . get_comment_text() . '</div>';
		$output .= '<div class="reply">' . get_comment_reply_link(array(
			'depth'      => $GLOBALS['comment_depth'],
			'max_depth'  => get_option('thread_comments_depth'),
			'reply_text' => __('reply', 'theme1'),
			'add_below'  => $comment_id_prefix,
		)) . '</div></article></li>';

		echo $output;
	}
endif;

// Plugins involved: Organize Series
if (!function_exists('theme1_organize_series_nav')):
	/**
	 * Link navigation for Organize Series plugin
	 */
	function theme1_organize_series_nav() {
		global $wpdb;
		$series_tax = 'series';
		$post_id = get_the_ID();
		$series = wp_get_post_terms($post_id, $series_tax);
		if (!count($series)) {
			return;
		}
		$series = $series[0];

		$sp_name = '_series_part';
		$current_part = get_post_meta($post_id, $sp_name, true);
		if ($current_part == '') {
			return;
		}

		$current_part = intval($current_part);
		$prev_part = $current_part-1;
		$next_part = $current_part+1;

		$query = $wpdb->prepare("select meta_value, p.ID, post_title from " .
			"$wpdb->posts p, $wpdb->postmeta pm, $wpdb->term_relationships tr, $wpdb->term_taxonomy tt, $wpdb->terms t " .
			"where p.id = pm.post_id and pm.meta_key = %s and pm.meta_value in (%d, %d) and p.id = tr.object_id and " .
			"tr.term_taxonomy_id = tt.term_id and tt.taxonomy = %s and tt.term_id = t.term_id and t.name = %s and p.post_status = %s",
			$sp_name, $prev_part, $next_part, $series_tax, $series->name, 'publish');

		$results = $wpdb->get_results($query, ARRAY_A);

		$prev = '';
		$next = '';
		foreach($results as $res) {
			$pos = intval($res['meta_value']);
			if ($pos === $prev_part):
				$prev = $res;
			elseif ($pos === $next_part):
				$next = $res;
			endif;
		}

		// all the part numbers are offseted by 1, because we want an introduction to the series before the first part
		$prev_html = '';
		if ($prev) {
			if ($prev['meta_value'] == 1) {
				$prev_num = __('series_introduction', 'theme1');
				$prev_text = __('<< %s', 'theme1');
			} else {
				$prev_num = $prev['meta_value']-1;
				$prev_text = __('<< Part %s', 'theme1');
			}
			$prev_html = '<a class="series-%s-link" href="%s" title="%s">'. $prev_text . '</a>';
			$prev_html = sprintf($prev_html, 'prev', get_permalink($prev['ID']), $prev['post_title'], $prev_num);
		}
		$next_html = '';
		if ($next) {
			$next_html = '<a class="series-%s-link" href="%s" title="%s">'. __('Part %s >>', 'theme1') . '</a>';
			$next_html = sprintf($next_html, 'next', get_permalink($next['ID']), $next['post_title'], $next['meta_value']-1);
		}

		$html = '<div class="series-nav-wrap">' . $prev_html . $next_html . '</div>';

		echo $html;
	}
endif;
