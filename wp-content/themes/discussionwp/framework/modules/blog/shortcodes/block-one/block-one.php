<?php
namespace Discussion\Modules\Blog\Shortcodes\BlockOne;

use Discussion\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class BlockOne
 */
class BlockOne extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkd_block_one';
        $this->css_class = 'mkd-pb-one';
        $this->shortcode_title = 'Mikado Block 1';

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
            'featured_display_excerpt' => 'yes',
            'featured_excerpt_length' => '30',
            'featured_display_share' => 'yes',
            'featured_display_count' => 'yes',
            'featured_display_read_more' => 'yes',
            'featured_thumb_image_size' => '',
            'featured_thumb_image_width' => '',
            'featured_thumb_image_height' => '',
			'featured_display_rating' => 'no',
        );

        $args = array(
            'title_tag' => 'h6',
            'title_length' => '',
            'display_image' => 'yes',
            'display_date' => 'yes',
            'date_format' => 'd. F Y',
            'display_excerpt' => 'no',
            'excerpt_length' => '10',
            'custom_thumb_image_width' => '118',
            'custom_thumb_image_height' => '86'
        );

        $params = shortcode_atts($args, $atts);
        $params_featured = shortcode_atts($args_featured, $atts);

        $params_featured_filtered = discussion_get_filtered_params($params_featured, 'featured');

        $html = '';

        $params['image_style'] = $this->getImageStyle($params);

        $loop_counter = 0;
        if ($atts['query_result']->have_posts()):

            $html .= '<div class="mkd-bnl-inner">';
            
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();
                $loop_counter++;

                if($loop_counter == 1){
                    $html .= '<div class="mkd-post-block-part mkd-pb-one-featured">';
                        //Get HTML from template
                        $html .= discussion_get_list_shortcode_module_template_part('post-template-one', 'templates', '', $params_featured_filtered);
                    $html .= '</div>';
                    $html .= '<div class="mkd-post-block-part mkd-pb-one-non-featured">';
                } else {
                    //Get HTML from template
                    $html .= discussion_get_list_shortcode_module_template_part('post-template-seven', 'templates', '', $params);
                }

            endwhile;

            $html .= '</div>'; // close mkd-pb-one-non-featured
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

        if (isset($params['skin']) && $params['skin'] !== '') {
            $holder_classes[] = $params['skin'];
        }

        if (isset($params['block_proportion']) && $params['block_proportion'] !== '') {
            $holder_classes[] = $params['block_proportion'];
        }

        return $holder_classes;
    }

    private function getImageStyle($params) {
        $style = array();

        if ($params['custom_thumb_image_width'] !== '') {
            $style[] = 'width: '.discussion_filter_px($params['custom_thumb_image_width']).'px';
        }

        return implode(';', $style);
    }
}