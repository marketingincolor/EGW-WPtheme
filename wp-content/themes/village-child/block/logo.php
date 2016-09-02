<?php do_action('discussion_before_site_logo');?>

<div class="mkd-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php discussion_inline_style($logo_styles); ?>>
        <img class="mkd-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo','discussionwp'); ?>"/>
        <?php if(!empty($logo_image_dark)){ ?><img class="mkd-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="<?php esc_html_e('dark logo','discussionwp'); ?>"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img class="mkd-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="<?php esc_html_e('light logo','discussionwp'); ?>"/><?php } ?>
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

<?php do_action('discussion_after_site_logo'); ?>