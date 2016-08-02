<?php
/**
 * Author - Akilan
 * Date - 20-06-2016
 * Purpose - For displaying category image as banner
 */
?>

<div id="category_banner" class="vc_row wpb_row vc_row-fluid mkd-section mkd-content-aligment-left">
    <div class="clearfix mkd-full-section-inner">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <div data-max_pages="1" data-paged="1" data-sort="featured_first" data-post_in="205, 215, 218, 225, 232" data-category_id="4" data-number_of_posts="5" data-slider_height="735" data-base="mkd_post_slider_interactive" class="mkd-bnl-holder mkd-psi-holder  mkd-psi-number-5" style="opacity: 1;">
                        <div class="mkd-bnl-outer">
                            <?php
                            if(!isset($category_id))
                            $category_id = get_cat_id(single_cat_title("", false));
                            $cat = get_category($category_id);
                            $parent_category_id = category_top_parent_id($category_id);
                            

                            $args = array(
                                'title_tag' => 'h2',
                                'display_category' => 'no',
                                'display_date' => 'no',
                                'date_format' => 'd. F Y',
                                'display_comments' => 'no',
                                'display_count' => 'no',
                                'display_share' => 'no',
                                'slider_height' => ''
                            );

                            if ($cat):
                                $title_ta = 'h2';
                                $display_category = 'no';
                                $display_date = 'no';
                                $date_format = 'd. F Y';
                                $display_comments = 'no';
                                $display_count = 'no';
                                $display_share = 'yes';
                                $slider_height = '';
                                $params = shortcode_atts($args, $atts);
                                $url = z_taxonomy_image_url($cat->term_id);
                                if ($url != "") {
                                    $image_params = discussion_custom_categoryImageParams($cat->term_id);
                                    $params = array_merge($params, $image_params);
                                }



                                $redirect_url = esc_url(get_permalink());
                                ?>
                                <div class="mkd-psi-slider">      

                                    <div class="mkd-psi-slide" data-image-proportion="<?php echo esc_attr($params['proportion']) ?>" <?php discussion_inline_style($params['background_image']); ?>>
                                        <div class="mkd-psi-content">
                                            <div class="mkd-grid">


                                                <?php
                                                discussion_post_info_category(array(
                                                    'category' => $display_category
                                                ))
                                                ?>
                                                <h2 class="mkd-psi-title">
                                                    <!--                                                        <a itemprop="url" href="javascript:void(0)" target="_self">-->
                                                    <?php echo esc_attr($cat->name) ?>
                                                    <!--                                                        </a>-->
                                                </h2>
                                                <?php
                                                discussion_post_info_date(array(
                                                    'date' => $display_date,
                                                    'date_format' => $date_format
                                                ));
                                                ?>
                                                <?php if ($display_share == 'yes' || $display_comments == 'yes' || $display_count == 'yes') { ?>
                                                    <!--   <div class="mkd-pt-info-section clearfix">
                                                          <div>
                                                    <?php
                                                    discussion_post_info_share(array(
                                                        'share' => $display_share
                                                    ));
                                                    discussion_post_info_comments(array(
                                                        'comments' => $display_comments
                                                    ));
                                                    discussion_post_info_count(array(
                                                        'count' => $display_count
                                                            ), 'list');
                                                    ?>
                                                          </div>
                                                      </div> -->
                                                    <?php if(get_current_blog_id()!=1){ ?>
                                                        <div class="mkd-follow-category">
                                                            <!-- Category follow functionality Start-->
                                                            <?php
                                                            if (is_user_logged_in()) {
                                                                ?>
                                                                <script type = "text/javascript">
                                                                    jQuery(function () {
                                                                        jQuery(".comment_button").click(function () {

                                                                            var user_primary_site=jQuery.trim(jQuery('#user_primary_site').val());
                                                                            if(user_primary_site && user_primary_site!== '0'){                                                                                                                                                        
                                                                                jQuery('#site_user_validation_popup_message').text('Only members of this branch can follow or unfollow the category.');
                                                                                jQuery.magnificPopup.open({
                                                                                    items: {
                                                                                        src: '#site_user_validation_popup',
                                                                                    },
                                                                                    type: 'inline'
                                                                                });
                                                                                return false;
                                                                            }
                                                                            var dataString = jQuery('form').serialize();
                                                                            //alert(dataString);
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
                                                                                    jQuery("#submitvalue").val(obj.submitvalue);
                                                                                }
                                                                            });
                                                                            return false;
                                                                        });
                                                                    });
                                                                </script>
                                                                <div id="followContainer">
                                                                    <form method="post" name="form" action="">
                                                                        <?php
                                                                        $categoryid = $category_id;
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
                                                                        if($parent_category_id!=$category_id) {
                                                                        ?>
                                                                        <button type="button" value="<?php echo $label; ?>" name="follow" class="comment_button"><?php echo $label; ?></button>
                                                                        <?php } ?>
                                                                        <input type="hidden" name="updateflag" id="flagvalue" value="<?php echo $setValue; ?>">
                                                                        <input type="hidden" name="submit" id="submitvalue" value="<?php echo $processDo; ?>">
                                                                        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                                                        <input type="hidden" name="categoryid" value="<?php echo $categoryid; ?>">                                                                    
                                                                    </form>
                                                                </div>


                                                            <?php } ?>
                                                            <!-- Category follow functionality end -->
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            else:
                                discussion_get_module_template_part('templates/parts/no-posts', 'blog');

                            endif;
                            wp_reset_postdata();
                            echo $html;
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>



 

