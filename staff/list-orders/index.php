<?php
require_once "../../global.php";
require_once "../../dao/orders.php";
check_login();
extract($_REQUEST);
if (exist_param("btn_confirm")) {
    order_change_status($order_id);
    $items = order_select_by_unfinished();
    $VIEW_NAME = "./list.php";
} else if (exist_param("btn_cancel")) {
    order_delete($order_id);
    $items = order_select_by_unfinished();
    $VIEW_NAME = "./list.php";
} else {
    $items = order_select_by_unfinished();
    $VIEW_NAME = "./list.php";
}
require "./layout.php";