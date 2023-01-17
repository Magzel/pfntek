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
if (isset($_POST['post_type'])) {
    $post_type = $_POST['post_type'];
}
if (isset($_POST['question'])) {
    $question = $_POST['question'];
}
if (isset($_POST['city'])) {
    $city = $_POST['city'];
}
if ($error == "") {
    if ($post_type == "popular") {
        $post_list_data =   Wo_most_like_post_list();
    } else {
        $post_list_data = Wo_post_list($post_type, $question, $city);
    }
    if ($post_list_data['status'] == "1") {
        http_response_code(200);
        $response_data = array(
            'api_status' => 200,
            'message' => "Interest Data",
            'data' => $post_list_data['data']
        );
    } else {
        http_response_code(400);
        $response_data = array('api_status' => 400, 'message' => "Interest Data", 'data' => $post_list_data['data']);
    }
} else {
    http_response_code(400);
    $message = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
