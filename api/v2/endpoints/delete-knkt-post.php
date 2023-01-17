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
$response_data = array(
    'api_status' => 400
);
if (empty($_POST['post_id'])) {
    $error_code    = 4;
    $error_message = 'post_id (POST) is missing';
}
if (empty($error_code)) {
    $post_id  = Wo_Secure($_POST['post_id']);
    $post_data = Wo_get_post($post_id);
    if (empty($post_data)) {
        $error_code    = 6;
        $error_message = 'Post not found';
    } else {
    	$delete = Wo_delete_post($post_id);
    	if ($delete) {
    		$response_data = array(
		        'api_status' => 200,
		        'message' => "Post deleted Successfully."
		    );
    	}
    }
}