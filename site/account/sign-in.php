<?php
require '../../global.php';
require '../../dao/users.php';

extract($_REQUEST);

if (exist_param("btn_login")) {
    $error = [];
    $user = select_by_name_users($user_name);
    if ($user) {
        if ($user['password'] == $password) {
            $MESSAGE = "Đăng nhập thành công!";
            if (exist_param("remember")) {
                add_cookie("user_name", $user_name, 30);
                add_cookie("password", $password, 30);
            } else {
                delete_cookie("user_name");
                delete_cookie("password");
            }
            $_SESSION["user"] = $user;
            if (isset($_SESSION['request_uri'])) {
                header("location: " . $_SESSION['request_uri']);
            }
            header("location: " . "$SITE_URL/page/index.php");
            die;
        } else {
            $error['password'] = "Thông tin mật khẩu không chính xác!";
        }
    } else {
        $error['user_name'] = "Thông tin tài khoản không chính xác!";
    }
} else {
    if (exist_param("btn_logoff")) {
        $MESSAGE = "Đăng xuất thành công!";
        session_unset();
    }
    $user_name = get_cookie("user_name");
    $password = get_cookie("password");
}

$VIEW_NAME = "account/sign-in-form.php";
require '../layout.php';
