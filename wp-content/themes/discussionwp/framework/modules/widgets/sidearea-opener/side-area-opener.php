<?php

class DiscussionSideAreaOpener extends DiscussionWidget {
    public function __construct() {
        parent::__construct(
            'mkd_side_area_opener', // Base ID
            'Mikado Side Area Opener' // Name
        );

        $this->setParams();
    }

    protected function setParams() {

		$this->params = array(
			array(
				'name'			=> 'side_area_opener_icon_color',
				'type'			=> 'textfield',
				'title'			=> 'Icon Color',
				'description'	=> 'Define color for Side Area opener icon'
			)
		);

    }


    public function widget($args, $instance) {
		
		$sidearea_icon_styles = array();

		if ( !empty($instance['side_area_opener_icon_color']) ) {
			$sidearea_icon_styles[] = 'color: ' . $instance['side_area_opener_icon_color'];
		}
		
		$icon_size = '';
		if ( discussion_options()->getOptionValue('side_area_predefined_icon_size') ) {
			$icon_size = discussion_options()->getOptionValue('side_area_predefined_icon_size');
		}

        print $args['before_widget'];
		?>

        <a class="mkd-side-menu-button-opener <?php echo esc_attr( $icon_size ); ?>" <?php discussion_inline_style($sidearea_icon_styles) ?> href="javascript:void(0)">
            <?php echo discussion_get_side_menu_icon_html(); ?>
        </a>

        <?php print $args['after_widget']; ?>
    <?php }

}