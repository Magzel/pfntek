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
    'post_describtions',
    'interest_ids',
);


foreach ($required_fields as $key => $value) {
    if (empty($_POST[$value]) && empty($error_code)) {
        $error_code    = 3;
        $error_message = $value . ' (POST) is missing';
    }
}

if (empty($error_code)) {

    $post_id = Wo_Secure($_POST['post_id']);
    $post_title     = Wo_Secure($_POST['post_title']);
    $post_describtions    = Wo_Secure($_POST['post_describtions']);
    // $location   = Wo_Secure($_POST['location']);
    $interest_id  = $_POST['interest_ids'];
    $interest_id = explode(',', $interest_id);
    $media = $_FILES['media'];
    if (isset($_POST["media_type"])) {
        $media_type = $_POST["media_type"];
    }
    if (empty($_POST['post_title'])) {
        $error_code    = 4;
        $error_message = 'Post Title is Required';
    }
    if (empty($error_code)) {
        $post_data  = array(
            'post_title' => $post_title,
            'user_id' => $wo['user']['user_id'],
            'post_description' => $post_describtions,
            // 'location' => $location,
            'post_id' => $post_id
        );

        $post_insert_response = Wo_edit_post($post_data);
        if ($post_insert_response == 1) {
            $image_len = count(array($media['name']));
            if (!empty($media['name'])) {
                if ($image_len > 0) {
                    $delete_post_media = Wo_delete_media($post_id);
                    $fileInfo = array(
                        'file' => $media["tmp_name"],
                        'name' => $media['name'],
                        'size' => $media["size"],
                        'type' => $media["type"],
                    );
                    $file = Wo_ShareFile($fileInfo, 0);
                    if (!empty($file)) {
                        $post_media = Wo_edit_media($post_id, $file['filename'], $media_type);
                    }
                }
            }
            // add interest 
            $post_interest_data  = array(
                'interest_id' => $interest_id,
            );

            $interest_id_response = Wo_edit_post_interest($post_id, $post_interest_data);
            if (isset($_POST['user_tags_ids'])) {
                $tags_user_ids = $_POST['user_tags_ids'];
                $post_interest_data  = array(
                    'user_tags_id' => $tags_user_ids,
                );
                Wo_post_tags($post_id, $post_interest_data);
            }
        }

        if ($post_insert_response == 1) {
            $post_data['post_id'] = $post_id;
            $response_data = array(
                'api_status' => 200,
                'message' => "Post Edit Successfully",
                'data' => $post_data
            );
        }
    }
}
