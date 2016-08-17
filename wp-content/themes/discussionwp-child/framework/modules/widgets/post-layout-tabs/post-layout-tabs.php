<?php

/**
 * Widget that adds post layout tabs
 *
 * Class PostLayoutTabs
 */
class DiscussionPostLayoutTabs extends DiscussionWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_post_layout_tabs_widget', // Base ID
            'Mikado Post Layout Tabs Widget' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $categories = array( -1 => 'None') + array_flip(discussion_get_post_categories_VC());
        $this->params = array(
        	array(
        		'type' => 'dropdown',
        		'title' => 'Layout',
        		'name' => 'layout',
        		'options' => array(
        			'five' => 'Layout 5',
        			'seven' => 'Layout 7'
    			),
    			'description' => ''
    		),
            array(
                'type' => 'dropdown',
                'title' => 'Number of Columns',
                'name' => 'column_number',
                'options' => array(
                    4 => 'Four Columns',
                    1 => 'One Column',
                    2 => 'Two Columns',
                    3 => 'Three Columns',
                    5 => 'Five Columns'
                ),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'First Category',
                'name' => 'category_id_1',
                'options' => $categories ,
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Second Category',
                'name' => 'category_id_2',
                'options' => $categories ,
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Third Category',
                'name' => 'category_id_3',
                'options' => $categories,
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Fourth Category',
                'name' => 'category_id_4',
                'options' => $categories,
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Fifth Category',
                'name' => 'category_id_5',
                'options' => $categories,
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Sixth Category',
                'name' => 'category_id_6',
                'options' => $categories,
                'description' => ''
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
                'name' => 'thumb_image_width',
                'description' => 'Set custom image width (px)',
            ),
            array(
                'type' => 'textfield',
                'title' => 'Image Height (px)',
                'name' => 'thumb_image_height',
                'description' => 'Set custom image height (px)',
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Title Tag',
                'name' => 'title_tag',
                'options' => array(
                    'h6' => 'h6',
                    'h2' => 'h2',
                    'h3' => 'h3',
                    'h4' => 'h4',
                    'h5' => 'h5',
                )
            ),
            array(
                'type' => 'textfield',
                'title' => 'Title Max Characters',
                'name' => 'title_length',
                'description' => 'Enter max character of title post list that you want to display'
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
                'description' => 'Enter max of words that can be shown for excerpt',
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
        if(is_array($instance) && count($instance)) {
            $params_label = 'params';
            $categories = array();
            $layout = 'five';

            if (isset($instance['layout']) && $instance['layout'] !== ''){
            	$layout = $instance['layout'];
            }

            if ($layout == 'five'){
                $instance['number_of_posts'] = $instance['column_number'];
                $instance['display_category'] = 'no';
                $instance['display_comments'] = 'no';
                $instance['display_share'] = 'no';
                $instance['display_count'] = 'no';
                $instance['display_read_more'] = 'no';
                $instance['thumb_image_size'] = 'custom_size';
                $instance['thumb_image_width'] = $instance['thumb_image_width'] != '' ? $instance['thumb_image_width'] : '220';
                $instance['thumb_image_height'] = $instance['thumb_image_height'] != '' ? $instance['thumb_image_height'] : '180';
                $instance['excerpt_length'] = $instance['excerpt_length'] != '' ? $instance['excerpt_length'] : '10';
            }
            else{
                $instance['number_of_posts'] = $instance['column_number']*$instance['column_number'];
                $instance['display_image'] = 'yes';
                $instance['custom_thumb_image_width'] = $instance['thumb_image_width'] != '' ? $instance['thumb_image_width'] : '93';
                $instance['custom_thumb_image_height'] = $instance['thumb_image_height'] != '' ? $instance['thumb_image_height'] : '69';
                $instance['excerpt_length'] = $instance['excerpt_length'] != '' ? $instance['excerpt_length'] : '10';
            }


            //check how menu category fields we have
            $count = 0;
            foreach ($instance as $key => $value){
                if(strpos($key,'category_id') !== false) {
                    $count++;
                }
            }

            //create category array of each category field
            for($i = 1; $i <= $count; $i++) {
                //${$params_label.$i} = '';
                if($instance['category_id_'.$i] !== '-1') { //don't render 'all categories' item
                    $categories[$i] = $instance['category_id_' . $i];
                }
                unset($instance['category_id_'.$i]);
            }

            //generate shortcode params
            foreach ($categories as $key => $value){

                ${$params_label.$key} = '';
                foreach ($instance as $id => $val) {
                    ${$params_label.$key} .= " ".$id." = '".$val."' ";
                }
                ${$params_label.$key} .= " category_id = '".$value."' ";
            }

        }

        echo '<div class="widget mkd-plw-tabs">';
            echo '<div class="mkd-plw-tabs-inner">';
                echo '<div class="mkd-plw-tabs-tabs-holder">';
                    foreach($categories as $key => $value){
                        $category_name = $value != 0 ? get_the_category_by_ID($value) : esc_html__('All','discussionwp');
                        echo '<div class="mkd-plw-tabs-tab"><a href="#"><span class="item_text">'.$category_name.'</span></a></div>';
                    }
                echo '</div>'; //close div.mkd-plw-tabs-tabs-holder

                echo '<div class="mkd-plw-tabs-content-holder">';
                    foreach($categories as $key => $value){
                        echo '<div class="mkd-plw-tabs-content">';
                        echo do_shortcode('[mkd_post_layout_'.$layout.' '.${$params_label.$key}.']'); // XSS OK
                        echo'</div>';
                    }
                echo '</div>'; //close div.mkd-plw-tabs-content-holder
            echo '</div>'; //close div.mkd-plw-tabs-inner
        echo '</div>'; //close div.mkd-plw-tabs
    }
}