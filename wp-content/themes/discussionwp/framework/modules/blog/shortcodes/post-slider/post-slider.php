<?php
namespace Discussion\Modules\Blog\Shortcodes\PostSlider;

use Discussion\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostSlider
 */
class PostSlider extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkd_post_slider';
        $this->css_class = 'mkd-ps';
        $this->shortcode_title = 'Mikado Post Slider';

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
            'carousel_layout' => '',
            'title_tag' => 'h3',
            'title_length' => '',
            'display_date' => 'yes',
            'date_format' => 'd. F Y',
            'display_category' => 'yes',
            'custom_thumb_image_width' => '475',
            'custom_thumb_image_height' => '448'
        );

        $params = shortcode_atts($args, $atts);

        $html = '';

        if ($atts['query_result']->have_posts()):

            $html .= '<ul class="mkd-slider-holder">';

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                $html .= '<li class="mkd-slider-item">';

                //Get HTML from template
                $html .= discussion_get_list_shortcode_module_template_part('templates/post-slider-template', 'post-slider', '', $params);

                $html .= '</li>'; // close mkd-slider-item

            endwhile;

            $html .= '</ul>'; // mkd-slider-holder

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