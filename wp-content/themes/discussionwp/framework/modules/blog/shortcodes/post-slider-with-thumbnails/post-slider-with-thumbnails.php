<?php
namespace Discussion\Modules\Blog\Shortcodes\PostSliderWithThumbnails;

use Discussion\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostSliderWithThumbnails
 */
class PostSliderWithThumbnails extends ListShortcode {

	/**
	 * @var string
	 */
    private $base;
    private $css_class;
    private $shortcode_title;

	public function __construct() {
		$this->base = 'mkd_post_slider_with_thumbnails';
        $this->css_class = 'mkd-pswt';
        $this->shortcode_title = 'Mikado Post Slider With Thumbnails';

        parent::__construct($this->base, $this->css_class, $this->shortcode_title);

        add_action('vc_before_init', array($this, 'vcMap'));
	}

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * add params for shortcode in next function
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
            'title_tag' => 'h2',
            'display_category' => 'yes',
            'display_date' => 'yes',
            'date_format' => 'd. F Y',
            'display_comments' => 'yes',
            'display_count' => 'yes',
            'display_share' => 'yes',
            'thumb_image_size' => '',
            'thumb_image_width' => '',
            'thumb_image_height' => '',
            'full_width_background' => 'yes'
		);

		$params = shortcode_atts($args, $atts);
        $html = '';
        $thumb_html = '';

		if ($params['full_width_background'] == 'yes'){
			$html .= '<div class="mkd-grid">';
		}

        if($atts['query_result']->have_posts()):
        	$html .= '<div class="mkd-pswt-slider">';

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

				$id = get_the_ID();
				$params['thumbnail_background_image'] = $this->getImageParams($id);

                //Get HTML from template
                $html .= discussion_get_list_shortcode_module_template_part('templates/post-slider-with-thumbnails-template', 'post-slider-with-thumbnails', '', $params);
                $thumb_html .= discussion_get_list_shortcode_module_template_part('templates/post-slider-thumbnails-template', 'post-slider-with-thumbnails', '', $params);

            endwhile;

            $html .= '</div>';
            else:
                $html .= $this->errorMessage();

        endif;

		if ($thumb_html !== ''){
			$html .= '<div class="mkd-pswt-thumb-slider-holder">';
			$html .= '<div class="mkd-pswt-thumb-slider">';
			$html .= $thumb_html;
			$html .= '</div>';
			$html .= '</div>';
		}

		if ($params['full_width_background'] == 'yes'){
			$html .= '</div>';
			$html .= '<div class="mkd-pswt-background-holder"></div>';
		}

        wp_reset_postdata();

        return $html;
	}

    protected function getAdditionalClasses($params) {

        $holderClasses = array();

        if ($params['number_of_posts'] !== '') {
            $holderClasses[] = 'mkd-pswt-number-'.$params['number_of_posts'];
        }

        return $holderClasses;
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

	private function getImageParams($id){
		$background_image_thumbs_style = '';

		$background_image_thumbs = wp_get_attachment_image_src(get_post_thumbnail_id($id),'discussion_landscape');

		if (count($background_image_thumbs) && is_array($background_image_thumbs)){
			$background_image_thumbs_style = 'background-image: url('.$background_image_thumbs[0].')';
		}

		return $background_image_thumbs_style;
	}
}