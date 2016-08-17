<?php
/**
 * Update person - Akilan
 * Date - 20-06-2016'
 * Reason - For adding custom widget of category layout tabs
 */
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
                        'DiscussionCategoryLayoutTabs',
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