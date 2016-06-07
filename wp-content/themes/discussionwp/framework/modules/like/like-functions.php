<?php

if ( ! function_exists('discussion_like') ) {
	/**
	 * Returns DiscussionLike instance
	 *
	 * @return DiscussionLike
	 */
	function discussion_like() {
		return DiscussionLike::get_instance();
	}

}

function discussion_get_like() {

	echo wp_kses(discussion_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}

if ( ! function_exists('discussion_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function discussion_like_latest_posts() {
		return discussion_like()->add_like();
	}

}

if ( ! function_exists('discussion_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function discussion_like_portfolio_list($portfolio_project_id) {
		return discussion_like()->add_like_portfolio_list($portfolio_project_id);
	}

}