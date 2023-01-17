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

$user_id = $wo['user']['user_id'];
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

if ($user_id) {
    $user_intrest_response = Wo_list_interest($user_id, $search);
    if ($user_intrest_response) {
        $response_data = array(
            'api_status' => 200,
            'message' => "Interest Data",
            'data' => $user_intrest_response
        );
    } else {
        http_response_code(400);
        $response_data = array('api_status' => 400, 'message' => "Interest Data", 'data' => $user_intrest_response);
    }
} else {
    http_response_code(400);
    $error = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
