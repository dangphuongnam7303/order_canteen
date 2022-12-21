<?php
require_once '/xampp/htdocs/polyfood/dao/pdo.php';
   function roles_select_all(){
        $sql = "SELECT * FROM roles";
        return pdo_query($sql);
    }
    
?>