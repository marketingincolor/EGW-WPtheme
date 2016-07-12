<?php
/**
 * 
 * Author - Akilan
 * Date - 13-06-2016
 * Purpose - For displaying mind spirit based blogs 
 * Template Name: Child Mind & Spirit page 
 *
 */
?>

<?php get_header(); 
$category='mind-spirit';
list($post_per_section,$post_type)=scroll_loadpost_settings();
?>
<div class="mkd-content">
    <div class="mkd-content-inner">
        <div class="mkd-full-width">
            <div class="mkd-full-width-inner">               
               <?php
               /*For showing banner image*/
                get_template_part('template-page-featured-content');               
               ?>
            <div class="mkd-container">
            <div class="mkd-container-inner clearfix">
                <div class="mkd-two-columns-75-25  mkd-content-has-sidebar clearfix">
                    <div class="mkd-column1 mkd-content-left-from-sidebar">
                        <div class="mkd-column-inner">
                              <div class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div> 
                            <?php
                            $my_query = null;                           
                            $cat_id_ar=array();
                            if(is_user_logged_in()){   
                                $userid = get_current_user_id();  
                                $fetchresult = $wpdb->get_results("SELECT categoryid FROM wp_follow_category where userid=" . $userid." AND flag=1");
                                if(!empty($fetchresult)){                           
                                    foreach ($fetchresult as $results) {                                       
                                        $cat_id_ar[]=$results->categoryid;
                                    }                             
                                     discussion_custom_categorylist_query($cat_id_ar,$post_per_section);
                                } else {
                                    $cat_id_ar=get_main_category_detail();
                                    $my_query =  discussion_custom_categorylist_query($cat_id_ar,$post_per_section); 
                                }
                            } else {
                                $cat_id_ar=get_main_category_detail();
                                $my_query =  discussion_custom_categorylist_query($cat_id_ar,$post_per_section);
                            }
                              
                            global $wp_query;
                            get_template_part('template-blog-block');       
                            ?>
                       </div>
                    </div>
                    <div class="mkd-column2">
                        <div class="mkd-column-inner">
                            <aside class="mkd-sidebar" style="transform: translateY(0px);">
                              <div class="widget widget_apsc_widget">  
                                <div class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div> 
                               <?php get_template_part('sidebar/template-sidebar-home'); ?>
                              </div>    
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
    <?php
    /**
     * For loading scroll based post loading
     */
     include(locate_template('template-ajax-pagination.php'));
    ?>
    <?php get_footer(); ?>

