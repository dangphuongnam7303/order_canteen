<?php
require_once "/xampp/htdocs/polyfood/global.php";
check_login();
require_once "/xampp/htdocs/polyfood/site/layout/header.php";
require_once '/xampp/htdocs/polyfood/site/layout/menu.php';
?>

    <?php
    require_once "./banner.php";
    require_once $VIEW_NAME;
    require_once '/xampp/htdocs/polyfood/site/layout/footer.php';
    ?>