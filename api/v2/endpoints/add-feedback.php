<?php
$error = "";
if (isset($_POST['name'])) {
    $name = test_input($_POST['name']);
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if (isset($_POST['query_type'])) {
    $query_type = test_input($_POST['query_type']);
}
if (isset($_POST['query'])) {
    $query = $_POST['query'];
}

if ($name == "") {
    $error = "name is required";
} elseif ($email == "") {

    $error = "email is required";
} elseif ($query_type == "") {
    $error = "query type is required";
} elseif ($query == "") {
    $error = "query is required";
}

if ($error == "") {
    $add_feedback_result = add_feedback($name, $email, $query_type, $query);
    if ($add_feedback_result['status'] == 1) {
        http_response_code(200);
        $response_data = array(
            'api_status' => 200,
            'message' => $add_feedback_result['data']
        );
    } else {
        http_response_code(400);
        $response_data = array(
            'api_status' => 400,
            'message' => $add_feedback_result['data']
        );
    }
} else {
    http_response_code(400);
    $response_data = array(
        'api_status' => 400,
        'message' => $error
    );
}
