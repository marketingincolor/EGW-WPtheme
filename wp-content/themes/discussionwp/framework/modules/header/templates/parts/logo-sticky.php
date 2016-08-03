<?php do_action('discussion_before_site_logo'); ?>

<div class="mkd-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php discussion_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo','discussionwp' ); ?>"/>
    </a>
</div>

<?php do_action('discussion_after_site_logo'); ?>