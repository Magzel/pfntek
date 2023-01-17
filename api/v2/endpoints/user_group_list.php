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
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
}
if ($user_id == "") {
    $error = 'User Id is required. ';
}

if ($error == "") {
    $group_list_data = user_group_list($user_id);
    if ($group_list_data['status'] == "1") {
        http_response_code(200);
        $response_data = array(
            'api_status' => 200,
            'data' => $group_list_data['data'],
        );
    } else {
        http_response_code(400);
        $response_data = array('api_status' => 400,  'data' => $group_list_data['data']);
    }
} else {
    http_response_code(400);
    $message = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
