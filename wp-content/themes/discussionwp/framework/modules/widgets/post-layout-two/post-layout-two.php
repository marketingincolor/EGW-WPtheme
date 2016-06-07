<?php

/**
 * Widget that adds post layout two
 *
 * Class PostLayoutTwo
 */
class DiscussionPostLayoutTwo extends DiscussionWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_post_layout_two_widget', // Base ID
            'Mikado Post Layout Two Widget' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'textfield',
                'title' => 'Widget Title',
                'name' => 'widget_title'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Number of Posts',
                'name' => 'number_of_posts'
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Number of Columns',
                'name' => 'column_number',
                'options' => array(
                    '' => 'Default',
                    1 => 'One Column',
                    2 => 'Two Columns',
                    3 => 'Three Columns',
                    4 => 'Four Columns',
                    5 => 'Five Columns',
                    6 => 'Six Columns'
                ),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Category',
                'name' => 'category_id',
                'options' => array_flip(discussion_get_post_categories_VC()),
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'title' => 'Category Slug',
                'name' => 'category_slug',
                'description' => 'Leave empty for all or use comma for list'
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Choose Author',
                'name' => 'author_id',
                'options' => array_flip(discussion_get_authors_VC()),
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'title' => 'Tag Slug',
                'name' => 'tag_slug',
                'description' => 'Leave empty for all or use comma for list'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Include Posts',
                'name' => 'post_in',
                'description' => 'Enter the IDs of the posts you want to display'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Exclude Posts',
                'name' => 'post_not_in',
                'description' => 'Enter the IDs of the posts you want to exclude'
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Sort',
                'name' => 'sort',
                'options' => array_flip(discussion_get_sort_array()),
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'title' => 'Image Width (px)',
                'name' => 'custom_thumb_image_width',
                'description' => 'Set custom image width (px)',
            ),
            array(
                'type' => 'textfield',
                'title' => 'Image Height (px)',
                'name' => 'custom_thumb_image_height',
                'description' => 'Set custom image height (px)',
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Title Tag',
                'name' => 'title_tag',
                'options' => array(
                    'h4' => 'h4',
                    'h2' => 'h2',
                    'h3' => 'h3',
                    'h5' => 'h5',
                    'h6' => 'h6'
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Date',
                'name' => 'display_date',
                'options' => array(
                    'yes' => 'Yes',
                    'no' => 'No'
                )
            ),
            array(
                'type' => 'textfield',
                'title' => 'Date Format',
                'name' => 'date_format',
                'description' => 'Enter the date format that you want to display'
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Category',
                'name' => 'display_category',
                'options' => array(
                    'no' => 'No',
                    'yes' => 'Yes'
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Comments',
                'name' => 'display_comments',
                'options' => array(
                    'no' => 'No',
                    'yes' => 'Yes'
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Count',
                'name' => 'display_count',
                'options' => array(
                    'no' => 'No',
                    'yes' => 'Yes'
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Share',
                'name' => 'display_share',
                'options' => array(
                    'no' => 'No',
                    'yes' => 'Yes'
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Display Excerpt',
                'name' => 'display_excerpt',
                'options' => array(
                    'no' => 'No',
                    'yes' => 'Yes',
                )
            ),
            array(
                'type' => 'textfield',
                'title' => 'Max. Excerpt Length',
                'name' => 'excerpt_length',
                'description' => 'Enter max of words that can be shown for excerpt'
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        extract($args);

        //prepare variables
        $params = '';

        $instance['custom_thumb_image_width'] = $instance['custom_thumb_image_width'] != '' ? $instance['custom_thumb_image_width'] : '120';
        $instance['custom_thumb_image_height'] = $instance['custom_thumb_image_height'] != '' ? $instance['custom_thumb_image_height'] : '120';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params .= " $key = '$value' ";
            }
        }

        echo '<div class="widget mkd-plw-two">';

        if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
            print $args['before_title'].$instance['widget_title'].$args['after_title'];
        }
        
        //finally call the shortcode
        echo do_shortcode("[mkd_post_layout_two $params]"); // XSS OK

        echo '</div>'; //close div.mkd-plw-seven
    }
}