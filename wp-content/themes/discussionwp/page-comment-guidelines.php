<?php
/**
 * Template Name: comment guidelines
 *
 * 
 */
get_header();
?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <div class="mkd-container">
            <div class="mkd-container-inner clearfix">
                <div class="about-us-container">
                    <h2><?php the_title(); ?></h2>
                    <div class="about-us-content">
                        <?php
                        the_content();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>