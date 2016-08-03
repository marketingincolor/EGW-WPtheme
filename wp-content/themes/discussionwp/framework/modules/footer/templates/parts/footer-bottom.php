<div class="mkd-footer-bottom-holder">
	<div class="mkd-footer-bottom-holder-inner <?php echo esc_attr($footer_bottom_classes) ?>">
		<?php if($footer_in_grid) { ?>
			<div class="mkd-container">
				<div class="mkd-container-inner">

		<?php }

		switch ($footer_bottom_columns) {
			case 3:
				discussion_get_footer_bottom_sidebar_three_columns();
				break;
			case 2:
				discussion_get_footer_bottom_sidebar_two_columns();
				break;
			case 1:
				discussion_get_footer_bottom_sidebar_one_column();
				break;
		}
		if($footer_in_grid){ ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>