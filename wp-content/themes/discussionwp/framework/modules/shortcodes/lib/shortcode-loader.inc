<?php

namespace Discussion\Modules\Shortcodes\Lib;

use Discussion\Modules\Shortcodes\Button\Button;
use Discussion\Modules\CustomFont\CustomFont;
use Discussion\Modules\Dropcaps\Dropcaps;
use Discussion\Modules\Highlight\Highlight;
use Discussion\Modules\Shortcodes\Icon\Icon;
use Discussion\Modules\OrderedList\OrderedList;
use Discussion\Modules\SectionTitle\SectionTitle;
use Discussion\Modules\Separator\Separator;
use Discussion\Modules\SocialShare\SocialShare;
use Discussion\Modules\Tabs\Tabs;
use Discussion\Modules\Tab\Tab;
use Discussion\Modules\GoogleMap\GoogleMap;
use Discussion\Modules\VerticalSeparator\VerticalSeparator;
use Discussion\Modules\ImageWithHoverInfo\ImageWithHoverInfo;
use Discussion\Modules\ImageWithHoverInfoItem\ImageWithHoverInfoItem;

/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader {
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	/**
	 * @var array
	 */
	private $loadedShortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 * @param ShortcodeInterface $shortcode
	 */
	private function addShortcode(ShortcodeInterface $shortcode) {
		if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
			$this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode(new Button());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new Icon());
		$this->addShortcode(new OrderedList());
		$this->addShortcode(new SectionTitle());
		$this->addShortcode(new Separator());
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new Tabs());
		$this->addShortcode(new Tab());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new VerticalSeparator());
		$this->addShortcode(new ImageWithHoverInfo());
		$this->addShortcode(new ImageWithHoverInfoItem());
	}
	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach ($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		}
	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();