<?php
/**
 * Template Name: aboutus
 *
 * 
 */
get_header();?>
<div class="about-us-container">
    <div class="about-us-content">
        <?php
        the_content();
        ?>
    </div>
    <div class="fspgreen_btn">
        <input type="submit" name="fspr_contact_submit" value="Contact Us">
    </div>
</div>
<?php
get_footer();
?>