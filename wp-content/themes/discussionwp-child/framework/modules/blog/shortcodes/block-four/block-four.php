<?php
namespace Discussion\Modules\Blog\Shortcodes\BlockFour;

use Discussion\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class BlockFour
 */
class BlockFour extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkd_block_four';
        $this->css_class = 'mkd-pb-four';
        $this->shortcode_title = 'Mikado Block 4';

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

        $args_featured = array(
            'featured_title_tag' => 'h2',
            'featured_title_length' => '',
            'featured_display_date' => 'yes',
            'featured_date_format' => 'd. F Y',
            'featured_display_category' => 'yes',
            'featured_display_excerpt' => 'yes',
            'featured_excerpt_length' => '30',
            'featured_thumb_image_size' => '',
            'featured_thumb_image_width' => '',
            'featured_thumb_image_height' => '',
            'slider_height' => ''
        );

        $args = array(
            'title_tag' => 'h6',
            'title_length' => '',
            'display_image' => 'yes',
            'display_date' => 'yes',
            'date_format' => 'd. F Y',
            'custom_thumb_image_width' => '86',
            'custom_thumb_image_height' => '86'
        );

        $params = shortcode_atts($args, $atts);
        $params_featured = shortcode_atts($args_featured, $atts);

        $params_featured_filtered = discussion_get_filtered_params($params_featured, 'featured');
        $params_featured_filtered['content_in_grid'] = $atts['content_in_grid'];

        $data = $this->getData($params_featured);

        $params['display_excerpt'] = 'no';
        $params['image_style'] = $this->getImageStyle($params);

        $html = '';

        if ($atts['query_result']->have_posts()):

            $html .= '<div class="mkd-bnl-inner">';
            $html .= '<div class="mkd-post-block-part mkd-pb-four-featured mkd-pbr-featured" '.esc_attr($data).'>';
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

				$id = get_the_ID();
				$image_params = $this->getImageParams($params_featured_filtered,$id);
				$params_featured_filtered = array_merge($params_featured_filtered,$image_params);

                //Get HTML from template
                $html .= '<div class="mkd-post-block-part-inner">';
                $html .= discussion_get_list_shortcode_module_template_part('post-template-five', 'templates', 'block-four', $params_featured_filtered);
                $html .= '</div>'; // close mkd-post-block-part-inner


            endwhile;
            $html .= '</div>'; // close mkd-pb-four-featured

            $html .= '<div class="mkd-post-block-part mkd-pb-four-non-featured">';
            $html .= '<span class="mkd-hide-show-button">';
            $html .= '<span>'.esc_html__('Show','discussionwp').'</span>';
            $html .= '<span>'.esc_html__('Hide','discussionwp').'</span>';
            $html .= '</span>';
            $html .= '<div class="mkd-pb-non-featured-inner mkd-pbr-non-featured">';
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

               //Get HTML from template
            	$html .= '<div class="mkd-pb-item-row mkd-post-reveal-item">';
                $html .= discussion_get_list_shortcode_module_template_part('post-template-seven', 'templates', '', $params);
                $html .= '</div>';

            endwhile;
            $html .= '</div>'; // close mkd-pb-four-non-featured-inner
            $html .= '</div>'; // close mkd-pb-four-non-featured

            $html .= '</div>'; // close mkd-bnl-inner

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

		$holder_classes[] = 'mkd-block-revealing';

        return $holder_classes;
    }


    private function getImageStyle($params) {
        $style = array();

        if ($params['custom_thumb_image_width'] !== '') {
            $style[] = 'width: '.discussion_filter_px($params['custom_thumb_image_width']).'px';
        }

        return implode(';', $style);
    }

	private function getData($params){
		$data = '';

		if($params['slider_height'] !== ''){
			$data .= 'data-image-height='.esc_attr($params['slider_height']).' ';
		}

		return $data;
	}

	private function getImageParams($featured_params,$id){
		$params = array();
		$params['proportion'] = 1;
		$params['background_image'] = '';
		$background_image = array();


        if($featured_params['thumb_image_size'] != 'custom_size') {
			$background_image = wp_get_attachment_image_src(get_post_thumbnail_id($id),$featured_params['thumb_image_size']);
			if (count($background_image) && is_array($background_image)){
				$params['proportion'] = $background_image[2]/$background_image[1]; //get height/width proportion
				$params['background_image'] = 'background-image: url('.$background_image[0].')';
			}
        }
        elseif($featured_params['thumb_image_width'] != '' && $featured_params['thumb_image_height'] != ''){
            $background_image = discussion_resize_image(get_post_thumbnail_id($id),'',$featured_params['thumb_image_width'],$featured_params['thumb_image_height']);
			if (count($background_image) && is_array($background_image)){
				$params['proportion'] = $background_image['img_height']/$background_image['img_width']; //get height/width proportion
				$params['background_image'] = 'background-image: url('.$background_image['img_url'].')';
			}
        }

		return $params;
	}
}