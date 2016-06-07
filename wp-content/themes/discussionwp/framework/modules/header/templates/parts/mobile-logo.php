<?php do_action('discussion_before_mobile_logo'); ?>

<div class="mkd-mobile-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php discussion_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('mobile-logo','discussionwp'); ?>"/>
    </a>
</div>

<?php do_action('discussion_after_mobile_logo'); ?>