<?php do_action('discussion_before_sticky_header'); ?>

	<div class="mkd-sticky-header">
		<?php do_action( 'discussion_after_sticky_menu_html_open' ); ?>
		<div class="mkd-sticky-holder">
			<div class="mkd-grid">
				<div class=" mkd-vertical-align-containers">
					<div class="mkd-position-left">
						<div class="mkd-position-left-inner">
							<?php if(!$hide_logo) {
								discussion_get_logo('sticky');
							} ?>
                            <?php discussion_get_sticky_main_menu('mkd-sticky-nav'); ?>
						</div>
					</div>
					<div class="mkd-position-right">
						<div class="mkd-position-right-inner">
							<?php if(is_active_sidebar('mkd-sticky-right')) : ?>
								<?php dynamic_sidebar('mkd-sticky-right'); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php do_action('discussion_after_sticky_header'); ?>