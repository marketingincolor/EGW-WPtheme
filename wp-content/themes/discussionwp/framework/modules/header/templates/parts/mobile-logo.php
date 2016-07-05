<?php do_action('discussion_before_mobile_logo'); ?>

<div class="mkd-mobile-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php discussion_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('mobile-logo','discussionwp'); ?>"/>
    </a>
</div>
<?php
global $blog_id;
if ($blog_id != 1) {
   $current_site = get_current_site();?>
   <div class="sub-site-logo">
    <a href=""><h2><?php echo get_bloginfo('name'); ?></h2></a>
</div>
<?php
} 
?>
<?php do_action('discussion_after_mobile_logo'); ?>