<?php
require_once "/xampp/htdocs/polyfood/global.php";
require_once '/xampp/htdocs/polyfood/site/layout/header.php';
require_once '/xampp/htdocs/polyfood/site/layout/menu.php';
require_once "/xampp/htdocs/polyfood/site/layout/banner.php";
if($VIEW_NAME == "index.php"){
    require_once "./page/index.php";
}else{
    require_once $VIEW_NAME;
}
require_once "/xampp/htdocs/polyfood/site/layout/contact.php";
require_once '/xampp/htdocs/polyfood/site/layout/footer.php';
?>



