<?php
require_once '/xampp/htdocs/polyfood/dao/pdo.php';
function insert_post($post_id, $user_id, $content, $status)
{
    $sql = "INSERT INTO posts(post_id,user_id, content, status) 
                      VALUES ($post_id, $user_id, '$content', $status)";
    pdo_execute($sql);
}
function insert_image_post($post_id, $image)
{
    $sql = "INSERT INTO post_image (post_id,image) VALUES ($post_id,'$image')";
    pdo_execute($sql);
}

function update_post($user_id, $content, $status, $post_id)
{
    $sql = "UPDATE posts SET user_id=$user_id, content='$content', status=$status WHERE post_id=$post_id";
    pdo_execute($sql);
}
function post_delete($post_id)
{

    if (is_array($post_id)) {
        foreach ($post_id as $ma) {
            $sql = "DELETE FROM post_image WHERE post_id=$ma";
            pdo_execute($sql);
            $sql = "DELETE FROM comments WHERE post_id=$ma";
            pdo_execute($sql);
            $sql = "DELETE FROM posts WHERE post_id=$ma";
            pdo_execute($sql);
        }
    } else {
        $sql = "DELETE FROM comments WHERE post_id=$post_id";
        pdo_execute($sql);
        $sql = "DELETE FROM post_image WHERE post_id=$post_id";
        pdo_execute($sql);
        $sql = "DELETE FROM posts WHERE post_id=$post_id";
        pdo_execute($sql);
    }
}
function post_select_all()
{
    $sql = "SELECT * FROM posts";
    return pdo_query($sql);
}
function post_select_by_id($post_id)
{
    $sql = "SELECT * FROM posts WHERE post_id=$post_id";
    return pdo_query_one($sql);
}
//Check sự tồn tại của bài viết
function post_exist($post_id)
{
    $sql = "SELECT count(*) FROM posts WHERE post_id=$post_id";
    return pdo_query_value($sql) > 0;
}

function check_exist()
{ 
    $sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 1";
    return pdo_query_one($sql);
}
//Duyệt bài viết
function post_confirm($post_id)
{
    $sql = "UPDATE posts SET status=1 WHERE post_id=$post_id";
    pdo_execute($sql);
}
//Hủy bài viết
function post_cancel($post_id)
{
    $sql = "UPDATE posts SET status=0 WHERE post_id=$post_id";
    pdo_execute($sql);
}
//post được phép đăng
function post_accept()
{
    $sql = "SELECT * FROM posts WHERE status=1";
    return pdo_query($sql);
}
//post bị từ chối, post chờ duyệt
function post_reject()
{
    $sql = "SELECT * FROM posts WHERE status=0";
    return pdo_query($sql);
}

function select_image_by_post_id($post_id)
{
    $sql = "SELECT * FROM post_image WHERE post_id=$post_id";
    return pdo_query($sql);
}
function post_select_by_user_id($user_id)
{
    $sql = "SELECT * FROM posts WHERE user_id=$user_id";
    return pdo_query($sql);
}

//post theo người dùng

function post_by_user($user_id)
{
    $sql = "SELECT count(*) FROM posts WHERE user_id=$user_id";
    return pdo_query_value($sql) > 0;
}
// post mới nhất
function post_newest()
{
    $sql = "SELECT * FROM posts ORDER BY time_post DESC LIMIT 5";
    return pdo_query($sql);
}
// post cũ nhất
function post_oldest()
{
    $sql = "SELECT * FROM posts ORDER BY time_post ASC LIMIT 5";
    return pdo_query($sql);
}
function post_like_up($post_id)
{
    $sql = "UPDATE posts SET like_count=like_count+1 WHERE post_id=$post_id";
    pdo_execute($sql);
}
function post_like_down($post_id)
{
    $sql = "UPDATE posts SET like_count=like_count-1 WHERE post_id=$post_id";
    pdo_execute($sql);
}
function post_image_select_by_post_id($post_id)
{
    $sql = "SELECT * FROM post_image WHERE post_id=$post_id LIMIT 3";
    return pdo_query($sql);
}
function count_image_post($post_id)
{
    $sql = "SELECT count(*) FROM post_image WHERE post_id=$post_id";
    return pdo_query_value($sql);
}


function info_post($user_id)
{
    $sql = "SELECT p.*,u.user_name,u.name,u.user_id FROM posts p join users u on u.user_id=p.user_id   WHERE p.user_id=$user_id";
    return pdo_query($sql);
}