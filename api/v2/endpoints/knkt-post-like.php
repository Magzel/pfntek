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
if (isset($_POST['post_like'])) {
    $post_like = $_POST['post_like'];
}
if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
}
if ($post_like == "") {
    $error = 'Post Like is required. ';
} else if ($post_like == "") {
    $error = 'Post is is required. ';
}
if ($error == "") {
    $post_like_data = Wo_post_like($post_like, $post_id, $like_id);
    if ($post_like_data['status'] == "1" || $post_like_data['status'] == "0") {
        http_response_code(200);
        $response_data = array(
            'api_status' => 200,
            'like_status' => $post_like_data['status'],
            'message' => $post_like_data['data'],
        );
    } else {
        http_response_code(400);
        $response_data = array('api_status' => 400, 'message' => "Post Reaction Unsuccessfully Done", 'data' => $post_like_data['data']);
    }
} else {
    http_response_code(400);
    $message = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
