<div class="follow-container">
    <div class="fsp-followed-categories">
        <div class="followed_ctg_content">
            <?php
            $userid = get_current_user_id();
            $fetchresult = $wpdb->get_results("SELECT *from wp_follow_category where userid=" . $userid . " and flag=1 ORDER BY date DESC");
            $rowresult = $wpdb->num_rows;
            // To collect the followed sub-categories ids to display those sub cat on the dropdow list.
            foreach ($fetchresult as $getSubcat) {
                $getSubcatids[] = $getSubcat->categoryid;
            }
            ?>

            <?php
            $args = array(
                'orderby' => 'name',
                'parent' => 0
            );
            $parentCategoriesdetails = get_categories($args);
            foreach ($parentCategoriesdetails as $parentCategoriesval) {
                $parentCat.= $parentCategoriesval->term_id . ',';
                ;
            }
            $fetchedparentCat = rtrim($parentCat, ',');
            $userid = get_current_user_id();
            ?>
            <div class="follow-mani-cont-nw vc_col-md-12">
                <div class="unfollow-container-nw">
                    <form action="" name="followsubcat" id="followsubcat">
                        <h2>Select Subcategory You Want to Follow:</h2>
                        <div class="selectcat-container">
                            <div class="select-inn-cnt">
                                <select name="categoryid" id="subcatslectbox" required>
                                    <option value="" ><?php echo "Sub Categories" ?></option>
                                    <?php
                                    //example code for reference
                                    /* $args = array(
                                      'exclude' => $fetchedparentCat // desire id
                                      );
                                      $cats = get_categories($args);
                                      foreach ($cats as $category) {
                                      $option = '<option value="/category/archives/' . $category->category_nicename . '">';
                                      $option .= $category->cat_name;
                                      $option .= '</option>';
                                      echo '<a href="' . get_category_link($category->term_id) . '">' . $option . '</a>';
                                      } */


                                    $args = array(
                                        'exclude' => $fetchedparentCat // desire id
                                    );
                                    $cats = get_categories($args);

                                    foreach ($cats as $category) {
                                        if (in_array($category->term_id, $getSubcatids)) {
                                            $disabled = "disabled";
                                        } else {
                                            $disabled = '';
                                        }
                                        ?>
                                        <option <?php echo $disabled ?> value="<?php echo $category->term_id ?>"><?php echo $category->cat_name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div id="selectbox-msg"></div>
                            </div>
                            <input type="hidden" name="updateflag" id="flagvalue" value="1">
                            <input type="hidden" name="submit" id="submitvalue" value="insert">
                            <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                <!--            <input type="hidden" name="categoryid" value="<?php //echo $categoryid;                            ?>"> -->
                            <button type="button" value="Follow" name="follow" class="comment_button" id="followbutton"><?php echo 'Follow'; ?></button>
                        </div>
                    </form>
                </div>

                <div class="follow-container-nw">
                    <h2>Followed Subcategories:</h2> 
                    <form action="" name="unfollowsubcat" id="unfollowsubcat">
                        <div id='followedSubcat' class="follow-innercont vc_col-md-12">

                            <ul>
                                <?php
                                foreach ($fetchresult as $results) {
                                    if ($results->categoryid > 0) {
                                        ?>
                                        <li class="vc_col-md-2 vc_col-sm-6 vc_col-xs-12">
                                            <div class="followedcheck">
                                                <input type="checkbox" name="followedcategories[]" class="followedsubcates" value="<?php echo $results->categoryid ?>" id="<?php echo get_the_category_by_ID($results->categoryid) ?>">
                                                <label for="<?php echo get_the_category_by_ID($results->categoryid) ?>"><span></span>  <?php echo get_the_category_by_ID($results->categoryid) ?></label>                                                      
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                                <?php if ($rowresult == 0) { ?>
                                    <li class="vc_col-md-8">
                                        No Record found.
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="btn_flw-cont">
                                <input type="hidden" name="submit" id="submitvalue" value="delete">
                                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                <button type="button" value="Unfollow" id="unfollow_button" name="unfollow" class="unfollow_button"><?php echo 'Unfollow'; ?></button>
                                <div id="unfollowed-msg"></div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
