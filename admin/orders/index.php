<?php
require_once '/xampp/htdocs/polyfood/global.php';
require_once '/xampp/htdocs/polyfood/dao/orders.php';
require_once '/xampp/htdocs/polyfood/dao/statistics.php';

check_login();


//--------------------------------//

extract($_REQUEST);
if(exist_param("user_id")){
    if(exist_param("btn_delete")){
        try {
            order_delete($order_id);
            $MESSAGE = "Xóa thành công!";
        } 
        catch (Exception $exc) {
            $MESSAGE = "Xóa thất bại!";
        }
    }
    $items = order_select_by_user_id($user_id);
    if(count($items) == 0){
        $items = statistic_orders();
        $VIEW_NAME = "../orders/list.php";
    }else if(exist_param("btn_list")){
        $items = statistic_orders();
        $VIEW_NAME = "../orders/list.php";
    }
    else{
        $items = info_order($user_id);
        $VIEW_NAME = "../orders/detail.php";
    }
}
else{
    $items = statistic_orders();
    $VIEW_NAME = "../orders/list.php";
}
require "../page/layout.php";