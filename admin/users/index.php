<?php
require_once "/xampp/htdocs/polyfood/global.php";
require_once "../../dao/users.php";
require_once "../../dao/roles.php";
//--------------------------------//
check_login();
extract($_REQUEST);

if (exist_param("btn_insert")) {
    $roles = roles_select_all();
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
        $upload_image = save_file("image", "$IMAGE_DIR/users/");
        $image = strlen("$upload_image") > 0 ? $upload_image : 'user.png';
        try {
            insert_users($user_name, $password, $name, $email, $phone, $image, $role_id);
            unset($user_name, $password, $name, $email, $phone, $image, $role_id);
            $MESSAGE = "Thêm mới thành công!";
        } catch (Exception $exc) {
            $MESSAGE = "Thêm mới thất bại!";
        }
        global $user_name, $password, $name, $email, $phone, $image, $role_id, $password2;
    }
    $VIEW_NAME = "../users/new.php";
} else if (exist_param("btn_update")) {
    $roles = roles_select_all();
    $role_check = $role_id;
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
    if (users_exist_by_username_id($user_name, $user_id)) {
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
        $upload_image = save_file("upload_image", "$IMAGE_DIR/users/");
        $image = strlen("$upload_image") > 0 ? $upload_image : $image;
        try {
            update_users($user_name, $password, $name, $email, $phone, $image, $role_id, $user_id);
            $MESSAGE = "Cập nhật thành công!";
        } catch (Exception $exc) {
            $MESSAGE = "Cập nhật thất bại!";
        }
    }
    $items = select_all_users();
    $VIEW_NAME = "../users/edit.php";
} else if (exist_param("btn_delete")) {
    try {
        delete_users($user_id);
        $items = select_all_users();
        $MESSAGE = "Xóa thành công!";
    } catch (Exception $exc) {
        $MESSAGE = "Xóa thất bại!";
    }
    $VIEW_NAME = "../users/list.php";
} else if (exist_param("btn_edit")) {
    $roles = roles_select_all();
    $item = select_by_id_users($user_id);
    extract($item);
    $role_check = $role_id;
    $VIEW_NAME = "../users/edit.php";
} else if (exist_param("btn_list")) {
    $items = select_all_users();
    $VIEW_NAME = "../users/list.php";
} else {
    $roles = roles_select_all();
    global $user_name, $password, $name, $email, $phone, $image, $role_id, $password2;
    $VIEW_NAME = "../users/new.php";
}

require "/xampp/htdocs/polyfood/admin/page/layout.php";
