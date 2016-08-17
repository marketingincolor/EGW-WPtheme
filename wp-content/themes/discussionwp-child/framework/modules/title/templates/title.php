<?php do_action('discussion_before_page_title'); ?>
<?php if($show_title_area) { ?>
<div class="mkd-grid">
    <div class="mkd-title mkd-breadcrumbs-type <?php echo discussion_title_classes(); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <div class="mkd-title-image"><?php if($title_background_image_src != ""){ ?><img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;" /> <?php } ?></div>
        <div class="mkd-title-holder" <?php discussion_inline_style($title_holder_height); ?>>
            <div class="mkd-container clearfix">
                <div class="mkd-container-inner">
                    <div class="mkd-title-breadcrumb-holder" style="<?php echo esc_attr($title_subtitle_holder_padding);?>">
                        <?php discussion_custom_breadcrumbs(); ?>
                        <?php if($show_title_text){ ?>
                            <h1 class="mkd-title-text" <?php discussion_inline_style($title_color);?>><?php discussion_title_text(); ?></h1>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php do_action('discussion_after_page_title'); ?>