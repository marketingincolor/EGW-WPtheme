<?php

/*** Quote Post Format ***/

$quote_post_format_meta_box = discussion_add_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => 'Quote Post Format',
		'name' 	=> 'post_format_quote_meta'
	)
);

    discussion_add_meta_box_field(
        array(
            'name'        => 'mkd_post_quote_author_meta',
            'type'        => 'text',
            'label'       => 'Quote Author',
            'description' => 'Enter Quote Author',
            'parent'      => $quote_post_format_meta_box,

        )
    );

