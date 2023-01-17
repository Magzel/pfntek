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

$response_data   = array(
    'api_status' => 400
);

$required_fields = array(
    'interest_id',
);

foreach ($required_fields as $key => $value) {
    if (empty($_POST[$value]) && empty($error_code)) {
        $error_code    = 3;
        $error_message = $value . ' (POST) is missing';
    }
}

if (empty($error_code)) {
    $interest_id = $_POST['interest_id'];
    $interest_id = explode(',', $interest_id);
}

if (empty($error_code)) {
    $user_intrest_response = Wo_Edit_interest($interest_id);
    if ($user_intrest_response['status'] == '1') {
        http_response_code(200);
        $response_data = array(
            'api_status' => 200,
            'user_id' => $wo['user']['user_id'],
            'message' => $user_intrest_response['data']
        );
    } else {
        http_response_code(400);
        $response_data = array('api_status' => 400, 'message' => $user_intrest_response['data']);
    }
} else {
    http_response_code(400);
    $message = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
