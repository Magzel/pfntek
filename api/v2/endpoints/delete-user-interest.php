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
$user_id=$wo['user']['user_id'];
$user_intrest_response = Wo_delete_interest($user_id);
if ($user_intrest_response) {
    $response_data = array(
        'api_status' => 200,
        'message'=>"Intrest Deleted",

    );
}
