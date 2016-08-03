<?php

/**
 * Widget that adds recent comments
 *
 * Class RecentComments
 */
class DiscussionRecentComments extends DiscussionWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_recent_comments_widget', // Base ID
            'Mikado Recent Comments Widget' // Name
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
            	'type' => 'textfield',
            	'title' => 'Post Title Length',
            	'name' => 'title_length'
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
        $number_of_posts = 3;
        if (!empty($instance['number_of_posts']) && $instance['number_of_posts'] !== '') {
            $number_of_posts = $instance['number_of_posts'];
        }

        $display_date = true;
        if (!empty($instance['display_date']) && $instance['display_date'] === 'no') {
            $display_date = false;
        }

        $date_format = 'd. M Y';
        if (!empty($instance['date_format']) && $instance['date_format'] !== '') {
            $date_format = $instance['date_format'];
        }

        $title_length = '';
        if (!empty($instance['title_length']) && $instance['title_length'] !== '') {
            $title_length = $instance['title_length'];
        }        

        $month = get_the_time('m');
        $year = get_the_time('Y');

        $comments = get_comments( 
            array(
                'number'      => $number_of_posts,
                'status'      => 'approve',
                'post_status' => 'publish'
            ) 
        );

        echo '<div class="widget mkd-rpc-holder">';
            if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
                print $args['before_title'].$instance['widget_title'].$args['after_title'];
            }
            echo '<div class="mkd-rpc-inner">';
                echo '<ul>';
                    if ( is_array( $comments ) && $comments ) {
                        foreach ( (array) $comments as $comment ) {
                            echo '<li>';
                                echo '<div class="mkd-rpc-number-holder"><span class="ion-android-chat"></span></div>';
                                echo '<div class="mkd-rpc-content">';
                                echo '<h6 class="mkd-rpc-link"><a itemprop="url" href="'.esc_url( get_comment_link( $comment ) ).'">'.discussion_get_title_substring(get_the_title( $comment->comment_post_ID ), $title_length).'</a></h6>';
                                if($display_date){
                                    echo '<a class="mkd-rpc-date" itemprop="url" href="'.get_month_link($year, $month).'">'.get_the_time($date_format, $comment->comment_post_ID).'</a>';
                                }
                                echo '</div>';
                            echo '</li>';
                        }
                    }
                echo '</ul>';
            echo '</div>';
        echo '</div>';
    }
}