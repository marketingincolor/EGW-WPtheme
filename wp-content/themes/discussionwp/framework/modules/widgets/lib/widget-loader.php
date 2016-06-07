<?php

if (!function_exists('discussion_register_widgets')) {

	function discussion_register_widgets() {

		$widgets = array(
			'DiscussionBreakingNews',
			'DiscussionDateWidget',
			'DiscussionImageWidget',
			'DiscussionPostLayoutTwo',
			'DiscussionPostLayoutFive',
			'DiscussionPostLayoutSix',
			'DiscussionPostLayoutSeven',
            'DiscussionPostLayoutTabs',
            'DiscussionRecentComments',
			'DiscussionSearchForm',
			'DiscussionSeparatorWidget',
			'DiscussionSocialIconWidget',
			'DiscussionStickySidebar',
			'DiscussionPostTabs',
			'DiscussionSideAreaOpener',
		);

		foreach ($widgets as $widget) {
			register_widget($widget);
		}
	}
}

add_action('widgets_init', 'discussion_register_widgets');