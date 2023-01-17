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
if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
}
if ($post_id == "") {
    $error = 'Post id is required. ';
}
if ($error == "") {
    $post_share = Wo_share_post($post_id);
    if ($post_share['status'] == "1") {
        http_response_code(200);
        $response_data = array(
            'api_status' => 200,
            'message' => $post_share['data'],
        );
    } else {
        http_response_code(400);
        $response_data = array('api_status' => 400, 'message' => $post_share['data']);
    }
} else {
    http_response_code(400);
    $message = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
