<button type="submit" <?php discussion_inline_style($button_styles); ?> <?php discussion_class_attribute($button_classes); ?> <?php echo discussion_get_inline_attrs($button_data); ?> <?php echo discussion_get_inline_attrs($button_custom_attrs); ?>>
    <span class="mkd-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo discussion_icon_collections()->renderIcon($icon, $icon_pack, array(
    	'icon_attributes' => array(
    		'class' => 'mkd-btn-icon-element'
		)
    )); ?>
</button>