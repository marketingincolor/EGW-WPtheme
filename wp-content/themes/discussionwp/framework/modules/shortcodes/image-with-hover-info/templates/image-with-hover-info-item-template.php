<div class="mkd-image-with-hover-info-item">
	<?php foreach ($images as $image) { ?>
		<div class="mkd-inital-image">
			<?php if(is_array($image_size) && count($image_size)) : ?>
				<?php echo discussion_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
			<?php else: ?>
				<?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
			<?php endif; ?>
		</div>
		<div class="mkd-hover-holder">
			<?php if(!empty($link)) : ?>
				<a class="mkd-image-with-hover-link" href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target);?>"></a>
			<?php endif; ?>
			<div class="mkd-hover-holder-inner">
				<div class="mkd-hover-content">
					<div class="mkd-hover-content-inner">
						<?php if($title != '') { ?>
							<h6 class="mkd-image-title"><?php echo esc_attr($title); ?></h6>
						<?php } ?>
						<?php if(!empty($add_text)) { ?>
							<span class="mkd-image-description-add"><?php echo esc_attr($add_text); ?></span>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>