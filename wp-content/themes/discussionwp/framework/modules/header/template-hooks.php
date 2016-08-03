<?php

//top header bar
add_action('discussion_before_page_header', 'discussion_get_header_top');

//mobile header
add_action('discussion_after_page_header', 'discussion_get_mobile_header');