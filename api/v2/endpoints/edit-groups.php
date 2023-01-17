<?php
$error = "";
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
if (isset($_POST['name'])) {
    $name = test_input($_POST['name']);
}
if (isset($_FILES['profile_image'])) {
    $profile_image = $_FILES['profile_image'];
};
if (isset($_FILES['cover_image'])) {
    $cover_image = $_FILES['cover_image'];
};
if (isset($_POST['short_discription'])) {
    $short_discription = test_input($_POST['short_discription']);
}
if (isset($_POST['detail_discription'])) {
    $detail_discription = test_input($_POST['detail_discription']);
}
if (isset($_POST['group_type'])) {
    $group_type = $_POST['group_type'];
}
if ($id == "") {
    $error = "Id is required";
} elseif ($name == "") {
    $error = "Name is required";
} elseif ($short_discription == "") {
    $error = "Short Describtion  is required";
} elseif ($detail_discription == "") {
    $error = "Detail discription  is required";
} elseif ($group_type == "") {
    $error = "Group type is required";
}
if ($error == "") {

    $update_group_response = update_wo_groups($id, $name, $profile_image, $cover_image, $short_discription, $detail_discription, $group_type);
    if ($update_group_response['status'] == '1') {
        http_response_code(200);
        $response_data = array(
            'api_status' => 200,
            'message' => $update_group_response['data'],
        );
    } else {
        http_response_code(400);
        $response_data = array(
            'api_status' => 400,
            'message' => $update_group_response['data'],
        );
    }
} else {
    http_response_code(400);
    $message = "Something Went Wrong";
    $response_data = array('api_status' => 400, 'message' => $error);
}
