<?php
    /*
    Template Name: Blog: Standard Whole Post
    */
?>
<?php get_header(); ?>
<?php discussion_get_title(); ?>
<?php get_template_part('slider'); ?>
    <div class="mkd-container">
        <?php do_action('discussion_after_container_open'); ?>
        <div class="mkd-container-inner">
            <?php discussion_get_blog('standard-whole-post'); ?>
        </div>
        <?php do_action('discussion_before_container_close'); ?>
    </div>
<?php get_footer(); ?>