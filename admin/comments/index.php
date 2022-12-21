<?php
require_once '/xampp/htdocs/polyfood/global.php';
require_once '/xampp/htdocs/polyfood/dao/comments.php';
require_once '/xampp/htdocs/polyfood/dao/statistics.php';

check_login();


//--------------------------------//

extract($_REQUEST);
if(exist_param("post_id")){
    if(exist_param("btn_delete")){
        try {
            comment_delete($comment_id);
            $MESSAGE = "Xóa thành công!";
        } 
        catch (Exception $exc) {
            $MESSAGE = "Xóa thất bại!";
        }
    }
    $items = comment_select_by_post_id($post_id);
    if(count($items) == 0){
        $items = statistic_comments();
        $VIEW_NAME = "../comments/list.php";
    }
    else{
        $items = info_comment($post_id);
        $VIEW_NAME = "../comments/detail.php";
    }
}
else{
    $items = statistic_comments();
    $VIEW_NAME = "../comments/list.php";
}
require "../page/layout.php";