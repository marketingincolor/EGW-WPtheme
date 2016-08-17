<?php

/*
	Layouts - shortcodes
*/
use Discussion\Modules\Blog\Shortcodes\PostLayoutOne\PostLayoutOne;
use Discussion\Modules\Blog\Shortcodes\PostLayoutTwo\PostLayoutTwo;
use Discussion\Modules\Blog\Shortcodes\PostLayoutThree\PostLayoutThree;
use Discussion\Modules\Blog\Shortcodes\PostLayoutFour\PostLayoutFour;
use Discussion\Modules\Blog\Shortcodes\PostLayoutFive\PostLayoutFive;
use Discussion\Modules\Blog\Shortcodes\PostLayoutSix\PostLayoutSix;
use Discussion\Modules\Blog\Shortcodes\PostLayoutSeven\PostLayoutSeven;
use Discussion\Modules\Blog\Shortcodes\PostLayoutEight\PostLayoutEight;
use Discussion\Modules\Blog\Shortcodes\PostLayoutNine\PostLayoutNine;

/*
	Blocks - combinations of several layouts
*/
use Discussion\Modules\Blog\Shortcodes\BlockOne\BlockOne;
use Discussion\Modules\Blog\Shortcodes\BlockTwo\BlockTwo;
use Discussion\Modules\Blog\Shortcodes\BlockThree\BlockThree;
use Discussion\Modules\Blog\Shortcodes\BlockFour\BlockFour;
use Discussion\Modules\Blog\Shortcodes\BlockFive\BlockFive;
use Discussion\Modules\Blog\Shortcodes\BlockSix\BlockSix;
use Discussion\Modules\Blog\Shortcodes\BlockSeven\BlockSeven;


if(!function_exists('discussion_list_ajax')) {
    function discussion_list_ajax()
    {

        $params = ($_POST);

        $prefix_block = 'mkd_block_';
        $prefix_layout = 'mkd_post_layout_';

        switch($params['base']){
            case 'mkd_block_one' : {
                $newShortcode = new BlockOne();
            }   break;
            case 'mkd_block_two' : {
                $newShortcode = new BlockTwo();
            }   break;
            case 'mkd_block_three' : {
                $newShortcode = new BlockThree();
            }   break;
            case 'mkd_block_four' : {
                $newShortcode = new BlockFour();
            }   break;
            case 'mkd_block_five' : {
                $newShortcode = new BlockFive();
            }   break;
            case 'mkd_block_six' : {
                $newShortcode = new BlockSix();
            }   break;
            case 'mkd_block_seven' : {
                $newShortcode = new BlockSeven();
            }   break;
            case 'mkd_post_layout_one' : {
                $newShortcode = new PostLayoutOne();
            }   break;
            case 'mkd_post_layout_two' : {
                $newShortcode = new PostLayoutTwo();
            }   break;
            case 'mkd_post_layout_three' : {
                $newShortcode = new PostLayoutThree();
            }   break;
            case 'mkd_post_layout_four' : {
                $newShortcode = new PostLayoutFour();
            }   break;
            case 'mkd_post_layout_five' : {
                $newShortcode = new PostLayoutFive();
            }   break;
            case 'mkd_post_layout_six' : {
                $newShortcode = new PostLayoutSix();
            }   break;
            case 'mkd_post_layout_seven' : {
                $newShortcode = new PostLayoutSeven();
            }   break;
            case 'mkd_post_layout_eight' : {
                $newShortcode = new PostLayoutEight();
            }   break;
            case 'mkd_post_layout_nine' : {
                $newShortcode = new PostLayoutNine();
            }   break;
        }

        $params['query_result'] = $newShortcode->generatePostsQuery($params);
        $html_response = $newShortcode->render($params);

        $show_next_page = true;
        if ($params['paged'] < 1 || $params['paged'] > $params['query_result']->max_num_pages) {
            $show_next_page = false;
        }


        $return_obj = array(
            'html' => $html_response,
            'showNextPage' => $show_next_page,
            'pagedResult' => $params['paged']
        );

        echo json_encode($return_obj); exit;
    }

    add_action('wp_ajax_discussion_list_ajax', 'discussion_list_ajax');
    add_action('wp_ajax_nopriv_discussion_list_ajax', 'discussion_list_ajax');
}