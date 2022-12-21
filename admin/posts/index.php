<?php
require_once '/xampp/htdocs/polyfood/global.php';
require_once '/xampp/htdocs/polyfood/dao/posts.php';
require_once '/xampp/htdocs/polyfood/dao/statistics.php';

check_login();


//--------------------------------//

extract($_REQUEST);
if(exist_param("user_id")){
    if(exist_param("btn_delete")){
        try {
            // var_dump($post_id);
            post_delete($post_id);
            $MESSAGE = "Xóa thành công!";
        } 
        catch (Exception $exc) {
            $MESSAGE = "Xóa thất bại!";
        }
    }
    $items = post_select_by_user_id($user_id);
    if(count($items) == 0){
        $items = statistic_posts();
        $VIEW_NAME = "../posts/list.php";
    }else if(exist_param("btn_list")){
        $items = statistic_posts();
        $VIEW_NAME = "../posts/list.php";
    }
    else{
        $items = info_post($user_id);
        $VIEW_NAME = "../posts/detail.php";
    }
}
else{
    $items = statistic_posts();
    $VIEW_NAME = "../posts/list.php";
}
require "../page/layout.php";