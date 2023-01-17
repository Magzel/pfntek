<?php
if (isset($_POST['group_type'])) {
    $group_type = $_POST['group_type'];
} else {
    $group_type = 0;
}

$list_group_response = list_wo_groups($group_type);
if ($list_group_response['status'] == '1') {
    http_response_code(200);
    $response_data = array(
        'api_status' => 200,
        'data' => $list_group_response['data'],
    );
} else {
    http_response_code(400);
    $response_data = array(
        'api_status' => 400,
        'data' => $list_group_response['data'],
    );
}
