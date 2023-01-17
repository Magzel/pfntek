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
if (isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];
}

if ($comment_id == "") {
    $error = 'Post Comment id is required. ';
}
if ($error == "") {
    $post_like_data = Wo_post_delete_comment($comment_id);
    if ($post_like_data['status'] == "1") {
        http_response_code(200);
        $response_data = array(
            'api_status' => 200,
            'status' => $post_like_data['status'],
            'message' => $post_like_data['data'],
        );
    } else {
        http_response_code(400);
        $response_data = array('api_status' => 400, 'message' => "Post Comment Unsuccessfully Done", 'data' => $post_like_data['data']);
    }
} else {
    http_response_code(400);
    $message = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
