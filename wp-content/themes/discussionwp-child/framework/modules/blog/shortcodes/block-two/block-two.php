<?php
namespace Discussion\Modules\Blog\Shortcodes\BlockTwo;

use Discussion\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class BlockTwo
 */
class BlockTwo extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkd_block_two';
        $this->css_class = 'mkd-pb-two';
        $this->shortcode_title = 'Mikado Block 2';

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
            'featured_title_tag' => 'h3',
            'featured_title_length' => '',
            'featured_display_date' => 'yes',
            'featured_date_format' => 'd. F Y',
            'featured_display_category' => 'no',
            'featured_display_comments' => 'yes',
            'featured_display_share' => 'yes',
            'featured_display_count' => 'yes',
            'featured_display_read_more' => 'no',
			'featured_display_excerpt' => 'no',
			'featured_excerpt_length' => '20',
            'featured_thumb_image_size' => '',
            'featured_thumb_image_width' => '',
            'featured_thumb_image_height' => ''
        );

        $args = array(
            'title_tag' => 'h5',
            'title_length' => '',
            'display_date' => 'yes',
            'date_format' => 'd F Y',
            'display_category' => 'no'
        );

        $params = shortcode_atts($args, $atts);
        $params_featured = shortcode_atts($args_featured, $atts);

        $params_featured_filtered = discussion_get_filtered_params($params_featured, 'featured');
        
		$params['classes'] = $this->itemClasses($params);

        $html = '';

        if ($atts['query_result']->have_posts()):

            $html .= '<div class="mkd-bnl-inner">';
            $html .= '<div class="mkd-post-block-part mkd-pb-two-featured mkd-pbr-featured">';
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= '<div class="mkd-post-block-part-inner">';
                $html .= discussion_get_list_shortcode_module_template_part('post-template-five', 'templates', '', $params_featured_filtered);
                $html .= '</div>'; // close mkd-post-block-part-inner


            endwhile;
            $html .= '</div>'; // close mkd-pb-two-featured

            $html .= '<div class="mkd-post-block-part mkd-pb-two-non-featured mkd-pbr-non-featured">';
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

               //Get HTML from template
            	$html .= '<div class="mkd-post-reveal-item">';
                $html .= discussion_get_list_shortcode_module_template_part('post-template-four', 'templates', '', $params);
                $html .= '</div>';

            endwhile;
            $html .= '</div>'; // close mkd-pb-two-non-featured

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

        if (isset($params['block_proportion']) && $params['block_proportion'] !== '') {
            $holder_classes[] = $params['block_proportion'];
        }

        return $holder_classes;
    }

	/*
	* Returns item classes
	*/
	private function itemClasses($params){
		$classes = '';

		if ($params['display_category'] == 'yes'){
			$classes .= 'mkd-pt-four-has-cat ';
		}

		return $classes;
	}
}