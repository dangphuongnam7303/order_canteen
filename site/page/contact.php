<?php 
require_once "../../global.php";
require_once "../../dao/contacts.php";
extract($_REQUEST);
if(exist_param("btn_insert_contact")){
    insert_contacts($email,$content);
    header("location: $SITE_URL/page/index.php");
}
header("location: $SITE_URL/page/index.php");

