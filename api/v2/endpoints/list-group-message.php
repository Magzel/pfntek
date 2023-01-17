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
    $error = "Group id is required";
}
if ($error == "") {

    $group_chat_list = group_chat_list($group_id);
    if ($group_chat_list['status'] == "1") {
        http_response_code(200);
        $response_data = array(
            'api_status' => 200,
            'data' => $group_chat_list['data']
        );
    } else {
        http_response_code(400);
        $response_data = array('api_status' => 400, 'data' => $group_chat_list['data']);
    }
} else {
    http_response_code(400);
    $message = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
