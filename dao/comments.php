<?php
require_once '/xampp/htdocs/polyfood/dao/pdo.php';
function comment_insert($user_id, $post_id, $content, $image)
{
    $sql = "INSERT INTO comments(user_id, post_id, content, image) 
                      VALUES ( '$user_id', $post_id, '$content','$image')";
    pdo_execute($sql);

    function comment_update($user_id, $post_id, $content, $comment_id)
    {
        $sql = "UPDATE comments SET user_id=$user_id, post_id=$post_id, content='$content' WHERE comment_id=$comment_id";
        pdo_execute($sql);
    }
}
function comment_delete($comment_id)
{
    if (is_array($comment_id)) {
        foreach ($comment_id as $ma) {
            $sql = "DELETE FROM comments  WHERE comment_id=$ma";

            pdo_execute($sql);
        }
    } else {
        $sql = "DELETE FROM comments  WHERE comment_id=$comment_id";

        pdo_execute($sql);
    }
}
function comment_select_all()
{
    $sql = "SELECT * FROM comments";
    return pdo_query($sql);
}
function comment_select_by_id($comment_id)
{
    $sql = "SELECT * FROM comments WHERE comment_id=$comment_id";
    return pdo_query_one($sql);
}

function comment_exist($comment_id)
{
    $sql = "SELECT count(*) FROM comments WHERE comment_id=$comment_id";
    return pdo_query_value($sql) > 0;
}




function comment_select_by_user_id($user_id)
{
    $sql = "SELECT * FROM comments WHERE user_id=$user_id";
    return pdo_query($sql);
}
//commet theo bài viết
function comment_select_by_post_id($post_id)
{
    $sql = "SELECT c.*,u.user_name,u.name,u.user_id ,u.image as avatar FROM comments c,users u WHERE c.user_id=u.user_id AND post_id=$post_id";
    return pdo_query($sql);
}
function info_comment($post_id)
{ //
    $sql = "SELECT u.user_name,po.post_id, cm.* FROM comments cm join posts po on po.post_id=cm.post_id join users u on cm.user_id=u.user_id  WHERE cm.post_id=$post_id";
    return pdo_query($sql);
}
 
