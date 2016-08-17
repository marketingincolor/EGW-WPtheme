<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * @see discussion_header_meta() - hooked with 10
     * @see mkd_user_scalable - hooked with 10
     */
    ?>
	<?php do_action('discussion_header_meta'); ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<?php discussion_get_side_area(); ?>
<div class="mkd-wrapper">
    <div class="mkd-wrapper-inner">
        <?php discussion_get_header(); ?>

        <?php if(discussion_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='mkd-back-to-top'  href='#'>
                <span class="mkd-icon-stack">
                     <?php
                        discussion_icon_collections()->getBackToTopIcon('font_elegant');
                    ?>
                </span>
                <span class="mkd-icon-stack-flip">
                     <?php
                        discussion_icon_collections()->getBackToTopIcon('font_elegant');
                    ?>
                </span>
            </a>
        <?php } ?>

        <div class="mkd-content" <?php discussion_content_elem_style_attr(); ?>>
            <div class="mkd-content-inner">
            	<?php discussion_get_content_top();?>