<?php
namespace Discussion\Modules\Blog\Shortcodes\PostSliderInteractive;

use Discussion\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostSliderInteractive
 */
class PostSliderInteractive extends ListShortcode {

	/**
	 * @var string
	 */
    private $base;
    private $css_class;
    private $shortcode_title;

	public function __construct() {
		$this->base = 'mkd_post_slider_interactive';
        $this->css_class = 'mkd-psi';
        $this->shortcode_title = 'Mikado Post Slider Interactive';

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
            'slider_height' => ''
		);

		$params = shortcode_atts($args, $atts);
        $html = '';
        $thumb_html = '';

        $data = $this->getData($params,$atts);

        if($atts['query_result']->have_posts()):
            $html .= '<div class="mkd-psi-slider" '.esc_attr($data).'>';

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

				$id = get_the_ID();
				$image_params = $this->getImageParams($id);
				$params = array_merge($params,$image_params);

                //Get HTML from template
                $html .= discussion_get_list_shortcode_module_template_part('templates/post-slider-interactive-template', 'post-slider-interactive', '', $params);
                $thumb_html .= discussion_get_list_shortcode_module_template_part('templates/post-slider-int-thumbnails-template', 'post-slider-interactive', '', $params);

            endwhile;

            $html .= '</div>';
            else:
                $html .= $this->errorMessage();

        endif;

		if ($thumb_html !== ''){
			$html .= '<div class="mkd-psi-thumb-slider-holder">';
			$html .= '<div class="mkd-grid">';
			$html .= '<div class="mkd-psi-slider-thumb">';
			$html .= $thumb_html;
			$html .= '</div>';
			$html .= '</div>';
			$html .= '<div class="mkd-psi-thumb-slider-backg">';
			$html .= '</div>';
			$html .= '</div>';
		}

        wp_reset_postdata();

        return $html;
	}

    protected function getAdditionalClasses($params) {

        $holderClasses = array();

        if ($params['number_of_posts'] !== '') {
            $holderClasses[] = 'mkd-psi-number-'.$params['number_of_posts'];
        }

        return $holderClasses;
    }

    /*
    ** Return Image Parameters
    */

	private function getImageParams($id){
		$params = array();
		$params['proportion'] = 1;
		$params['background_image'] = '';
		$params['background_image_thumbs'] = '';

		$background_image = wp_get_attachment_image_src(get_post_thumbnail_id($id),'full');
		$background_image_thumbs = wp_get_attachment_image_src(get_post_thumbnail_id($id),'discussion_landscape');

		if (count($background_image) && is_array($background_image)){
			$width = $background_image[1];
			$height = $background_image[2];
			$params['proportion'] = $height/$width; //get height/width proportion
			$params['background_image'] = 'background-image: url('.$background_image[0].')';
		}

		if (count($background_image_thumbs) && is_array($background_image_thumbs)){
			$params['background_image_thumbs'] = 'background-image: url('.$background_image_thumbs[0].')';
		}

		return $params;
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

    /*
    ** Returns data for slider
    */
	private function getData($params,$atts){
		$data = '';

		if($params['slider_height'] !== ''){
			$data .= 'data-image-height='.esc_attr($params['slider_height']).' ';
		}

		if($atts['number_of_posts'] !== ''){
			$data .= 'data-posts-no='.esc_attr($atts['number_of_posts']).' ';
		}

		return $data;

	}
}