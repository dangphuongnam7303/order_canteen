<?php
require '../../global.php';
require '../../dao/users.php';

check_login();
extract($_REQUEST);

if (exist_param("btn_update")) {
    $error = [];
    $name = trim($name);
    $phone = trim($phone);
    $flag = true;
    if (strlen($name) < 6) {
        $error['name'] = "Họ và tên phải có ít nhất 6 ký tự!";
        $flag = false;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Email không đúng định dạng!";
        $flag = false;
    }
    if (users_exist_by_email_id($email, $user_id)) {
        $error['email'] = "Email này đã được sử dụng!";
        $flag = false;
    }
    if (strlen($phone) != 10 || !is_numeric($phone)) {
        $error['phone'] = "Vui lòng nhập số điện thoại!";
        $flag = false;
    }
    if (!preg_match('/((09|03|07|08|05)+([0-9]{8})\b)/', $phone)) {
        $error['phone'] = "Số điện thoại không đúng!";
        $flag = false;
    }
    if (users_exist_by_phone_id($phone, $user_id)) {
        $error['phone'] = "Số điện thoại này đã được sử dụng!";
        $flag = false;
    }
    if ($flag) {
        $image_upload = save_file("image_upload", "$IMAGE_DIR/users/");
        $image = strlen("$image_upload") > 0 ? $image_upload : $image;
        try {
            update_users($user_name, $password, $name, $email, $phone, $image, $role_id, $user_id);
            $MESSAGE = "Cập nhật thành công!";
            $_SESSION['user'] = select_by_name_users($user_name);
        } catch (Exception $exc) {
            $MESSAGE = "Cập nhật thất bại!";
        }
    }
} else {
    extract($_SESSION['user']);
}

$VIEW_NAME = "account/update-account-form.php";
require '../layout.php';
