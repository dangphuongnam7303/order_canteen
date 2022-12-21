<?php
require_once '/xampp/htdocs/polyfood/dao/pdo.php';
function insert_menus($menu_name)
{
    $sql = "INSERT INTO menus (menu_name) VALUES ('$menu_name')";
    pdo_execute($sql);
}
function update_menus($menu_name, $menu_id)
{
    $sql = "UPDATE menus SET menu_name = '$menu_name' WHERE menu_id = $menu_id";
    pdo_execute($sql);
}
function delete_product_by_product_id($product_id)
{
    if (is_array($product_id)) {
        foreach ($product_id as $id_tmp) {
            $sql = "UPDATE products SET menu_id = 1 WHERE product_id = $id_tmp";
            pdo_execute($sql);
        }
    }
    $sql = "UPDATE products SET menu_id = 1 WHERE product_id = $product_id";
    pdo_execute($sql);
}
function menus_delete($menu_id)
{
    if (is_array($menu_id)) {
        foreach ($menu_id as $id_tmp) {
            $sql = "UPDATE products SET menu_id=1 WHERE menu_id=$id_tmp";
            pdo_execute($sql);
            $sql = "DELETE FROM menus WHERE menu_id=$id_tmp";
            pdo_execute($sql);
        }
    } else {
        $sql = "UPDATE products SET menu_id=1 WHERE menu_id=$menu_id";
        pdo_execute($sql);
        $sql = "DELETE FROM menus WHERE menu_id=$menu_id";
        pdo_execute($sql);
    }
}
function menus_select_all()
{
    $sql = "SELECT * FROM menus";
    return pdo_query($sql);
}
function menus_select_by_id($menu_id)
{
    $sql = "SELECT * FROM menus WHERE menu_id=$menu_id";
    return pdo_query_one($sql);
}
function info_menu($menu_id)
{
    $sql = "SELECT m.*,p.product_id,p.product_name,p.image FROM menus m join products p on p.menu_id=m.menu_id WHERE p.menu_id=$menu_id";
    return pdo_query($sql);
}
function update_product($menu_id, $product_id, $product_id1)
{
    $sql = "UPDATE products SET menu_id=1 WHERE product_id = $product_id";
    pdo_execute($sql);
    $sql = "UPDATE products SET menu_id=$menu_id WHERE product_id = $product_id1";
    pdo_execute($sql);
}
function add_product($menu_id, $product_id)
{
    if (is_array($product_id)) {
        foreach ($product_id as $id_tmp) {
            $sql = "UPDATE products SET menu_id=$menu_id WHERE product_id = $id_tmp";
            pdo_execute($sql);
        }
    } else {
        $sql = "UPDATE products SET menu_id=$menu_id WHERE product_id = $product_id";
        pdo_execute($sql);
    }
}
function menus_exist_by_menuname($menu_name)
{
    $sql = "SELECT * FROM menus WHERE menu_name='$menu_name'";
    return pdo_query_one($sql);
}
function menus_exist_menuname_by_id($menu_name, $menu_id)
{
    $sql = "SELECT count(*) FROM menus WHERE menu_name='$menu_name' AND menu_id != $menu_id";
    return pdo_query_value($sql) > 0;
}
