<?php
$error = "";
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
if ($id == "") {
    $error = "Id is required";
}
if ($error == "") {
    $delete_group_response = delete_wo_groups($id);
    if ($delete_group_response['status'] == '1') {
        http_response_code(200);
        $response_data = array(
            'api_status' => 200,
            'message' => $delete_group_response['data'],
        );
    } else {
        http_response_code(400);
        $response_data = array(
            'api_status' => 400,
            'message' => $delete_group_response['data'],
        );
    }
} else {
    http_response_code(400);
    $message = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
