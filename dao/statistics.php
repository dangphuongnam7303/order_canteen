<?php
require_once '/xampp/htdocs/polyfood/dao/pdo.php';
function statistic_products(){
    $sql = "SELECT cate.category_id, cate.category_name,"
    . " COUNT(*) total,"
    . " MIN(pro.price) price_min,"
    . " MAX(pro.price) price_max,"
    . " AVG(pro.price) price_avg"
    . " FROM products pro "
    . " JOIN categories cate ON cate.category_id=pro.category_id "
    . " GROUP BY cate.category_id, cate.category_name";
return pdo_query($sql);
}

function statistic_feedbacks(){
    $sql = "SELECT pro.product_id,pro.product_name, "
    . " COUNT(*) total,"
    . " MIN(fb.time_send) old,"
    . " MAX(fb.time_send) new"
    . " FROM feedbacks fb "
    . " JOIN products pro ON pro.product_id=fb.product_id "
    . " JOIN users u ON u.user_id=fb.user_id "
    . " GROUP BY pro.product_id, pro.product_name"
    . " HAVING total > 0";
    return pdo_query($sql);

}
function statistic_comments(){
    $sql = "SELECT po.post_id,"
    . " COUNT(*) total,"
    . " MIN(cmt.time_send) old,"
    . " MAX(cmt.time_send) new"
    . " FROM comments cmt "
    . " JOIN posts po ON po.post_id=cmt.post_id "
    . " GROUP BY po.post_id"
    . " HAVING total > 0";
    return pdo_query($sql);
}
function statistic_orders(){
    $sql = "SELECT u.user_id, u.user_name,u.name,"
    . " COUNT(*) total,"
    . " MIN(o.time_order) old,"
    . " MAX(o.time_order) new"
    . " FROM orders o "
    . " JOIN users u ON u.user_id=o.user_id "
    . " GROUP BY u.user_id, u.user_name, u.name"
    . " HAVING total > 0";
    return pdo_query($sql);
}
function statistic_posts(){
    $sql = "SELECT u.user_id, u.user_name,u.name,"
    . " COUNT(*) total,"
    . " MIN(p.time_post) old,"
    . " MAX(p.time_post) new"
    . " FROM posts p"
    . " JOIN users u ON u.user_id=p.user_id "
    . " GROUP BY u.user_id, u.user_name, u.name"
    . " HAVING total > 0";
    return pdo_query($sql);
}
function statistic_menus(){
    $sql = "SELECT m.menu_id,m.menu_name,"
    . " COUNT(*) total"
    . " FROM products p"
    . " JOIN menus m ON p.menu_id=m.menu_id "
    . " GROUP BY m.menu_id, m.menu_name";
    return pdo_query($sql);
}
?>