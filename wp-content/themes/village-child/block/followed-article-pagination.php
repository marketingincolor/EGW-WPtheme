<?php
/**
 * Author - Akilan
 * Date - 24-06-2016
 * Purpose - For loading article based on jquery scroll loading in home page based on follow/unfollowed categories article
 */
?>
<script type="text/javascript">  
<?php
$cat_name = "";
$cat_id = "";

if (isset($cat_id_ar) || !empty($cat_id_ar))
    $cat_id = implode(",", $cat_id_ar);
if (!isset($display_postid_ar))
    $display_postid_ar = array();
if (!isset($subcat_id_ar))
    $subcat_id_ar = array();
if(!isset($displayed_sub_cat_ar))
    $displayed_sub_cat_ar=array();
?>
    jQuery(document).ready(function() {
        /**
         * Mkd ratings holder => For placing loading image
         * currentloop=> For current attempt of looping based on offset
         * adv_row => advertising id
         * processing => 0 -> scrolling in process ,1=>scrolling not in processs
         * current post => uploaded loaded post
         * total followed and unfollowed article based seperate pagination and its continuation
         */
        load_more_display = 18;
        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
        jQuery(window).scroll(function() {

            if (jQuery(window).scrollTop() + jQuery(window).height() > jQuery('.mkd-footer-inner').offset().top)
            {                
                post_per_section = parseInt('<?php echo $post_per_section ?>');
                total_followed_post = parseInt(jQuery('#total_followed_post').val());
                total_unfollowed_post = parseInt(jQuery('#total_unfollowed_post').val());
                followed_current_post = parseInt(jQuery('#followed_current_post').val());
                unfollowed_current_post = parseInt(jQuery('#unfollowed_current_post').val());
                total_post = parseInt(jQuery('#total_post').val());
                current_post_total = parseInt(jQuery('#current_post').val());
                remaining_followed_post = total_followed_post - followed_current_post;
                if ((total_followed_post > followed_current_post || total_unfollowed_post > unfollowed_current_post) && jQuery('#processing').val() == '0') {
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
        total_post = parseInt(jQuery('#total_post').val());
        post_per_section = parseInt('<?php echo $post_per_section ?>');
        total_followed_post = parseInt(jQuery('#total_followed_post').val());
        total_unfollowed_post = parseInt(jQuery('#total_unfollowed_post').val());
        followed_current_post = parseInt(jQuery('#followed_current_post').val());
        unfollowed_current_post = parseInt(jQuery('#unfollowed_current_post').val());
        total_post = parseInt(jQuery('#total_post').val());
        current_post_total = parseInt(jQuery('#current_post').val());
        remaining_followed_post = total_followed_post - followed_current_post;
        remaining_unfollowed_post ="";
        query_type1 = "";
        query_type2 = "";
        per_page2="";
        if (total_followed_post > followed_current_post) {
            query_type1 = 'followed';
        }
        if (total_unfollowed_post > unfollowed_current_post && remaining_followed_post < post_per_section) {           
            query_type2 = 'unfollowed';
            if(remaining_followed_post < post_per_section && total_followed_post>followed_current_post){
                per_page2=post_per_section-remaining_followed_post;
            }else {
                per_page2=post_per_section;
            }
       
        }
        jQuery.ajax({
            type: "POST",
            url: "<?php echo bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php",
            data: {
                action: 'follow_category_scroll',
                offset: parseInt(jQuery('#current_post').val()),
                cat_id: '<?php echo $cat_id; ?>',
                post_type: '<?php if (!empty($post_type)): echo implode(",", $post_type);endif; ?>',              
                display_postid_ar: '<?php if (!empty($display_postid_ar)): echo implode(",", $display_postid_ar); endif; ?>',
                displayed_sub_cat_ar: '<?php if (!empty($displayed_sub_cat_ar)): echo implode(",", $displayed_sub_cat_ar); endif; ?>',
                sub_catid_ar: '<?php if (!empty($subcat_id_ar)): echo implode(",", $subcat_id_ar);endif; ?>',
                query_type1:query_type1,
                query_type2:query_type2,
                offset1:parseInt(jQuery('#followed_current_post').val()),
                offset2:parseInt(jQuery('#unfollowed_current_post').val()),
                per_page1:post_per_section,
                per_page2:per_page2    
            },
            success: function(data)
            {
                jQuery('.loader_img').hide();
                Current_loop = jQuery('#currentloop').val();
                active_loop = parseInt(Current_loop) + parseInt(1);
                jQuery('#currentloop').val(active_loop)
                jQuery('#mob_adv_row_' + active_loop).show();
                jQuery(data).insertAfter('#mob_adv_row_' + Current_loop);
                current_total = parseInt(parseInt(jQuery('#current_post').val()) + post_per_section);
                if(query_type1==='followed'){
                    follow_current_total=parseInt(parseInt(jQuery('#followed_current_post').val()) + post_per_section);
                    jQuery('#followed_current_post').val(follow_current_total)
                }
                
                if(query_type2==='unfollowed'){
                    unfollow_current_total=parseInt(parseInt(jQuery('#unfollowed_current_post').val()) + per_page2);
                    jQuery('#unfollowed_current_post').val(unfollow_current_total)
                }
                    
                if (((current_total+6) % load_more_display === 0) && (total_post > current_total+6)) {
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