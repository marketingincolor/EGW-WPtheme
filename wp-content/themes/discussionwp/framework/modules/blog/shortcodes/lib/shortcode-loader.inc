<?php

namespace Discussion\Modules\Blog\Shortcodes\Lib;

/* 
	Sliders
*/
use Discussion\Modules\Blog\Shortcodes\PostSlider\PostSlider;
use Discussion\Modules\Blog\Shortcodes\PostSliderWithThumbnails\PostSliderWithThumbnails;
use Discussion\Modules\Blog\Shortcodes\PostSliderInteractive\PostSliderInteractive;
use Discussion\Modules\Blog\Shortcodes\PostCarousel\PostCarousel;
use Discussion\Modules\Blog\Shortcodes\PostCarouselSwipe\PostCarouselSwipe;

/* 
	Layouts - shortcodes
*/
use Discussion\Modules\Blog\Shortcodes\PostLayoutOne\PostLayoutOne;
use Discussion\Modules\Blog\Shortcodes\PostLayoutTwo\PostLayoutTwo;
use Discussion\Modules\Blog\Shortcodes\PostLayoutThree\PostLayoutThree;
use Discussion\Modules\Blog\Shortcodes\PostLayoutFour\PostLayoutFour;
use Discussion\Modules\Blog\Shortcodes\PostLayoutFive\PostLayoutFive;
use Discussion\Modules\Blog\Shortcodes\PostLayoutSix\PostLayoutSix;
use Discussion\Modules\Blog\Shortcodes\PostLayoutSeven\PostLayoutSeven;
use Discussion\Modules\Blog\Shortcodes\PostLayoutEight\PostLayoutEight;
use Discussion\Modules\Blog\Shortcodes\PostLayoutNine\PostLayoutNine;

/* 
	Blocks - combinations of several layouts
*/
use Discussion\Modules\Blog\Shortcodes\BlockOne\BlockOne;
use Discussion\Modules\Blog\Shortcodes\BlockTwo\BlockTwo;
use Discussion\Modules\Blog\Shortcodes\BlockThree\BlockThree;
use Discussion\Modules\Blog\Shortcodes\BlockFour\BlockFour;
use Discussion\Modules\Blog\Shortcodes\BlockFive\BlockFive;
use Discussion\Modules\Blog\Shortcodes\BlockSix\BlockSix;
use Discussion\Modules\Blog\Shortcodes\BlockSeven\BlockSeven;

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
	 * Adds new shortcode. Object that it takes must implement ListShortcode
	 * @param ListShortcode $shortcode
	 */
	private function addShortcode(ListShortcode $shortcode) {
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
		$this->addShortcode(new PostSlider());
		$this->addShortcode(new PostSliderWithThumbnails());
		$this->addShortcode(new PostSliderInteractive());
		$this->addShortcode(new PostCarousel());
		$this->addShortcode(new PostCarouselSwipe());
		$this->addShortcode(new PostLayoutOne());
        $this->addShortcode(new PostLayoutTwo());
        $this->addShortcode(new PostLayoutThree());
        $this->addShortcode(new PostLayoutFour());
        $this->addShortcode(new PostLayoutFive());
        $this->addShortcode(new PostLayoutSix());
        $this->addShortcode(new PostLayoutSeven());
        $this->addShortcode(new PostLayoutEight());
        $this->addShortcode(new PostLayoutNine());
		$this->addShortcode(new BlockOne());
		$this->addShortcode(new BlockTwo());
		$this->addShortcode(new BlockThree());
		$this->addShortcode(new BlockFour());
		$this->addShortcode(new BlockFive());
		$this->addShortcode(new BlockSix());
		$this->addShortcode(new BlockSeven());
	}
	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach ($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'renderHolders'));
		}
	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();