<?php
namespace Discussion\Modules\Tabs;

use Discussion\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */

class Tabs implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'mkd_tabs';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Mikado Tabs', 'discussionwp'),
			'base' => $this->getBase(),
			'as_parent' => array('only' => 'mkd_tab'),
			'content_element' => true,
			'show_settings_on_create' => true,
			'category' => 'by MIKADO',
			'icon' => 'icon-wpb-tabs extended-custom-icon',
			'js_view' => 'VcColumnView',
			'params' => array(
                array(
                    'type' => 'dropdown',
                    'admin-label' => true,
                    'heading' => 'Tabs Layout',
                    'param_name' => 'tabs_layout',
                    'value' => array(
                        'Default' => 'mkd-tabs-regular',
                        'With Title' => 'mkd-tabs-with-title'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => 'Tab Title',
                    'param_name' => 'tabs_title',
                    'description' => '',
                    'dependency'  => array('element' => 'tabs_layout', 'value' => array('mkd-tabs-with-title')),
                    'group'      => 'Title Settings'
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
                    'dependency' => array('element' => 'tabs_title', 'not_empty' => true),
                    'group'      => 'Title Settings'
                )
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'tabs_layout' => 'mkd-tabs-regular',
			'tabs_title' => '',
			'title_tag' => 'span'
		);
		
		$args = array_merge($args, discussion_icon_collections()->getShortcodeParams());
        $params  = shortcode_atts($args, $atts);
		
		extract($params);
		
		// Extract tab titles
		preg_match_all('/title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		$params['tabs_classes'] = $this->getTabsClasses($params);


		/**
		 * get tab titles array
		 *
		 */
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach($tab_titles as $tab) {
			preg_match('/title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['tabs_titles'] = $tab_title_array;

		$params['content'] = $content;

		$output = discussion_get_shortcode_module_template_part('templates/tabs-template','tabs', '', $params);
		
		return $output;
	}

	/**
	 * Return tabs classes
	 *
	 * @param $params
	 * @return string
	 */
	private function getTabsClasses($params) {
		$tabs_classes = array();

		if ($params['tabs_layout'] !== ''){
			$tabs_classes[] = $params['tabs_layout'];
		}

		return implode(' ', $tabs_classes);
	}
}