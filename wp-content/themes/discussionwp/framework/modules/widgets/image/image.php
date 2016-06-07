<?php

/**
 * Widget that adds image type
 *
 * Class Image_Widget
 */
class DiscussionImageWidget extends DiscussionWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_image_widget', // Base ID
            'Mikado Image Widget' // Name
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
                'title' => 'Image Source',
                'name' => 'image_src'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Image Alt',
                'name' => 'image_alt'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Link',
                'name' => 'link'
            ),
            array(
            	'type' => 'textfield',
            	'title' => 'Padding',
            	'name' => 'padding'
        	),
            array(
                'type' => 'dropdown',
                'title' => 'Target',
                'name' => 'target',
                'options' => array(
                    '_self' => 'Same Window',
                    '_blank' => 'New Window'
                )
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

        $image_src = '';
        $image_alt = 'Widget Image';

        if (!empty($instance['image_alt']) && $instance['image_alt'] !== '') {
            $image_alt = $instance['image_alt'];
        }

        if (!empty($instance['image_src']) && $instance['image_src'] !== '') {
            $image_src = '<img src="'.esc_url($instance['image_src']).'" alt="'.$image_alt.'" />';
        }

        $link_begin_html = '';
        $link_end_html = '';
        $target = '_self';

        if (!empty($instance['target']) && $instance['target'] !== '') {
            $target = $instance['target'];
        }

        if (!empty($instance['link']) && $instance['link'] !== '') {
            $link_begin_html = '<a href="'.esc_url($instance['link']).'" target="'.$target.'">';
            $link_end_html = '</a>';
        }

        $padding = '';
        if (!empty($instance['padding']) && $instance['padding'] !== '') {
            $padding = 'padding: '.$instance['padding'];
        }
        ?>

        <div class="widget mkd-image-widget" <?php discussion_inline_style($padding);?>>
            <?php 
                if ($link_begin_html !== '') {
                    print $link_begin_html;
                }
                if ($image_src !== '') {
                    print $image_src;
                }
                if ($link_end_html !== '') {
                    print $link_end_html;
                }
            ?>
        </div>
    <?php 
    }
}