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
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
}
if ($post_id == "") {
    $error = 'Post id is required. ';
}else if($user_id == ""){
    $error = 'User id is required. ';
}
if ($error == "") {
    $view_post = create_post_view($user_id,$post_id);
    if ($view_post['status'] == "1") {
        http_response_code(200);
        $response_data = array(
            'api_status' => 200,
            'message' => $view_post['data'],
        );
    } else {
        http_response_code(400);
        $response_data = array('api_status' => 400, 'message' => $view_post['data']);
    }
} else {
    http_response_code(400);
    $message = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
