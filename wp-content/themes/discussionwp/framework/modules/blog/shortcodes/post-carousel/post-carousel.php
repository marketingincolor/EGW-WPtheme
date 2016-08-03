<?php
namespace Discussion\Modules\Blog\Shortcodes\PostCarousel;

use Discussion\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostCarousel
 */
class PostCarousel extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkd_post_carousel';
        $this->css_class = 'mkd-pc';
        $this->shortcode_title = 'Mikado Post Carousel';

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
            'title_tag' => 'h3',
            'title_length' => '',
            'display_date' => 'yes',
            'date_format' => 'd. F Y',
            'display_category' => 'yes',
            'display_comments' => 'yes',
            'display_share' => 'yes',
            'display_count' => 'yes',
			'display_rating' => 'no',
            'display_excerpt' => 'yes',
            'excerpt_length' => '20',
            'display_read_more' => 'no',
            'thumb_image_size' => '',
            'thumb_image_width' => '',
            'thumb_image_height' => '',
        );

        $params = shortcode_atts($args, $atts);

        $html = '';

        if ($atts['query_result']->have_posts()):

            $html .= '<ul class="mkd-carousel-holder">';

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                $html .= '<li class="mkd-carousel-item">';

                //Get HTML from template
                $html .= discussion_get_list_shortcode_module_template_part('post-template-one', 'templates', '', $params);

                $html .= '</li>'; // close mkd-carousel-item

            endwhile;

            $html .= '</ul>'; // mkd-carousel-holder

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