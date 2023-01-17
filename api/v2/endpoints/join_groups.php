<?php
// +------------------------------------------------------------------------+
// | @author Deen Doughouz (DoughouzForest)
// | @author_url 1: http://www.wowonder.com
// | @author_url 2: http://codecanyon.net/user/doughouzforest
// | @author_email: wowondersocial@gmail.com   
// +------------------------------------------------------------------------+
// | WoWonder - The Ultimate Social Networking Platform
// | Copyright (c) 2018 WoWonder. All rights reserved.
// +------------------------------------------------------------------------+
$error = "";
$response_data = array();
if (isset($_POST['group_id'])) {
    $group_id = $_POST['group_id'];
}
if ($group_id == "") {
    $error = 'Group id is required. ';
}
if ($error == "") {
    $member_exist_result = member_exist($group_id);
    if ($member_exist_result['status'] == "1") {
        http_response_code(400);
        $response_data = array('api_status' => 400, 'message' => $member_exist_result['data']);
    } else {
        $join_group_result = join_group($group_id);
        if ($join_group_result['status'] == "1") {
            http_response_code(200);
            $response_data = array(
                'api_status' => 200,
                'message' => $join_group_result['data'],
            );
        } else {
            http_response_code(400);
            $response_data = array('api_status' => 400, 'message' => $join_group_result['data']);
        }
    }
} else {
    http_response_code(400);
    $message = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
