<?php

/*
   Interface: iDiscussionLayoutNode
   A interface that implements Layout Node methods
*/
interface iDiscussionLayoutNode
{
	public function hasChidren();
	public function getChild($key);
	public function addChild($key, $value);
}

/*
   Interface: iDiscussionRender
   A interface that implements Render methods
*/
interface iDiscussionRender
{
	public function render($factory);
}

/*
   Class: DiscussionPanel
   A class that initializes Mikado Panel
*/
class DiscussionPanel implements iDiscussionLayoutNode, iDiscussionRender {

	public $children;
	public $title;
	public $name;
	public $hidden_property;
	public $hidden_value;
	public $hidden_values;

	function __construct($title="",$name="",$hidden_property="",$hidden_value="",$hidden_values=array()) {
		$this->children = array();
		$this->title = $title;
		$this->name = $name;
		$this->hidden_property = $hidden_property;
		$this->hidden_value = $hidden_value;
		$this->hidden_values = $hidden_values;
	}

	public function hasChidren() {
		return (count($this->children) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			if (discussion_option_get_value($this->hidden_property)==$this->hidden_value)
				$hidden = true;
			else {
				foreach ($this->hidden_values as $value) {
					if (discussion_option_get_value($this->hidden_property)==$value)
						$hidden = true;

				}
			}
		}
		?>
		<div class="mkd-page-form-section-holder" id="mkd_<?php echo esc_attr($this->name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<h3 class="mkd-page-section-title"><?php echo esc_html($this->title); ?></h3>
			<?php
			foreach ($this->children as $child) {
				$this->renderChild($child, $factory);
			}
			?>
		</div>
	<?php
	}

	public function renderChild(iDiscussionRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: DiscussionContainer
   A class that initializes Mikado Container
*/
class DiscussionContainer implements iDiscussionLayoutNode, iDiscussionRender {

	public $children;
	public $name;
	public $hidden_property;
	public $hidden_value;
	public $hidden_values;

	function __construct($name="",$hidden_property="",$hidden_value="",$hidden_values=array()) {
		$this->children = array();
		$this->name = $name;
		$this->hidden_property = $hidden_property;
		$this->hidden_value = $hidden_value;
		$this->hidden_values = $hidden_values;
	}

	public function hasChidren() {
		return (count($this->children) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			if (discussion_option_get_value($this->hidden_property)==$this->hidden_value)
				$hidden = true;
			else {
				foreach ($this->hidden_values as $value) {
					if (discussion_option_get_value($this->hidden_property)==$value)
						$hidden = true;

				}
			}
		}
		?>
		<div class="mkd-page-form-container-holder" id="mkd_<?php echo esc_attr($this->name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<?php
			foreach ($this->children as $child) {
				$this->renderChild($child, $factory);
			}
			?>
		</div>
	<?php
	}

	public function renderChild(iDiscussionRender $child, $factory) {
		$child->render($factory);
	}
}


/*
   Class: DiscussionContainerNoStyle
   A class that initializes Mikado Container without css classes
*/
class DiscussionContainerNoStyle implements iDiscussionLayoutNode, iDiscussionRender {

	public $children;
	public $name;
	public $hidden_property;
	public $hidden_value;
	public $hidden_values;

	function __construct($name="",$hidden_property="",$hidden_value="",$hidden_values=array()) {
		$this->children = array();
		$this->name = $name;
		$this->hidden_property = $hidden_property;
		$this->hidden_value = $hidden_value;
		$this->hidden_values = $hidden_values;
	}

	public function hasChidren() {
		return (count($this->children) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			if (discussion_option_get_value($this->hidden_property)==$this->hidden_value)
				$hidden = true;
			else {
				foreach ($this->hidden_values as $value) {
					if (discussion_option_get_value($this->hidden_property)==$value)
						$hidden = true;

				}
			}
		}
		?>
		<div id="mkd_<?php echo esc_attr($this->name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<?php
			foreach ($this->children as $child) {
				$this->renderChild($child, $factory);
			}
			?>
		</div>
	<?php
	}

	public function renderChild(iDiscussionRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: DiscussionGroup
   A class that initializes Mikado Group
*/
class DiscussionGroup implements iDiscussionLayoutNode, iDiscussionRender {

	public $children;
	public $title;
	public $description;

	function __construct($title="",$description="") {
		$this->children = array();
		$this->title = $title;
		$this->description = $description;
	}

	public function hasChidren() {
		return (count($this->children) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		?>

		<div class="mkd-page-form-section">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($this->title); ?></h4>

				<p><?php echo esc_html($this->description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->

			<div class="mkd-section-content">
				<div class="container-fluid">
					<?php
					foreach ($this->children as $child) {
						$this->renderChild($child, $factory);
					}
					?>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php
	}

	public function renderChild(iDiscussionRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: DiscussionNotice
   A class that initializes Mikado Notice
*/
class DiscussionNotice implements iDiscussionRender {

	public $children;
	public $title;
	public $description;
	public $notice;
	public $hidden_property;
	public $hidden_value;
	public $hidden_values;

	function __construct($title="",$description="",$notice="",$hidden_property="",$hidden_value="",$hidden_values=array()) {
		$this->children = array();
		$this->title = $title;
		$this->description = $description;
		$this->notice = $notice;
		$this->hidden_property = $hidden_property;
		$this->hidden_value = $hidden_value;
		$this->hidden_values = $hidden_values;
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			if (discussion_option_get_value($this->hidden_property)==$this->hidden_value)
				$hidden = true;
			else {
				foreach ($this->hidden_values as $value) {
					if (discussion_option_get_value($this->hidden_property)==$value)
						$hidden = true;

				}
			}
		}
		?>

		<div class="mkd-page-form-section"<?php if ($hidden) { ?> style="display: none"<?php } ?>>


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($this->title); ?></h4>

				<p><?php echo esc_html($this->description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->

			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="alert alert-warning">
						<?php echo esc_html($this->notice); ?>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php
	}
}

/*
   Class: DiscussionRow
   A class that initializes Mikado Row
*/
class DiscussionRow implements iDiscussionLayoutNode, iDiscussionRender {

	public $children;
	public $next;

	function __construct($next=false) {
		$this->children = array();
		$this->next = $next;
	}

	public function hasChidren() {
		return (count($this->children) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		?>
		<div class="row<?php if ($this->next) echo " next-row"; ?>">
			<?php
			foreach ($this->children as $child) {
				$this->renderChild($child, $factory);
			}
			?>
		</div>
	<?php
	}

	public function renderChild(iDiscussionRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: DiscussionTitle
   A class that initializes Mikado Title
*/
class DiscussionTitle implements iDiscussionRender {
	private $name;
	private $title;
	public $hidden_property;
	public $hidden_values = array();

	function __construct($name="",$title="",$hidden_property="",$hidden_value="") {
		$this->title = $title;
		$this->name = $name;
		$this->hidden_property = $hidden_property;
		$this->hidden_value = $hidden_value;
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			if (discussion_option_get_value($this->hidden_property)==$this->hidden_value)
				$hidden = true;
		}
		?>
		<h5 class="mkd-page-section-subtitle" id="mkd_<?php echo esc_attr($this->name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>><?php echo esc_html($this->title); ?></h5>
	<?php
	}
}

/*
   Class: DiscussionField
   A class that initializes Mikado Field
*/
class DiscussionField implements iDiscussionRender {
	private $type;
	private $name;
	private $default_value;
	private $label;
	private $description;
	private $options = array();
	private $args = array();
	public $hidden_property;
	public $hidden_values = array();


	function __construct($type,$name,$default_value="",$label="",$description="", $options = array(), $args = array(),$hidden_property="", $hidden_values = array()) {		
		global $discussion_Framework;
		$this->type = $type;
		$this->name = $name;
		$this->default_value = $default_value;
		$this->label = $label;
		$this->description = $description;
		$this->options = $options;
		$this->args = $args;
		$this->hidden_property = $hidden_property;
		$this->hidden_values = $hidden_values;
		$discussion_Framework->mkdOptions->addOption($this->name,$this->default_value, $type);
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			foreach ($this->hidden_values as $value) {
				if (discussion_option_get_value($this->hidden_property)==$value)
					$hidden = true;

			}
		}
		$factory->render( $this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden );
	}
}

/*
   Class: DiscussionMetaField
   A class that initializes Mikado Meta Field
*/
class DiscussionMetaField implements iDiscussionRender {
	private $type;
	private $name;
	private $default_value;
	private $label;
	private $description;
	private $options = array();
	private $args = array();
	public $hidden_property;
	public $hidden_values = array();


	function __construct($type,$name,$default_value="",$label="",$description="", $options = array(), $args = array(),$hidden_property="", $hidden_values = array()) {
		global $discussion_Framework;
		$this->type = $type;
		$this->name = $name;
		$this->default_value = $default_value;
		$this->label = $label;
		$this->description = $description;
		$this->options = $options;
		$this->args = $args;
		$this->hidden_property = $hidden_property;
		$this->hidden_values = $hidden_values;
		$discussion_Framework->mkdMetaBoxes->addOption($this->name,$this->default_value);
	}

	public function render($factory) {
		$hidden = false;
		if (!empty($this->hidden_property)){
			foreach ($this->hidden_values as $value) {
				if (discussion_option_get_value($this->hidden_property)==$value)
					$hidden = true;

			}
		}
		$factory->render( $this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden );
	}
}

abstract class DiscussionFieldType {

	abstract public function render( $name, $label="",$description="", $options = array(), $args = array(), $hidden = false );

}

class DiscussionFieldText extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		$col_width = 12;
		if(isset($args["col_width"])) {
            $col_width = $args["col_width"];
        }

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;

		?>

		<div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->

			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-<?php echo esc_attr($col_width); ?>">
                            <?php if($suffix) : ?>
                            <div class="input-group">
                            <?php endif; ?>
                                <input type="text"
                                    class="form-control mkd-input mkd-form-element"
                                    name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(htmlspecialchars(discussion_option_get_value($name))); ?>"
                                    placeholder=""/>
                                <?php if($suffix) : ?>
                                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                                <?php endif; ?>
                            <?php if($suffix) : ?>
                            </div>
                            <?php endif; ?>

                        </div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldTextSimple extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {

		$suffix = !empty($args['suffix']) ? $args['suffix'] : false;

		?>


		<div class="col-lg-3" id="mkd_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<em class="mkd-field-description"><?php echo esc_html($label); ?></em>
			<?php if($suffix) : ?>
			<div class="input-group">
            <?php endif; ?>
				<input type="text"
				   class="form-control mkd-input mkd-form-element"
				   name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(htmlspecialchars(discussion_option_get_value($name))); ?>"
				   placeholder=""/>
				<?php if($suffix) : ?>
					<div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
				<?php endif; ?>
			<?php if($suffix) : ?>
			</div>
			<?php endif; ?>
		</div>
	<?php

	}

}

class DiscussionFieldTextArea extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		?>

		<div class="mkd-page-form-section">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->


			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<textarea class="form-control mkd-form-element"
									  name="<?php echo esc_attr($name); ?>"
									  rows="5"><?php echo esc_html(htmlspecialchars(discussion_option_get_value($name))); ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldTextAreaSimple extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		?>

		<div class="col-lg-3">
			<em class="mkd-field-description"><?php echo esc_html($label); ?></em>
			<textarea class="form-control mkd-form-element"
					  name="<?php echo esc_attr($name); ?>"
					  rows="5"><?php echo esc_html(discussion_option_get_value($name)); ?></textarea>
		</div>
	<?php

	}

}

class DiscussionFieldColor extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		?>

		<div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->

			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<input type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>" class="my-color-field"/>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldColorSimple extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		?>

		<div class="col-lg-3" id="mkd_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<em class="mkd-field-description"><?php echo esc_html($label); ?></em>
			<input type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>" class="my-color-field"/>
		</div>
	<?php

	}

}

class DiscussionFieldImage extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		?>

		<div class="mkd-page-form-section">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->

			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="mkd-media-uploader">
								<div<?php if (!discussion_option_has_value($name)) { ?> style="display: none"<?php } ?>
									class="mkd-media-image-holder">
									<img src="<?php if (discussion_option_has_value($name)) { echo esc_url(discussion_get_attachment_thumb_url(discussion_option_get_value($name))); } ?>" alt=""
										 class="mkd-media-image img-thumbnail"/>
								</div>
								<div style="display: none"
									 class="mkd-media-meta-fields">
									<input type="hidden" class="mkd-media-upload-url"
										   name="<?php echo esc_attr($name); ?>"
										   value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>
								</div>
								<a class="mkd-media-upload-btn btn btn-sm btn-primary"
								   href="javascript:void(0)"
								   data-frame-title="<?php esc_html_e('Select Image', 'discussionwp'); ?>"
								   data-frame-button-text="<?php esc_html_e('Select Image', 'discussionwp'); ?>"><?php esc_html_e('Upload', 'discussionwp'); ?></a>
								<a style="display: none;" href="javascript: void(0)"
								   class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'discussionwp'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldImageSimple extends DiscussionFieldType {

    public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
        ?>


        <div class="col-lg-3" id="mkd_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <div class="mkd-media-uploader">
                <div<?php if (!discussion_option_has_value($name)) { ?> style="display: none"<?php } ?>
                    class="mkd-media-image-holder">
                    <img src="<?php if (discussion_option_has_value($name)) { echo esc_url(discussion_get_attachment_thumb_url(discussion_option_get_value($name))); } ?>" alt=""
                         class="mkd-media-image img-thumbnail"/>
                </div>
                <div style="display: none"
                     class="mkd-media-meta-fields">
                    <input type="hidden" class="mkd-media-upload-url"
                           name="<?php echo esc_attr($name); ?>"
                           value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>
                </div>
                <a class="mkd-media-upload-btn btn btn-sm btn-primary"
                   href="javascript:void(0)"
                   data-frame-title="<?php esc_html_e('Select Image', 'discussionwp'); ?>"
                   data-frame-button-text="<?php esc_html_e('Select Image', 'discussionwp'); ?>"><?php esc_html_e('Upload', 'discussionwp'); ?></a>
                <a style="display: none;" href="javascript: void(0)"
                   class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'discussionwp'); ?></a>
            </div>
        </div>
    <?php

    }

}

class DiscussionFieldFont extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		global $discussion_fonts_array;
		?>

		<div class="mkd-page-form-section">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->



			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3">
							<select class="form-control mkd-form-element"
									name="<?php echo esc_attr($name); ?>">
								<option value="-1">Default</option>
								<?php foreach($discussion_fonts_array as $fontArray) { ?>
									<option <?php if (discussion_option_get_value($name) == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr(str_replace(' ', '+', $fontArray["family"])); ?>"><?php echo esc_html($fontArray["family"]); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldFontSimple extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		global $discussion_fonts_array;
		?>


		<div class="col-lg-3">
			<em class="mkd-field-description"><?php echo esc_html($label); ?></em>
			<select class="form-control mkd-form-element"
					name="<?php echo esc_attr($name); ?>">
				<option value="-1">Default</option>
				<?php foreach($discussion_fonts_array as $fontArray) { ?>
					<option <?php if (discussion_option_get_value($name) == str_replace(' ', '+', $fontArray["family"])) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr(str_replace(' ', '+', $fontArray["family"])); ?>"><?php echo esc_html($fontArray["family"]); ?></option>
				<?php } ?>
			</select>
		</div>
	<?php

	}

}

class DiscussionFieldSelect extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$show = array();
		if(isset($args["show"]))
			$show = $args["show"];
		$hide = array();
		if(isset($args["hide"]))
			$hide = $args["hide"];
		?>

		<div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>" <?php if ($hidden) { ?> style="display: none"<?php } ?>>


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->



			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3">
							<select class="form-control mkd-form-element<?php if ($dependence) { echo " dependence"; } ?>"
								<?php foreach($show as $key=>$value) { ?>
									data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
								<?php } ?>
								<?php foreach($hide as $key=>$value) { ?>
									data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
								<?php } ?>
									name="<?php echo esc_attr($name); ?>">
								<?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
									<option <?php if (discussion_option_get_value($name) == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldSelectBlank extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$show = array();
		if(isset($args["show"]))
			$show = $args["show"];
		$hide = array();
		if(isset($args["hide"]))
			$hide = $args["hide"];
		?>

		<div class="mkd-page-form-section"<?php if ($hidden) { ?> style="display: none"<?php } ?>>


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->



			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3">
							<select class="form-control mkd-form-element<?php if ($dependence) { echo " dependence"; } ?>"
								<?php foreach($show as $key=>$value) { ?>
									data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
								<?php } ?>
								<?php foreach($hide as $key=>$value) { ?>
									data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
								<?php } ?>
									name="<?php echo esc_attr($name); ?>">
								<option <?php if (discussion_option_get_value($name) == "") { echo "selected='selected'"; } ?>  value=""></option>
								<?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
									<option <?php if (discussion_option_get_value($name) == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldSelectSimple extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
        $dependence = false;
        if(isset($args["dependence"]))
            $dependence = true;
        $show = array();
        if(isset($args["show"]))
            $show = $args["show"];
        $hide = array();
        if(isset($args["hide"]))
            $hide = $args["hide"];
        ?>


		<div class="col-lg-3">
			<em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control mkd-form-element<?php if ($dependence) { echo " dependence"; } ?>"
                <?php foreach($show as $key=>$value) { ?>
                    data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                <?php foreach($hide as $key=>$value) { ?>
                    data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                    name="<?php echo esc_attr($name); ?>">
                <option <?php if (discussion_option_get_value($name) == "") { echo "selected='selected'"; } ?>  value=""></option>
                <?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
                    <option <?php if (discussion_option_get_value($name) == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
		</div>
	<?php

	}

}

class DiscussionFieldSelectBlankSimple extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
        $dependence = false;
        if(isset($args["dependence"]))
            $dependence = true;
        $show = array();
        if(isset($args["show"]))
            $show = $args["show"];
        $hide = array();
        if(isset($args["hide"]))
            $hide = $args["hide"];
        ?>


		<div class="col-lg-3">
			<em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control mkd-form-element<?php if ($dependence) { echo " dependence"; } ?>"
                <?php foreach($show as $key=>$value) { ?>
                    data-show-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                <?php foreach($hide as $key=>$value) { ?>
                    data-hide-<?php echo str_replace(' ', '',$key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                    name="<?php echo esc_attr($name); ?>">
                <option <?php if (discussion_option_get_value($name) == "") { echo "selected='selected'"; } ?>  value=""></option>
                <?php foreach($options as $key=>$value) { if ($key == "-1") $key = ""; ?>
                    <option <?php if (discussion_option_get_value($name) == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
		</div>
	<?php

	}

}

class DiscussionFieldYesNo extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->



			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (discussion_option_get_value($name) == "yes") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'discussionwp') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (discussion_option_get_value($name) == "no") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'discussionwp') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_yesno" value="yes"<?php if (discussion_option_get_value($name) == "yes") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_yesno" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}
}

class DiscussionFieldYesNoSimple extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="col-lg-3">
			<em class="mkd-field-description"><?php echo esc_html($label); ?></em>
			<p class="field switch">
				<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
					   class="cb-enable<?php if (discussion_option_get_value($name) == "yes") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'discussionwp') ?></span></label>
				<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
					   class="cb-disable<?php if (discussion_option_get_value($name) == "no") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'discussionwp') ?></span></label>
				<input type="checkbox" id="checkbox" class="checkbox"
					   name="<?php echo esc_attr($name); ?>_yesno" value="yes"<?php if (discussion_option_get_value($name) == "yes") { echo " selected"; } ?>/>
				<input type="hidden" class="checkboxhidden_yesno" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>
			</p>
		</div>
	<?php

	}
}

class DiscussionFieldOnOff extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->



			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">

							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (discussion_option_get_value($name) == "on") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('On', 'discussionwp') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (discussion_option_get_value($name) == "off") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Off', 'discussionwp') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_onoff" value="on"<?php if (discussion_option_get_value($name) == "on") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_onoff" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}
}

class DiscussionFieldZeroOne extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->



			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">

							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (discussion_option_get_value($name) == "1") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'discussionwp') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (discussion_option_get_value($name) == "0") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'discussionwp') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_zeroone" value="1"<?php if (discussion_option_get_value($name) == "1") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_zeroone" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldImageVideo extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->



			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch switch-type">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (discussion_option_get_value($name) == "image") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Image', 'discussionwp') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (discussion_option_get_value($name) == "video") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Video', 'discussionwp') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_imagevideo" value="image"<?php if (discussion_option_get_value($name) == "image") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_imagevideo" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldYesEmpty extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->



			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (discussion_option_get_value($name) == "yes") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'discussionwp') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (discussion_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'discussionwp') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_yesempty" value="yes"<?php if (discussion_option_get_value($name) == "yes") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_yesempty" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldFlagPage extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->



			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (discussion_option_get_value($name) == "page") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'discussionwp') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (discussion_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'discussionwp') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_flagpage" value="page"<?php if (discussion_option_get_value($name) == "page") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagpage" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldFlagPost extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->



			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (discussion_option_get_value($name) == "post") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'discussionwp') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (discussion_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'discussionwp') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_flagpost" value="post"<?php if (discussion_option_get_value($name) == "post") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagpost" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldFlagMedia extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		global $discussion_options;
		$dependence = false;
		if(isset($args["dependence"]))
			$dependence = true;
		$dependence_hide_on_yes = "";
		if(isset($args["dependence_hide_on_yes"]))
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		$dependence_show_on_yes = "";
		if(isset($args["dependence_show_on_yes"]))
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		?>

		<div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->



			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<p class="field switch">
								<label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
									   class="cb-enable<?php if (discussion_option_get_value($name) == "attachment") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('Yes', 'discussionwp') ?></span></label>
								<label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
									   class="cb-disable<?php if (discussion_option_get_value($name) == "") { echo " selected"; } ?><?php if ($dependence) { echo " dependence"; } ?>"><span><?php esc_html_e('No', 'discussionwp') ?></span></label>
								<input type="checkbox" id="checkbox" class="checkbox"
									   name="<?php echo esc_attr($name); ?>_flagmedia" value="attachment"<?php if (discussion_option_get_value($name) == "attachment") { echo " selected"; } ?>/>
								<input type="hidden" class="checkboxhidden_flagmedia" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}
}

class DiscussionFieldRange extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		$range_min = 0;
		$range_max = 1;
		$range_step = 0.01;
		$range_decimals = 2;
		if(isset($args["range_min"]))
			$range_min = $args["range_min"];
		if(isset($args["range_max"]))
			$range_max = $args["range_max"];
		if(isset($args["range_step"]))
			$range_step = $args["range_step"];
		if(isset($args["range_decimals"]))
			$range_decimals = $args["range_decimals"];
		?>

		<div class="mkd-page-form-section">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($label); ?></h4>

				<p><?php echo esc_html($description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->

			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="mkd-slider-range-wrapper">
								<div class="form-inline">
									<input type="text"
										   class="form-control mkd-form-element mkd-form-element-xsmall pull-left mkd-slider-range-value"
										   name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>

									<div class="mkd-slider-range small"
										 data-step="<?php echo esc_attr($range_step); ?>" data-min="<?php echo esc_attr($range_min); ?>" data-max="<?php echo esc_attr($range_max); ?>" data-decimals="<?php echo esc_attr($range_decimals); ?>" data-start="<?php echo esc_attr(discussion_option_get_value($name)); ?>"></div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php

	}

}

class DiscussionFieldRangeSimple extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
		?>

		<div class="col-lg-3" id="mkd_<?php echo esc_attr($name); ?>"<?php if ($hidden) { ?> style="display: none"<?php } ?>>
			<div class="mkd-slider-range-wrapper">
				<div class="form-inline">
					<em class="mkd-field-description"><?php echo esc_html($label); ?></em>
					<input type="text"
						   class="form-control mkd-form-element mkd-form-element-xxsmall pull-left mkd-slider-range-value"
						   name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(discussion_option_get_value($name)); ?>"/>

					<div class="mkd-slider-range xsmall"
						 data-step="0.01" data-max="1" data-start="<?php echo esc_attr(discussion_option_get_value($name)); ?>"></div>
				</div>

			</div>
		</div>
	<?php

	}

}

class DiscussionFieldRadio extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {

		$checked = "";
		if ($default_value == $value)
			$checked = "checked";
		$html = '<input type="radio" name="'.$name.'" value="'.$default_value.'" '.$checked.' /> '.$label.'<br />';
		echo wp_kses($html, array(
			'input' => array(
				'type' => true,
				'name' => true,
				'value' => true,
				'checked' => true
			),
			'br' => true
		));

	}

}

class DiscussionFieldRadioGroup extends DiscussionFieldType {

    public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {
        $dependence = isset($args["dependence"]) && $args["dependence"] ? true : false;
        $show = !empty($args["show"]) ? $args["show"] : array();
        $hide = !empty($args["hide"]) ? $args["hide"] : array();

        $use_images = isset($args["use_images"]) && $args["use_images"] ? true : false;
        $hide_labels = isset($args["hide_labels"]) && $args["hide_labels"] ? true : false;
        $hide_radios = $use_images ? 'display: none' : '';
        $checked_value = discussion_option_get_value($name);
        ?>

        <div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>" <?php if ($hidden) { ?> style="display: none"<?php } ?>>

            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(is_array($options) && count($options)) { ?>
                                <div class="mkd-radio-group-holder <?php if($use_images) echo "with-images"; ?>">
                                    <?php foreach($options as $key => $atts) {
                                        $selected = false;
                                        if($checked_value == $key) {
                                            $selected = true;
                                        }

                                        $show_val = "";
                                        $hide_val = "";
                                        if($dependence) {
                                            if(array_key_exists($key, $show)) {
                                                $show_val = $show[$key];
                                            }

                                            if(array_key_exists($key, $hide)) {
                                                $hide_val = $hide[$key];
                                            }
                                        }
                                    ?>
                                        <label class="radio-inline">
                                            <input
                                                <?php echo discussion_get_inline_attr($show_val, 'data-show'); ?>
                                                <?php echo discussion_get_inline_attr($hide_val, 'data-hide'); ?>
                                                <?php if($selected) echo "checked"; ?> <?php discussion_inline_style($hide_radios); ?>
                                                type="radio"
                                                name="<?php echo esc_attr($name);  ?>"
                                                value="<?php echo esc_attr($key); ?>"
                                                <?php if($dependence) discussion_class_attribute("dependence"); ?>> <?php if(!empty($atts["label"]) && !$hide_labels) echo esc_attr($atts["label"]); ?>

                                            <?php if($use_images) { ?>
                                                <img title="<?php if(!empty($atts["label"])) echo esc_attr($atts["label"]); ?>" src="<?php echo esc_url($atts['image']); ?>" alt="<?php echo esc_attr("$key image") ?>"/>
                                            <?php } ?>
                                        </label>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php
    }

}

class DiscussionFieldCheckBox extends DiscussionFieldType {

	public function render( $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {

		$checked = "";
		if ($default_value == $value)
			$checked = "checked";
		$html = '<input type="checkbox" name="'.$name.'" value="'.$default_value.'" '.$checked.' /> '.$label.'<br />';
		echo wp_kses($html, array(
			'input' => array(
				'type' => true,
				'name' => true,
				'value' => true,
				'checked' => true
			),
			'br' => true
		));
	}
}

class DiscussionFieldFactory {

	public function render( $field_type, $name, $label="", $description="", $options = array(), $args = array(), $hidden = false ) {


		switch ( strtolower( $field_type ) ) {

			case 'text':
				$field = new DiscussionFieldText();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'textsimple':
				$field = new DiscussionFieldTextSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'textarea':
				$field = new DiscussionFieldTextArea();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'textareasimple':
				$field = new DiscussionFieldTextAreaSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'color':
				$field = new DiscussionFieldColor();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'colorsimple':
				$field = new DiscussionFieldColorSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'image':
				$field = new DiscussionFieldImage();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

            case 'imagesimple':
				$field = new DiscussionFieldImageSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'font':
				$field = new DiscussionFieldFont();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'fontsimple':
				$field = new DiscussionFieldFontSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'select':
				$field = new DiscussionFieldSelect();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'selectblank':
				$field = new DiscussionFieldSelectBlank();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'selectsimple':
				$field = new DiscussionFieldSelectSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'selectblanksimple':
				$field = new DiscussionFieldSelectBlankSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'yesno':
				$field = new DiscussionFieldYesNo();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'yesnosimple':
				$field = new DiscussionFieldYesNoSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'onoff':
				$field = new DiscussionFieldOnOff();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'zeroone':
				$field = new DiscussionFieldZeroOne();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'imagevideo':
				$field = new DiscussionFieldImageVideo();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'yesempty':
				$field = new DiscussionFieldYesEmpty();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'flagpost':
				$field = new DiscussionFieldFlagPost();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'flagpage':
				$field = new DiscussionFieldFlagPage();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'flagmedia':
				$field = new DiscussionFieldFlagMedia();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'range':
				$field = new DiscussionFieldRange();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'rangesimple':
				$field = new DiscussionFieldRangeSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'radio':
				$field = new DiscussionFieldRadio();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'checkbox':
				$field = new DiscussionFieldCheckBox();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'date':
				$field = new DiscussionFieldDate();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
            case 'radiogroup':
                $field = new DiscussionFieldRadioGroup();
                $field->render( $name, $label, $description, $options, $args, $hidden );
                break;
			default:
				break;

		}

	}

}

/*
   Class: DiscussionMultipleImages
   A class that initializes Mikado Multiple Images
*/
class DiscussionMultipleImages implements iDiscussionRender {
	private $name;
	private $label;
	private $description;


	function __construct($name,$label="",$description="") {
		global $discussion_Framework;
		$this->name = $name;
		$this->label = $label;
		$this->description = $description;
		$discussion_Framework->mkdMetaBoxes->addOption($this->name,"");
	}

	public function render($factory) {
		global $post;
		?>

		<div class="mkd-page-form-section">


			<div class="mkd-field-desc">
				<h4><?php echo esc_html($this->label); ?></h4>

				<p><?php echo esc_html($this->description); ?></p>
			</div>
			<!-- close div.mkd-field-desc -->

			<div class="mkd-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<ul class="mkd-gallery-images-holder clearfix">
								<?php
								$image_gallery_val = get_post_meta( $post->ID, $this->name , true );
								if($image_gallery_val!='' ) $image_gallery_array=explode(',',$image_gallery_val);

								if(isset($image_gallery_array) && count($image_gallery_array)!=0):

									foreach($image_gallery_array as $gimg_id):

										$gimage_wp = wp_get_attachment_image_src($gimg_id,'thumbnail', true);
										echo '<li class="mkd-gallery-image-holder"><img src="'.esc_url($gimage_wp[0]).'"/></li>';

									endforeach;

								endif;
								?>
							</ul>
							<input type="hidden" value="<?php echo esc_attr($image_gallery_val); ?>" id="<?php echo esc_attr( $this->name) ?>" name="<?php echo esc_attr( $this->name) ?>">
							<div class="mkd-gallery-uploader">
								<a class="mkd-gallery-upload-btn btn btn-sm btn-primary"
								   href="javascript:void(0)"><?php esc_html_e('Upload', 'discussionwp'); ?></a>
								<a class="mkd-gallery-clear-btn btn btn-sm btn-default pull-right"
								   href="javascript:void(0)"><?php esc_html_e('Remove All', 'discussionwp'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- close div.mkd-section-content -->

		</div>
	<?php
	}
}

class DiscussionTwitterFramework implements  iDiscussionRender {
    public function render($factory) {
        $twitterApi = MikadoTwitterApi::getInstance();
        $message = '';

        if(!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier'])) {
            if(!empty($_GET['oauth_token'])) {
                update_option($twitterApi::AUTHORIZE_TOKEN_FIELD, $_GET['oauth_token']);
            }

            if(!empty($_GET['oauth_verifier'])) {
                update_option($twitterApi::AUTHORIZE_VERIFIER_FIELD, $_GET['oauth_verifier']);
            }

            $responseObj = $twitterApi->obtainAccessToken();
            if($responseObj->status) {
                $message = esc_html__('You have successfully connected with your Twitter account. If you have any issues fetching data from Twitter try reconnecting.');
            } else {
                $message = $responseObj->message;
            }
        }

        $buttonText = $twitterApi->hasUserConnected() ? esc_html__('Re-connect with Twitter', 'discussionwp') : esc_html__('Connect with Twitter', 'discussionwp');
    ?>
        <?php if($message !== '') { ?>
            <div class="alert alert-success" style="margin-top: 20px;">
                <span><?php echo esc_html($message); ?></span>
            </div>
        <?php } ?>
        <div class="mkd-page-form-section" id="mkd_enable_social_share">

            <div class="mkd-field-desc">
                <h4><?php esc_html_e('Connect with Twitter', 'discussionwp'); ?></h4>

                <p><?php esc_html_e('Connecting with Twitter will enable you to show your latest tweets on your site'); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <a id="mkd-tw-request-token-btn" class="btn btn-primary" href="#"><?php echo esc_html($buttonText); ?></a>
                            <input type="hidden" data-name="current-page-url" value="<?php echo esc_url($twitterApi->buildCurrentPageURI()); ?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php }
}

class DiscussionInstagramFramework implements iDiscussionRender {
    public function render($factory) {
        $message = '';
        $instagram_api = MikadoInstagramApi::getInstance();

        //if code wasn't saved to database
		if(!get_option('mkd_instagram_code')) {
			//check if code parameter is set in URL. That means that user has connected with Instagram
			if(!empty($_GET['code'])) {
				//update code option so we can use it later
				$instagram_api->storeCode();
				$instagram_api->getAccessToken();
				$message = esc_html__('You have successfully connected with your Instagram account. If you have any issues fetching data from Instagram try reconnecting.', 'discussionwp');
				
			} else {
				$instagram_api->storeCodeRequestURI();
			}
		}

		$buttonText = $instagram_api->hasUserConnected() ? esc_html__('Re-connect with Instagram', 'discussionwp') : esc_html__('Connect with Instagram', 'discussionwp');

    ?>
        <?php if($message !== '') { ?>
            <div class="alert alert-success" style="margin-top: 20px;">
                <span><?php echo esc_html($message); ?></span>
            </div>
        <?php } ?>
        <div class="mkd-page-form-section" id="mkd_enable_social_share">

            <div class="mkd-field-desc">
                <h4><?php esc_html_e('Connect with Instagram', 'discussionwp'); ?></h4>

                <p><?php esc_html_e('Connecting with Instagram will enable you to show your latest photos on your site', 'discussionwp'); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="<?php echo esc_url($instagram_api->getAuthorizeUrl()); ?>"><?php echo esc_html($buttonText); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php }
}