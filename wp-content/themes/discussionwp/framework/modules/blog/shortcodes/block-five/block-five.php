<?php
namespace Discussion\Modules\Blog\Shortcodes\BlockFive;

use Discussion\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class BlockFive
 */
class BlockFive extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkd_block_five';
        $this->css_class = 'mkd-pb-five';
        $this->shortcode_title = 'Mikado Block 5';

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
            'title_tag' => 'h3',
            'title_length' => '',
            'display_date' => 'no',
            'date_format' => 'd. F Y',
            'display_category' => 'yes',
            'display_comments' => 'yes',
            'display_share' => 'yes',
            'display_count' => 'yes',
        );

        $params = shortcode_atts($args, $atts);

        $post_no = 1;
        $smaller_title_tag = $this->getTitleTagSmaller($params);

        $html = '';

        if ($atts['query_result']->have_posts()):

            $html .= '<div class="mkd-bnl-inner">';
            $html .= '<div class="mkd-post-block-part clearfix">';
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

				$id = get_the_ID();
				$background_image_style = $this->getImageBackground($id);
				$params['background_image_style'] = $background_image_style;
				$params['post_no_class'] = 'mkd-post-number-'.$post_no;

				if ($post_no > 1){
					$params['title_tag'] = $smaller_title_tag;
				}

                //Get HTML from template
                $html .= discussion_get_list_shortcode_module_template_part('post-template-five', 'templates', 'blocks', $params);
                $post_no++;

            endwhile;
            $html .= '</div>'; // close mkd-pb-five-featured
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

	/**
	* Returns background image style
	*/
	private function getImageBackground($id){
		$background_image_style = '';

		$background_image = wp_get_attachment_image_src(get_post_thumbnail_id($id),'full');

		if (count($background_image) && is_array($background_image)){
			$background_image_style = 'background-image: url('.$background_image[0].')';
		}

		return $background_image_style;
	}


	/**
	* Returns title tag for smaller posts
	*/
	private function getTitleTagSmaller($params){
		$title_tag = 'h4';

		switch ($params['title_tag']) {
			case 'h1':
				$title_tag = 'h2';
				break;			
			case 'h2':
				$title_tag = 'h3';
				break;
			case 'h3':
				$title_tag = 'h4';
				break;
			case 'h4':
				$title_tag = 'h5';
				break;
			case 'h5':
				$title_tag = 'h6';
				break;
			case 'h6':
				$title_tag = 'h6';
				break;
			default:
				$title_tag = 'h4';
				break;
		}

		return $title_tag;
	}
}