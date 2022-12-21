<?php 
require_once '/xampp/htdocs/polyfood/dao/pdo.php';

function insert_contacts($email,$content) {
    $sql = "INSERT INTO contacts (email,content) VALUES ('$email','$content')";
    pdo_execute($sql);
}
?>