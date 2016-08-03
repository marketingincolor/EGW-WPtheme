<?php

add_action('after_setup_theme', 'discussion_meta_boxes_map_init', 1);
function discussion_meta_boxes_map_init() {
    /**
    * Loades all meta-boxes by going through all folders that are placed directly in meta-boxes folder
    * and loads map.php file in each.
    *
    * @see http://php.net/manual/en/function.glob.php
    */

    do_action('discussion_before_meta_boxes_map');

	global $discussion_options;
	global $discussion_Framework;
	global $discussion_options_fontstyle;
	global $discussion_options_fontweight;
	global $discussion_options_texttransform;
	global $discussion_options_fontdecoration;
	global $discussion_options_arrows_type;

    foreach(glob(MIKADO_FRAMEWORK_ROOT_DIR.'/admin/meta-boxes/*/map.php') as $meta_box_load) {
        include_once $meta_box_load;
    }

	do_action('discussion_meta_boxes_map');

	do_action('discussion_after_meta_boxes_map');
}