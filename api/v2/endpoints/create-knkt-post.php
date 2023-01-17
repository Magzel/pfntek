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
    'post_title',
    'interest_ids',
);

foreach ($required_fields as $key => $value) {
    if (empty($_POST[$value]) && empty($error_code)) {
        $error_code    = 3;
        $error_message = $value . ' (POST) is missing';
    }
}

if (empty($error_code)) {
    $post_title     = test_input($_POST['post_title']);
    $post_describtions    = test_input($_POST['post_describtions']);
    $location   = test_input($_POST['location']);
    $interest_id  = $_POST['interest_ids'];
    $interest_id = explode(',', $interest_id);
    // print_r($interest_id);
    // die;
    if (isset($_FILES['media'])) {
        $media = $_FILES['media'];
    };
    if (isset($_POST['media_type'])) {
        $media_type = $_POST['media_type'];
    };


    if (empty($_POST['post_title'])) {
        $error_code    = 4;
        $error_message = 'Post Title is Required';
    }
    if (empty($error_code)) {
        $post_data  = array(
            'post_title' => $post_title,
            'user_id' => $wo['user']['user_id'],
            'post_description' => $post_describtions,
            'location' => $location,
        );
        $post_insert_response = Wo_Insert_Post($post_data);
        if ($post_insert_response) {
            // images uploaded here 
            if (isset($_FILES['media'])) {
                $fileInfo = array(
                    'file' => $_FILES["media"]["tmp_name"],
                    'name' => $_FILES['media']['name'],
                    'size' => $_FILES["media"]["size"],
                    'type' => $_FILES["media"]["type"],
                );

                $file = Wo_ShareFile($fileInfo, 0);
                if (!empty($file)) {
                    $post_media = Wo_post_media($post_insert_response, $file['filename'], $media_type);
                }
            }

            // add interest 
            $post_interest_data  = array(
                'interest_id' => $interest_id,
            );
            // print_r($post_interest_data);
            // die;
            $interest_id_response = Wo_post_interest($post_insert_response, $post_interest_data);
            if (isset($_POST['user_tags_ids'])) {
                $tags_user_ids = $_POST['user_tags_ids'];
                $post_interest_data  = array(
                    'user_tags_id' => $tags_user_ids,
                );
                Wo_post_tags($post_insert_response, $post_interest_data);
            }
        }

        if ($post_insert_response) {
            $post_data['post_id'] = $post_insert_response;
            $response_data = array(
                'api_status' => 200,
                'message' => "Post Created Successfully",
                'data' => $post_data
            );
        }
    }
}
