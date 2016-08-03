<?php if($show_content_top == 'yes'  && is_active_sidebar('content_top')) { ?>
	<div class="mkd-content-top-holder" <?php discussion_inline_style($content_top_background_color); ?>>
		<div class="mkd-grid">
			<?php dynamic_sidebar( 'content_top' ); ?>
		</div>
	</div>
<?php } ?>