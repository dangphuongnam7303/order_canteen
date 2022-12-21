<?php
require '../../global.php';
require '../../dao/users.php';

extract($_REQUEST);

if (exist_param("btn_register")) {
    $error = [];
    $user_name = trim($user_name);
    $name = trim($name);
    $password = trim($password);
    $phone = trim($phone);
    $flag = true;
    if (strlen($user_name) < 6) {
        $error['user_name'] = "Tên đăng nhập phải có ít nhất 6 ký tự!";
        $flag = false;
    }
    if (users_exist_by_username($user_name)) {
        $error['user_name'] = "Tên đăng nhập này đã được sử dụng!";
        $flag = false;
    }
    if (strlen($name) < 6) {
        $error['name'] = "Họ và tên phải có ít nhất 6 ký tự!";
        $flag = false;
    }
    if (strlen($password) < 6) {
        $error['password'] = "Mật khẩu phải có ít nhất 6 ký tự!";
        $flag = false;
    }
    if ($password != $password2) {
        $error['password2'] = "Xác nhận mật khẩu không đúng!";
        $flag = false;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Email không đúng định dạng!";
        $flag = false;
    }
    if (users_exist_by_email($email)) {
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
    if (users_exist_by_phone($phone)) {
        $error['phone'] = "Số điện thoại này đã được sử dụng!";
        $flag = false;
    }

    if ($flag) {
        $image_upload = save_file("image_upload", "$IMAGE_DIR/users/");
        $image = strlen("$image_upload") > 0 ? $image_upload : "user.png";
        try {
            insert_users($user_name, $password, $name, $email, $phone, $image, $role_id);
            $MESSAGE = "Đăng ký thành viên thành công!";
            header("location: " . "$SITE_URL/account/sign-in.php");
            die;
        } catch (Exception $exc) {
            $MESSAGE = "Đăng ký thành viên thất bại!";
        }
    }
} else {
    global $user_name, $password, $name, $email, $phone, $image, $role_id, $password2;
}

$VIEW_NAME = "account/sign-up-form.php";
require '../layout.php';
