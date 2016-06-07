<?php if($show_header_top) : ?>

<?php do_action('discussion_before_header_top'); ?>

<div class="mkd-top-bar">
    <?php if($top_bar_in_grid) : ?>
    <div class="mkd-grid">
    <?php endif; ?>
		<?php do_action( 'discussion_after_header_top_html_open' ); ?>
        <div class="mkd-vertical-align-containers mkd-<?php echo esc_attr($column_widths); ?>">
           
            <div class="mkd-position-fullright">
               
                    <?php if(is_active_sidebar('mkd-top-bar-right')) : ?>
                        <?php dynamic_sidebar('mkd-top-bar-right'); ?>
                    <?php endif; ?>
               
            </div>
        </div>
    <?php if($top_bar_in_grid) : ?>
    </div>
    <?php endif; ?>
</div>

<?php do_action('discussion_after_header_top'); ?>

<?php endif; ?>