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
    $interest_data = array(
        'interest_id' => $interest_id,

    );
    $user_intrest_response = Wo_Insert_interest($interest_data);
    if ($user_intrest_response) {
        $response_data = array(
            'api_status' => 200,
            'user_id' => $wo['user']['user_id'],
            'data' => $interest_data
        );
    }
}
