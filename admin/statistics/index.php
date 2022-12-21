<?php
require_once "/xampp/htdocs/polyfood/global.php";
require_once "/xampp/htdocs/polyfood/dao/statistics.php";
//--------------------------------//

check_login();


if(exist_param("chart")){
    $VIEW_NAME = "../statistics/chart.php";
}
else{
    $VIEW_NAME = "../statistics/list.php";
}
$items = statistic_products();
require_once "/xampp/htdocs/polyfood/admin/page/layout.php";

