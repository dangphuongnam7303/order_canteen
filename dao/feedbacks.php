<?php
require_once '/xampp/htdocs/polyfood/dao/pdo.php';
function insert_feedbacks($user_id, $product_id,$rate, $content){
    $sql = "INSERT INTO feedbacks(user_id, product_id,rate, content) 
                      VALUES ( '$user_id', $product_id,$rate, '$content')";
    pdo_execute($sql);
}
function update_feedbacks($user_id, $product_id,$rate, $content, $feedback_id){
    $sql = "UPDATE feedbacks SET user_id='$user_id', product_id=$product_id,rate=$rate, content='$content' WHERE feedback_id=$feedback_id";
    pdo_execute($sql);
}
function feedbacks_delete($feedback_id) {
    if(is_array($feedback_id)){
        foreach ($feedback_id as $ma) {
    $sql = "DELETE FROM feedbacks  WHERE feedback_id=$ma";

            pdo_execute($sql);
        }
    }
    else{
    $sql = "DELETE FROM feedbacks  WHERE feedback_id=$feedback_id";

        pdo_execute($sql);
    }

}
function feedbacks_select_all(){
    $sql = "SELECT * FROM feedbacks";
    return pdo_query($sql);
}
function feedbacks_select_by_id($feedback_id){
    $sql = "SELECT * FROM feedbacks WHERE feedback_id=$feedback_id";
    return pdo_query_one($sql);
}
function feedbacks_exist($feedback_id){
    $sql = "SELECT count(*) FROM feedbacks WHERE feedback_id=$feedback_id";
    return pdo_query_value($sql) > 0;
}
//feedback theo người dùng
function feedbacks_select_by_user_id($user_id) {
    $sql = "SELECT * FROM feedbacks WHERE user_id=$user_id";
    return pdo_query($sql);
}
//feedback theo sản phẩm
function feedbacks_select_by_product_id($product_id) {
    $sql = "SELECT * FROM feedbacks WHERE product_id=$product_id";
    return pdo_query($sql);

}
function info_feedback($product_id){
    $sql = "SELECT u.user_name,pro.product_name, fb.* FROM feedbacks fb join products pro on pro.product_id=fb.product_id join users u on fb.user_id=u.user_id WHERE fb.product_id=$product_id";
    return pdo_query($sql);
}
function join_feedbacks_user($product_id){
    $sql = "SELECT f.*,u.image as img_user,u.name as name_user FROM feedbacks f join users u on u.user_id = f.user_id WHERE f.product_id=$product_id";
    return pdo_query($sql);
}
function count_feedbacks($product_id){
    $sql = "SELECT count(*) FROM feedbacks WHERE product_id=$product_id";
    return pdo_query_value($sql);
}
function avg_feedbacks($product_id){
    $sql = "SELECT avg(rate) FROM feedbacks WHERE product_id=$product_id";
    return pdo_query_value($sql);
}
?>