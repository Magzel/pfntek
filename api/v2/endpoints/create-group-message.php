<?php
$error = "";
if (isset($_POST['message'])) {
    $message = test_input($_POST['message']);
}
if (isset($_POST['group_id'])) {
    $group_id = $_POST['group_id'];
}
if (isset($_POST['time'])) {
    $time = $_POST['time'];
}
if (isset($_POST['get_image'])) {
    $get_image = $_POST['get_image'];
}
if ($message == "") {
    $error = "Message is required";
} else if ($group_id == "") {
    $error = "Group id is required";
}
if ($error == "") {

    $messgage_result = create_groups_messages($message, $group_id, $time, $get_image);
    if ($messgage_result['status'] == '1') {
        http_response_code(200);
        $response_data = array(
            'api_status' => 200,
            'message' => $messgage_result['data'],
        );
    } else {
    }
} else {
    http_response_code(400);
    $message = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
