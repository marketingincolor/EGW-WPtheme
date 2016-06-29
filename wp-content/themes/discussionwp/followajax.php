<?php

require('../../../wp-load.php');

global $wpdb;

//query for insert data into tables
if ($_POST['submit'] == 'insert') {
    $userid = $_POST['userid'];
    $categoryid = $_POST['categoryid'];
    $flag = $_POST['updateflag'];
    $sql = "INSERT INTO wp_follow_category (userid, categoryid, flag) VALUES ($userid, $categoryid, $flag )";
    $follow_table = 'wp_follow_category';
    $updated = $wpdb->insert(
            $follow_table, array(
        'userid' => $userid,
        'categoryid' => $categoryid,
        'flag' => $flag
    ));
    if (false === $updated) {
        $msg = "There was an error.";
    } else {
        $setflag = 0;
        $label = "Unfollow";
        $msg = "New record created successfully";
        $submitvalue = "update";
    }
    $jsonInput = array(
        "label" => $label,
        "msg" => $msg,
        "setflag" => $setflag,
        "submitvalue" => $submitvalue
    );
    echo json_encode($jsonInput);
} else {
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
        $fetchresult = $wpdb->get_results("SELECT *from wp_follow_category where userid=" . $userid . " and categoryid=" . $categoryid . "");
        $rowresult = $wpdb->num_rows;
        foreach ($fetchresult as $results) {
            $currentFlag = $results->flag;
        }
        if ($currentFlag == 0) {
            $label = "Follow";
            $setflag = 1;
        } else {
            $label = "unfollow";
            $setflag = 0;
        }
        $msg = "Record Updated successfully";
    }
    $jsonInput = array(
        "label" => $label,
        "msg" => $msg,
        "setflag" => $setflag
    );
    echo json_encode($jsonInput);
}
?>