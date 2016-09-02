<?php
require('../../../wp-load.php');

global $wpdb;

//query for insert data into tables
if ($_POST['ajaxupdate'] == 'unfollowedCat') {
    //query for Update data into tables
    $userid = $_POST['userid'];
    $categoryid = $_POST['categoryid'];
    $flag = $_POST['updateflag'];
    //echo "UPDATE wp_follow_category SET flag=" . $flag . " WHERE userid=" . $userid . " and categoryid =" . $categoryid . "";

    $table_name = 'wp_follow_category';
    $data_update = array('flag' => $flag);
    $data_where = array('userid' => $userid, 'categoryid' => $categoryid);
    $updated = $wpdb->update($table_name, $data_update, $data_where);
    $wpdb->print_error();
    if (false === $updated) {
        $msg = "There was an error.";
    } else {
        $msg = "Unfollowed successfully.";
    }
    ?>
    
    <?php
    $userid = get_current_user_id();
    $fetchresult = $wpdb->get_results("SELECT *from wp_follow_category where userid=" . $userid . " and flag=1");
    $rowresult = $wpdb->num_rows;
    ?>
<span><a href="#" id="unfollowedmsg" style="color: green; font-size: 12px;"></a></span>
    <div id="requiredvalues">
        <!-- TO update the div after unfollowed any category from profile. "unfollowedCat" is just page reference -->
        <input type="hidden" name="updateflag" id="flagvalue" value="0">                                
        <input type="hidden" name="ajaxupdate" id="flagvalue" value="unfollowedCat">
        <input type="hidden" name="submit" id="submitvalue" value="update">
        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
    </div>
    <ul>
        <?php
        foreach ($fetchresult as $results) {
            ?>
            <li class="vc_col-md-3 vc_col-sm-6 vc_col-xs-6">

                <div class="ctg_list">
                    <?php
                    $attr = array(
                        'class' => '',
                        'alt' => get_the_category_by_ID($results->categoryid),
                        'height' => 198,
                        'width' => 302,
                        'title' => get_the_category_by_ID($results->categoryid),
                    );
                    z_taxonomy_image($results->categoryid, 'full', $attr);
                    ?>

                    <h4><?php echo get_the_category_by_ID($results->categoryid); ?> <span class="ion-android-close" id="<?php echo $results->categoryid; ?>"></span></h4>
                </div>
            </li>
        <?php } ?>
        <?php if ($rowresult == 0) { ?>
            <li class="vc_col-md-8">
                No Record found.
            </li>
        </div>
    <?php } ?>
    </ul>

    <?php
}
?>

<script type = "text/javascript">
    jQuery(function () {
        jQuery(".ion-android-close").unbind().click(function () {
            var dataString = jQuery('#requiredvalues :input').serialize() + '&categoryid=' + this.id;
            jQuery.ajax({
                type: "POST",
                url: "wp-content/themes/village-child/unfollowajax.php",
                data: dataString,
                cache: false,
                success: function (successvalue) {
                    jQuery('.followed_ctg_content').html(successvalue);
                    jQuery('#unfollowedmsg').html("<i aria-hidden='true' class='fa fa-check'></i> Unfollowed successfully").fadeOut(3000);
                }
            });
            return false;
        });
    });
</script>