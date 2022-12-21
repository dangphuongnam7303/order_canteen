<?php
require_once "/xampp/htdocs/polyfood/dao/pdo.php";
require_once "/xampp/htdocs/polyfood/global.php";
require_once "/xampp/htdocs/polyfood/dao/posts.php";
require_once "/xampp/htdocs/polyfood/dao/users.php";
require_once "/xampp/htdocs/polyfood/dao/comments.php";
check_login();
extract($_REQUEST);
if (exist_param("btn_insert")) {
    $post_id = $_POST['post_id'];
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['user_id'];
    } else {
        $user_id = 0;
    }
    $status = 0;
    $image = $_FILES['image']['name'];
    insert_post($post_id, $user_id, $content, $status);
    header('location: ' . $_SERVER['HTTP_REFERER']);
    foreach ($image as $key => $value) { //lấy tên file
        if (empty($image[$key])) {
            continue;
        } else {
            $image = uniqid() . '_' . $value; //tên file
        }
        $image_tmp = $_FILES['image']['tmp_name'][$key]; //đường dẫn file
        move_uploaded_file($image_tmp, $IMAGE_DIR . 'posts/' . $image); //di chuyển file vào thư mục
        insert_image_post($post_id, $image);
        
    }
    echo "<scrip>alert('Đăng bài thành công!');</script>";
    header("location:./index.php");
} else if (exist_param("btn_delete_post")) {
    post_delete($post_id);
    header('location: ' . $_SERVER['HTTP_REFERER']);
} else if (exist_param("btn_check")) {
    $VIEW_NAME = "./manager_post.php";
} else if (exist_param("btn_confirm")) {
    post_confirm($post_id);
    $VIEW_NAME = "./manager_post.php";
} else if (exist_param("btn_cancel")) {
    post_delete($post_id);
    $VIEW_NAME = "./manager_post.php";
} else if (exist_param("btn_add_comment")) {
    $user_id = $_SESSION['user']['user_id'];
    $image = save_file("image", "$IMAGE_DIR/comments/");
    $image = strlen("$image") > 0 ? $image : '';
    try {
        comment_insert($user_id, $post_id, $content, $image);
        header('location: ' . $_SERVER['HTTP_REFERER']);
    } catch (Exception $exc) {
        $_SESSION['error'] = "Vui lòng đăng nhập để bình luận";
    }
} else if (exist_param("btn_delete_comment")) {
    $comment_id = $_POST["comment_id"];
    comment_delete($comment_id);
    header('location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $VIEW_NAME = "./home.php";
}

require "./layout.php";
