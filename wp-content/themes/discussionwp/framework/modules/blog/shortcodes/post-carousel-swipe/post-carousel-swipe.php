<?php
namespace Discussion\Modules\Blog\Shortcodes\PostCarouselSwipe;

use Discussion\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostCarouselSwipe
 */
class PostCarouselSwipe extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkd_post_carousel_swipe';
        $this->css_class = 'mkd-pcs';
        $this->shortcode_title = 'Mikado Post Swipe Carousel';

        parent::__construct($this->base, $this->css_class, $this->shortcode_title);

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * add params for shortcode in next function
     * function gets $base for each shortcode
     *
     * @see discussion_get_shortcode_params()
     */

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'slider_layout' => '',
            'title_tag' => 'h2',
            'title_length' => '',
            'display_date' => 'yes',
            'date_format' => 'd. F Y',
            'display_category' => 'no',
            'display_comments' => 'yes',
            'display_share' => 'yes',
            'display_count' => 'yes',
            'display_excerpt' => 'no',
            'excerpt_length' => '20',
            'display_read_more' => 'no',
            'custom_thumb_image_width' => '650',
            'custom_thumb_image_height' => '595'
        );

        $params = shortcode_atts($args, $atts);

        $params['thumb_image_size'] = 'custom_size';
        $params['thumb_image_width'] = $params['custom_thumb_image_width'] != '' ? $params['custom_thumb_image_width'] : 650; 
        $params['thumb_image_height'] = $params['custom_thumb_image_height'] != '' ? $params['custom_thumb_image_height'] : 595;

        $html = '';

        if ($atts['query_result']->have_posts()):

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                $html .= '<div class="mkd-pcs-item">';

                //Get HTML from template
                $html .= discussion_get_list_shortcode_module_template_part('post-template-five', 'templates', '', $params);

                $html .= '</div>'; // close mkd-pcs-item

            endwhile;

        else:
            $html .= $this->errorMessage();
        endif;

        wp_reset_postdata();

        return $html;
    }

    /**
     * Enabling inner holder in shortcode if layout is used,
     * because block has its own inner holder
     *
     * @return boolean
     */
    protected function isBlockElement() {
        return true;
    }

    protected function getAdditionalClasses($params){
        $holder_classes = array();

        if (isset($params['carousel_layout']) && $params['carousel_layout'] !== '') {
            $holder_classes[] = $params['carousel_layout'];
        }

        return $holder_classes;
    }

}