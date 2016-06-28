<?php
/**
 * Template Name: Activity page
 *
 * For displaying featured article and home category blogs
 */
?>

<?php
get_header();
$category = 'activity';
?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner">               
                <?php
                get_template_part('template-page-featured-content');
                ?>
                <!-- Category follow functionality Start-->

                <script type = "text/javascript">
                    jQuery(function () {
                        jQuery(".comment_button").click(function () {
                            var dataString = jQuery('form').serialize();
                            alert(dataString);
                            jQuery.ajax({
                                type: "POST",
                                url: "wp-content/themes/discussionwp/followajax.php",
                                data: jQuery('form').serialize(),
                                cache: false,
                                success: function (successvalue) {
                                    
                                    obj = JSON.parse(successvalue);
                                    alert(obj.msg);
                                    jQuery(".comment_button").html(obj.label);
                                    jQuery("#flagvalue").val(obj.setflag);
                                }
                            });
                            return false;
                        });
                    });
                </script>
                <div id="followContainer">
                    <form method="post" name="form" action="">
                        <?php
                        $categoryid = get_cat_ID($category);
                        $userid = get_current_user_id();
                        //echo $categoryid =  $wp_query->get_queried_object();
                        //echo "SELECT *from wp_follow_category where userid=" . $userid . " and categoryid=" . $categoryid . "";
                        $fetchresult = $wpdb->get_results("SELECT *from wp_follow_category where userid=" . $userid . " and categoryid=" . $categoryid . "");
                        $rowresult = $wpdb->num_rows;
                        foreach ($fetchresult as $results) {
                            $currentFlag = $results->flag;
                        }
                        if ($rowresult > 0) {
                            $processDo = "update";
                            if ($currentFlag == 0) {
                                $setValue = 1;
                                $label = "Follow";
                            } else {
                                $setValue = 0;
                                $label = "unfollow";
                            }
                        } else {
                            $label = "Follow";
                            $processDo = "insert";
                            $setValue = 1;
                        }
                        ?>
                        <button type="button" value="<?php echo $label; ?>" name="follow" class="comment_button"><?php echo $label; ?></button>
                        <input type="text" name="updateflag" id="flagvalue" value="<?php echo $setValue; ?>">
                        <input type="hidden" name="submit" value="<?php echo $processDo; ?>">
                        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                        <input type="hidden" name="categoryid" value="<?php echo $categoryid; ?>">
                    </form>
                </div>
                <!-- Category follow functionality end -->
                
                
                <div style="" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left mkd-grid-section">
                    <div class="mkd-container-inner clearfix">
                        <div class="mkd-section-inner-margin clearfix">
<?php
$my_query = null;
$my_query = discussion_custom_category_query('post', $category);
global $wp_query;
get_template_part('template-blog-block');
?>      
                        </div>
                    </div>
                </div><!-- #content -->
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>

