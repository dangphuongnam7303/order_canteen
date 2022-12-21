<?php
require_once '/xampp/htdocs/polyfood/global.php';
require_once '/xampp/htdocs/polyfood/dao/feedbacks.php';
require_once '/xampp/htdocs/polyfood/dao/statistics.php';

check_login();


//--------------------------------//

extract($_REQUEST);
if(exist_param("product_id")){
    if(exist_param("btn_delete")){
        try {
            feedbacks_delete($feedback_id);
            $MESSAGE = "Xóa thành công!";
        } 
        catch (Exception $exc) {
            $MESSAGE = "Xóa thất bại!";
        }
    }
    $items = feedbacks_select_by_product_id($product_id);
    if(count($items) == 0){
        $items = statistic_feedbacks();
        $VIEW_NAME = "../feedbacks/list.php";
    }
    else{
        $items = info_feedback($product_id);
        $VIEW_NAME = "../feedbacks/detail.php";
    }
}
else{
    $items = statistic_feedbacks();
    $VIEW_NAME = "../feedbacks/list.php";
}
require "../page/layout.php";