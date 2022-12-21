<?php
require '../../global.php';
require '../../dao/users.php';

extract($_REQUEST);

$VIEW_NAME = "account/forgot-password-form.php";

if (exist_param("btn_forgot")) {
    $error = [];
    $user = select_by_name_users($user_name);
    if ($user) {
        if ($user['email'] != $email) {
            $error['email'] = "Email không chính xác!";
        } else {
            $MESSAGE = "Mật khẩu của bạn là: " . $user['password'];
            $VIEW_NAME = "account/sign-in-form.php";
            global $user_name, $password;
        }
    } else {
        $error['user_name'] = "Tên đăng nhập không chính xác!";
    }
} else {
    global $user_name, $email;
}

require '../layout.php';