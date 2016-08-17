<?php
namespace Discussion\Modules\SectionTitle;

use Discussion\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class ExpandingVideoPost
 */
class SectionTitle implements ShortcodeInterface{
    /**
     * @var string
     */
	private $base;

	function __construct() {
		$this->base = 'mkd_section_title';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /*
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     */

	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Mikado Section Title', 'discussionwp'),
            'base' => $this->getBase(),
			'icon' => 'icon-wpb-section-title extended-custom-icon',
			'category' => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'params' => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => 'Title',
                    'param_name' => 'title',
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Title Tag',
                    'param_name' => 'title_tag',
                    'value' => array(
                        'Default'   => '',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6',
                        'span' => 'span'
                    ),
                    'description' => '',
                    'dependency' => array('element' => 'title', 'not_empty' => true),
                ),
                array(
                	'type' => 'dropdown',
                	'heading' => 'Pattern Style',
                	'param_name' => 'pattern_style',
                	'value' => array(
                		'Light' => 'light',
                		'Dark' => 'dark'
            		),
            		'save_always' => true
            	)
			)
		) );

	}

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'title' => '',
            'title_tag' => 'span',
            'pattern_style' => ''
        );

        $params = shortcode_atts($args, $atts);

        $params['classes'] = $this->getTitleClass($params);

        //Get HTML from template
        $html = discussion_get_shortcode_module_template_part('templates/section-title-template', 'section-title', '', $params);

        return $html;
	}

	private function getTitleClass($params){
		$classes = '';

		if ($params['pattern_style'] !== ''){
			$classes .= 'mkd-pattern-'.$params['pattern_style'];
		}
		
		return $classes;
	}
}