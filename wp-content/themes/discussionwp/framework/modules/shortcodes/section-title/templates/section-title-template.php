<?php
/**
 * Section Table shortcode template
 */
?>
<span class="mkd-section-title-holder clearfix <?php echo esc_attr($classes);?>">
    <?php if($title !== '') { ?>
        <?php echo '<'.esc_html($title_tag) ?> class="mkd-st-title">
        <?php echo esc_attr($title); ?>
        <?php echo '</'.esc_html($title_tag) ?>>
    <?php } ?>
</span>