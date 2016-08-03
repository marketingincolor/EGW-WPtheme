<?php
/**
 * Template Name: Child About Us
 *
 * 
 */
get_header();?>
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
                    <div class="fspgreen_btn">
                        <input type="submit" name="fspr_contact_submit" value="Contact Us" onclick="location.href='<?php echo get_option("siteurl").'/contact-us' ?>'"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php
get_footer();
?>