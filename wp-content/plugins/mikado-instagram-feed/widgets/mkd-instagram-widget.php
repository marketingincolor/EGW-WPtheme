<?php
if(!defined('ABSPATH')) exit;

class MikadoInstagramWidget extends WP_Widget {

	protected $params;

	public function __construct() {
		parent::__construct(
			'mkd_instagram_widget',
			'Mikado Instagram Widget',
			array( 'description' => esc_html__( 'Display instagram images', 'discussionwp' ) )
		);

		$this->setParams();
	}

	protected function setParams() {
		$this->params = array(
			array(
				'name' => 'title',
				'type' => 'textfield',
				'title' => 'Title'
			),
			array(
				'name' => 'tag',
				'type' => 'textfield',
				'title' => 'Tag'
			),
			array(
				'name' => 'number_of_photos',
				'type' => 'textfield',
				'title' => 'Number of photos'
			),
			array(
				'name' => 'number_of_cols',
				'type' => 'dropdown',
				'title' => 'Number of columns',
				'options' => array(
					'3' => 'Three',
					'2' => 'Two',
					'4' => 'Four',
					'6' => 'Six',
					'9' => 'Nine',
				)
			),
			array(
				'name' => 'image_size',
				'type' => 'dropdown',
				'title' => 'Image Size',
				'options' => array(
					'thumbnail' => 'Small',
					'low_resolution' => 'Medium',
					'standard_resolution' => 'Large'
				)
			),
			array(
				'name' => 'transient_time',
				'type' => 'textfield',
				'title' => 'Images Cache Time'
			),
		);
	}
	public function getParams() {
		return $this->params;
	}

	public function widget($args, $instance) {
		$title = '';
		$tag = '';
		$number_of_photos = '';
		$number_of_cols = '';
		$image_size = 'thumbnail';
		$transient_time = array();
		extract($instance);

		$instagram_api = MikadoInstagramApi::getInstance();
		$images_array = $instagram_api->getImages($number_of_photos, $tag, array(
			'use_transients' => true,
			'transient_name' => $args['widget_id'],
			'transient_time' => $transient_time
		));

		$number_of_cols = $number_of_cols == '' ? 3 : $number_of_cols;

		echo $args['before_widget'];

		if(is_array($images_array) && count($images_array)) {

			if($title !== '') {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			?>
			<ul class="mkd-instagram-feed clearfix mkd-col-<?php echo $number_of_cols; ?>">
				<?php
				foreach ($images_array as $image) { ?>
					<li>
						<a href="<?php echo esc_url($instagram_api->getHelper()->getImageLink($image)); ?>" target="_blank">
							<?php echo discussion_kses_img($instagram_api->getHelper()->getImageHTML($image, $image_size)); ?>
							<span class="fa fa-instagram"></span>
						</a>
					</li>
				<?php } ?>
			</ul>
		<?php }

		echo $args['after_widget'];
	}

	public function form($instance) {
		foreach ($this->params as $param_array) {
			$param_name = $param_array['name'];
			${$param_name} = isset( $instance[$param_name] ) ? esc_attr( $instance[$param_name] ) : '';
		}
		$instagram_api = MikadoInstagramApi::getInstance();

		//user has connected with instagram. Show form
		if($instagram_api->hasUserConnected()) {
			foreach ($this->params as $param) {
				switch($param['type']) {
					case 'textfield':
						?>
						<p>
							<label for="<?php echo esc_attr($this->get_field_id( $param['name'] )); ?>"><?php echo
								esc_html($param['title']); ?></label>
							<input class="widefat" id="<?php echo esc_attr($this->get_field_id( $param['name'] )); ?>" name="<?php echo esc_attr($this->get_field_name( $param['name'] )); ?>" type="text" value="<?php echo esc_attr( ${$param['name']} ); ?>" />
						</p>
						<?php
						break;
					case 'dropdown':
						?>
						<p>
							<label for="<?php echo esc_attr($this->get_field_id( $param['name'] )); ?>"><?php echo
								esc_html($param['title']); ?></label>
							<?php if(isset($param['options']) && is_array($param['options']) && count($param['options'])) { ?>
								<select class="widefat" name="<?php echo esc_attr($this->get_field_name( $param['name'] )); ?>" id="<?php echo esc_attr($this->get_field_id( $param['name'] )); ?>">
									<?php foreach ($param['options'] as $param_option_key => $param_option_val) {
										$option_selected = '';
										if(${$param['name']} == $param_option_key) {
											$option_selected = 'selected';
										}
										?>
										<option <?php echo esc_attr($option_selected); ?> value="<?php echo esc_attr($param_option_key); ?>"><?php echo esc_attr($param_option_val); ?></option>
									<?php } ?>
								</select>
							<?php } ?>
						</p>

						<?php
						break;
				}
			}
		}
	}
}

function mkd_instagram_widget_load(){
	register_widget('MikadoInstagramWidget');
}

add_action('widgets_init', 'mkd_instagram_widget_load');