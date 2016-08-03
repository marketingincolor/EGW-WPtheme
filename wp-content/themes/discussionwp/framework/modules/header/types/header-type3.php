<?php
namespace Discussion\Modules\Header\Types;

use Discussion\Modules\Header\Lib\HeaderType;
/**
 * Class that represents Header Type 1 layout and option
 *
 * Class HeaderType3
 */
class HeaderType3 extends HeaderType {

    protected $heightOfTransparency;
    protected $heightOfHeader;

    /**
     * Sets slug property which is the same as value of option in DB
     */
    public function __construct() {
        $this->slug = 'header-type3';

        if(!is_admin()) {
            $logoAreaHeight       = discussion_filter_px(discussion_options()->getOptionValue('logo_area_height_header_type3'));
            $this->logoAreaHeight = $logoAreaHeight !== '' ? discussion_filter_px($logoAreaHeight) : 117;

            $menuAreaHeight       = discussion_filter_px(discussion_options()->getOptionValue('menu_area_height_header_type3'));
            $this->menuAreaHeight = $menuAreaHeight !== '' ? (int)$menuAreaHeight : 50;

            add_action('wp', array($this, 'setHeaderHeightProps'));

            add_filter('discussion_js_global_variables', array($this, 'getGlobalJSVariables'));
            add_filter('discussion_per_page_js_vars', array($this, 'getPerPageJSVariables'));
        }
    }

    /**
     * Sets header height properties after WP object is set up
     */
    public function setHeaderHeightProps(){
        $this->heightOfTransparency = $this->calculateHeightOfTransparency();
        $this->heightOfHeader = $this->calculateHeightOfNonTransparentHeader();
    }

    /**
     * Returns total height of transparent parts of header
     *
     * @return int
     */
    public function calculateHeightOfTransparency() {
        $transparencyHeight = 0;
        $headerTransparent = false;

        if($headerTransparent) {
            $transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight + discussion_get_top_bar_height();
        }

        return $transparencyHeight;
    }

    /**
     * Returns total height of header parts, needed in full screen post slider
     *
     * @return int
     */
    public function calculateHeightOfNonTransparentHeader() {
        $headerTransparent = false;

        if($headerTransparent) {
            $transparencyHeight = 0;
        }else{
            $transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight + discussion_get_top_bar_height();
        }

        return $transparencyHeight;
    }

    /**
     * Loads template file for this header type
     *
     * @param array $parameters associative array of variables that needs to passed to template
     */
    public function loadTemplate($parameters = array()) {

        $parameters = apply_filters('discussion_header_type3_parameters', $parameters);

        discussion_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
    }

    /**
     * Returns global js variables of header
     *
     * @param $globalVariables
     * @return int|string
     */
    public function getGlobalJSVariables($globalVariables) {
        $globalVariables['mkdLogoAreaHeight'] = $this->logoAreaHeight;
        $globalVariables['mkdMenuAreaHeight'] = $this->menuAreaHeight;

        return $globalVariables;
    }

    /**
     * Returns per page js variables of header
     *
     * @param $perPageVars
     * @return int|string
     */
    public function getPerPageJSVariables($perPageVars) {

        $perPageVars['mkdHeaderTransparencyHeight'] = $this->heightOfTransparency;
        $perPageVars['mkdHeaderHeight'] = $this->heightOfHeader;

        return $perPageVars;
    }
}