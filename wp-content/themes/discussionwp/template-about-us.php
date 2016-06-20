<?php
/**
 * Template Name: about_us
 *
 * 
 */
get_header();?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <div class="mkd-container">
            <div class="mkd-container-inner clearfix">
                        <?php
                        the_content();
                        ?>
                        <div class="fspgreen_btn">
                        <input type="submit" name="fspr_contact_submit" value="Contact Us">
                        </div>
            </div>
        </div>
    </div>
</div> 
<?php
get_footer();
?>