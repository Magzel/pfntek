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
    'post_id',
);
foreach ($required_fields as $key => $value) {
    if (empty($_POST[$value]) && empty($error_code)) {
        $error_code    = 3;
        $error_message = $value . ' (POST) is missing';
    }
}
if (empty($error_code)) {
    $post_id = Wo_Secure($_POST['post_id']);
    $get_post_data_response = Wo_get_post_data($post_id);
    if ($get_post_data_response) {
        $response_data = array(
            'api_status' => 200,
            'message'=>"Post Detail",
            'data' => $get_post_data_response
        );
    }
}
