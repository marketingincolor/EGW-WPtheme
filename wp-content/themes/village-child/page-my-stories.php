<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Template Name: My Stories
 *
 * Selectable from a dropdown menu on the edit page screen.
 */
?>
<?php
get_header();

list($post_per_section, $post_type) = scroll_loadpost_settings();
$category = 'feature-home';
$my_query = null;
$subcat_id_ar = array();
$cat_id_ar = get_main_category_detail();
$total_subcat_posts = 0;
$merged_new_ar = array();
/* for showing post type feeds with feature category as home banner image */
?>
<div class="mkd-content">
    <div class="mkd-content-inner"> 
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner">               
                <?php get_template_part('block/home-page-banner'); ?>
                <!-- Articles display block --->

                <div class="mkd-container">
                    <div class="mkd-container-inner clearfix">
                        <?php get_template_part('block/follow-and-unfollow-pack'); ?>
                        <div class="mkd-two-columns-75-25  mkd-content-has-sidebar clearfix">
                            <div class="mkd-column1 mkd-content-left-from-sidebar">
                                <div class="mkd-column-inner">
                                    <?php
                                    /**
                                     * Fetching category if user follows subcategory and displaying article based on that categories
                                     */
                                    if (is_user_logged_in()) {
                                        $userid = get_current_user_id();
                                        $fetchresult = $wpdb->get_results("SELECT categoryid FROM wp_follow_category where userid=" . $userid . " AND flag=1 ORDER BY date DESC");
                                        //print_r($fetchresult);
                                        if (!empty($fetchresult)) {
                                            foreach ($fetchresult as $results) {
                                                $subcat_id_ar[$results->categoryid] = $results->categoryid;
                                            }
                                            if (!empty($subcat_id_ar)) {
                                                $total_followed_posts = count(get_posts(array('post_type' => $post_type, 'category' => $subcat_id_ar, 'nopaging' => true)));
                                                //print_r($total_followed_posts);
                                                $total_unfollowed_posts = 0;
                                                include(locate_template('block/followed-article-list.php'));
                                            }
                                        } else {
                                            //$my_query = discussion_custom_categorylist_query($post_type, $cat_id_ar, $post_per_section);
                                        }
                                    }
                                    ?>      
                                </div>
                            </div>		
                            <div class="mkd-column2">
                                <div class="mkd-column-inner">
                                    <div class="vc_empty_space" style="height: 40px"><span class="vc_empty_space_inner"></span></div>
                                    <aside class="mkd-sidebar" style="transform: translateY(0px);">
                                        <div class="widget widget_apsc_widget">   
                                            <?php get_template_part('sidebar/template-sidebar-savedarticles'); ?>
                                        </div>    
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- For post pagintation maintain -->
<?php //include(locate_template('block/ajax-pagination.php')); ?>
<?php get_footer(); ?>
<script>

    function load_saved_articles(event) {

        var displayed_article_count = parseInt(jQuery('#displayed_article_count').text());
        var total_article_count = parseInt(jQuery('#total_saved_article_count').text());
        jQuery('#load-save-article-button').css('display', 'none');
        jQuery('.loader_img').css('display', 'block');
        jQuery.ajax({
            type: "POST",
            url: "<?php echo bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php",
            data: {
                action: 'custom_scroll_saved_articles_load',
                offset: displayed_article_count,
            },
            success: function (data)
            {
                if (jQuery('#story-send').css('display') === 'black') {
                    jQuery('.save-article-checkbox').css('display', 'black');
                }
                jQuery(data).insertAfter('.sv-art-inside-container:last');
                current_displayed_article_count = displayed_article_count + 3;
                jQuery('#displayed_article_count').text(current_displayed_article_count);
                jQuery('.loader_img').css('display', 'none');
                if (current_displayed_article_count >= total_article_count) {
                    jQuery('.load-save-article-button-section').css('display', 'none');
                } else {
                    jQuery('.load-save-article-button-section').css('display', 'block');
                }
            }
        });
        if (jQuery('#story-send').css("display") == "block") {
            setTimeout(function () {
                jQuery('.save-article-checkbox').css('display', 'block');
            }, 1200);
        }
        event.preventDefault();
    }
    jQuery(document).ready(function () {
        jQuery('#enable_story_playlist').click(function () {
            jQuery('#story-send').css('display', 'block');
            jQuery('.save-article-checkbox').css('display', 'block');
        });
    });
</script>
<script type = "text/javascript">
    jQuery(function () {
        //unchecked all checkbox in page load;
        jQuery('input[type=checkbox]').each(function ()
        {
            this.checked = false;
        });
        //jQuery("#subcatslectbox option:first").attr("selected", true);
        jQuery('#subcatslectbox').val( jQuery('#subcatslectbox').prop('defaultSelected') );
        jQuery("#subcatslectbox").css("box-shadow", "none");
        jQuery(".comment_button").unbind('click').click(function () {
            var datasubcatslectbox = jQuery('#subcatslectbox').val();
            var dataString = jQuery('#followsubcat').serialize();
            if (datasubcatslectbox != "") {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo get_stylesheet_directory_uri(); ?>/followajax.php",
                    data: dataString,
                    cache: false,
                    success: function (successvalue) {
                        if (jQuery('#followedSubcat').html(successvalue)) {
                            document.getElementById("selectbox-msg").innerHTML = '<div class="follow-vad-tick"><i class="fa fa-check" aria-hidden="true"></i>You have subscribed successfully</div>';
                        }
                        jQuery('select').children('option[value="' + datasubcatslectbox + '"]').attr('disabled', true);
                        location.reload();
                    }
                });
                return false;
            } else {
                document.getElementById("selectbox-msg").innerHTML = '<div class="follow-vad-cross"><i class="fa fa-times" aria-hidden="true"></i> Please select sub category</div>';
                return false;
            }

        });

        //Delete ajax
        jQuery("#unfollow_button").unbind('click').click(function () {
            var dataString = jQuery('#unfollowsubcat').serialize();

            var values = jQuery('input:checkbox:checked.followedsubcates').map(function () {
                return this.value;
            }).get(); // ["18", "55", "10"]
            if (values.length == 0) {
                document.getElementById("unfollowed-msg").innerHTML = '<div class="follow-vad-cross"><i class="fa fa-times" aria-hidden="true"></i> You must check at least one box!</div>';
                return false; // The form will *not* submit
            } else {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo get_stylesheet_directory_uri(); ?>/followajax.php",
                    data: dataString,
                    cache: false,
                    success: function (deletedvalue) {
                        if (jQuery('#followedSubcat').html(deletedvalue)) {
                            document.getElementById("unfollowed-msg").innerHTML = '<div class="follow-vad-tick"><i class="fa fa-check" aria-hidden="true"></i> You have unfollowed successfully</div>';
                            location.reload();
                        }
                    }
                });
                return false;
            }
        });


    });

</script>

