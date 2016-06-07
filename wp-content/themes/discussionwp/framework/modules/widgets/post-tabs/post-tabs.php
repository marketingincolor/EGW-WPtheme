<?php

/**
 * Widget that adds post tabs
 *
 * Class PostTabs
 */
class DiscussionPostTabs extends DiscussionWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_post_tabs_widget', // Base ID
            'Mikado Post Tabs Widget' // Name
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
                'title' => 'First Category',
                'name' => 'category_id_1',
                'options' => array_flip(discussion_get_post_categories_VC()),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Second Category',
                'name' => 'category_id_2',
                'options' => array_flip(discussion_get_post_categories_VC()),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Third Category',
                'name' => 'category_id_3',
                'options' => array_flip(discussion_get_post_categories_VC()),
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Fourth Category',
                'name' => 'category_id_4',
                'options' => array_flip(discussion_get_post_categories_VC()),
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
                'title' => 'Display Image',
                'name' => 'display_image',
                'options' => array(
                    'yes' => 'Yes',
                    'no' => 'No'
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
        if(is_array($instance) && count($instance)) {
            $params_label = 'params';
            $id_label = array();
            $categories = array();
            $holder_class = '';
            $tabs_class = '';
            
            if (empty($instance['custom_thumb_image_width']) || $instance['custom_thumb_image_width'] == '') {
                $instance['custom_thumb_image_width'] = 117;
            }

            if (empty($instance['custom_thumb_image_height']) || $instance['custom_thumb_image_height'] == '') {
                $instance['custom_thumb_image_height'] = 86;
            }

            for($i = 1; $i <= 4; $i++) {
                ${$params_label.$i} = '';
                if(!empty($instance['category_id_'.$i]) && $instance['category_id_'.$i] !== '') {
                    $categories[$i] = $instance['category_id_'.$i];
                    $id_label[$i] = 'mkd-widget-tab-'.$categories[$i];
                    unset($instance['category_id_'.$i]);
                }
            }

            //generate shortcode params
            for($i = 1; $i <= 4; $i++) {
                foreach ($instance as $key => $value) {
                    ${$params_label.$i} .= " ".$key."='".$value."' ";
                }
                if(!empty($categories[$i]) && $categories[$i] !== ''){
                    ${$params_label.$i} .= " category_id='".$categories[$i]."' ";
                }
            }
        }

        echo '<div class="widget mkd-ptw-holder mkd-tabs '.esc_attr($tabs_class).'">';
            if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
                print $args['before_title'].$instance['widget_title'].$args['after_title'];
            }
            echo '<div class="mkd-ptw-nav mkd-tabs-nav '.$holder_class.'"><ul>';
                $i = 1;
                foreach($categories as $key => $value){
                    $category_name = $value != 0 ? get_the_category_by_ID($value) : '';
                    if($category_name !== ''){
                        echo '<li><a href="#'.$id_label[$i].'">'.$category_name.'</a></li>';
                        $i++;
                    } else if ($value !== 0 && $category_name === ''){
                        echo '<li><a href="#'.$id_label[$i].'">'.esc_html__("All", "discussionwp").'</a></li>';
                        $i++;
                    }
                }
            echo '</ul></div>';

            $j = 1;
            foreach($categories as $key => $value){
                if($value != 0) {
                    echo '<div class="mkd-ptw-content mkd-tab-container" id="'.$id_label[$j].'">';
                        echo '<div class="mkd-plw-tabs-content">';
                        echo do_shortcode('[mkd_post_layout_seven '.${$params_label.$j}.']'); // XSS OK
                        echo'</div>';
                        $j++;
                    echo '</div>';
                }
            }
        echo '</div>';
    }
}