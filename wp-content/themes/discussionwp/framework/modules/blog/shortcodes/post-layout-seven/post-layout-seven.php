<?php
namespace Discussion\Modules\Blog\Shortcodes\PostLayoutSeven;

use Discussion\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostLayoutSeven
 */
class PostLayoutSeven extends ListShortcode {

	/**
	 * @var string
	 */

    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
		$this->base = 'mkd_post_layout_seven';
        $this->css_class = 'mkd-pl-seven';
        $this->shortcode_title = 'Mikado Post Layout 7';

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
	 *
     * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
            'title_tag' => 'h5',
            'title_length' => '',
            'display_image' => 'yes',
            'display_date' => 'yes',
            'date_format' => 'd. F Y',
            'display_excerpt' => 'no',
            'excerpt_length' => '20',
            'custom_thumb_image_width' => '123',
            'custom_thumb_image_height' => '105'
		);

		$params = shortcode_atts($args, $atts);

        $params['image_style'] = $this->getImageStyle($params);

        $html = '';

        if($atts['query_result']->have_posts()):
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= discussion_get_list_shortcode_module_template_part('post-template-seven', 'templates', '', $params);

            endwhile;
        else:
                $html .= $this->errorMessage();

        endif;
        wp_reset_postdata();

		return $html;
	}

    private function getImageStyle($params) {
        $style = array();

        if ($params['custom_thumb_image_width'] !== '') {
            $style[] = 'width: '.discussion_filter_px($params['custom_thumb_image_width']).'px';
        }

        return implode(';', $style);
    }
}