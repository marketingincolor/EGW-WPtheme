<?php
/**
 * Author - Akilan
 * Date - 24-06-2016
 * Purpose - For loading article based on jquery scroll loading
 */
?>
<script type="text/javascript">
<?php
$cat_name = "";
$cat_id = "";
/**
 * cat_id_ar => For fetching follow category based post
 * cat_id => if category id array empty we will follow with category id
 */
if (isset($cat_id_ar) || !empty($cat_id_ar))
    $cat_id = implode(",", $cat_id_ar);
if (isset($category) && $cat_id == "")
    $cat_id = get_cat_ID($category);
if (isset($category_id))
    $cat_id = $category_id;
?>
    jQuery(document).ready(function() {
        /**
         * Mkd ratings holder => For placing loading image
         * currentloop=> For current attempt of looping based on offset
         * adv_row => advertising id
         * processing => 0 -> scrolling in process ,1=>scrolling not in processs
         * current post => uploaded loaded post
         */
        load_more_display = 18;
        jQuery(window).scroll(function() {
            total_post = parseInt(jQuery('#total_post').val());
            current_post_total = parseInt(jQuery('#current_post').val());
            if (jQuery(window).scrollTop() + jQuery(window).height() > jQuery('.mkd-footer-inner').offset().top)
            {
                post_per_section = parseInt('<?php echo $post_per_section ?>');
                if (total_post > post_per_section && total_post > current_post_total && jQuery('#processing').val() == '0') {
                    jQuery('#processing').val(1);
                    jQuery('.loader_img').show();
                    load_post();
                }
            }
        });

    });
    /**
    * For triggering post load based on clicking show more

     * @returns {undefined}     */
    jQuery('#showmore').on("click", function() {
        jQuery('#loading').show();
        jQuery('#showmore').hide();
        load_post();
    })

    /**
    * Showing load more between each 18 posts when show more display we hide scroll process

     * @returns {undefined}     */
    function load_post() {
        jQuery('#processing').val(1);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php",
//                        async: false,
            data: {
                action: 'custom_scroll_post_load',
                offset: parseInt(jQuery('#current_post').val()),
                cat_id: '<?php echo $cat_id; ?>',
                post_type: '<?php echo $post_type; ?>',
                perpage: post_per_section,
            },
            success: function(data)
            {
                jQuery('.loader_img').hide();
                Current_loop = jQuery('#currentloop').val();
                active_loop = parseInt(Current_loop) + parseInt(1);
                jQuery('#currentloop').val(active_loop)
                jQuery('#adv_row_' + active_loop).show();
                jQuery(data).insertAfter('#adv_row_' + Current_loop);
                current_total = parseInt(jQuery('#current_post').val()) + post_per_section;
                if ((current_total % load_more_display === 0) && total_post > current_total) {
                    jQuery('#showmore').show();
                } else {
                    jQuery('#loading').hide();
                    jQuery('#processing').val(0);
                }
                jQuery('#current_post').val(current_total);
            }

        });
    }
</script>
<?php ?>