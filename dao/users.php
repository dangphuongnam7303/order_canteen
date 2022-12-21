<?php
require_once "/xampp/htdocs/polyfood/dao/pdo.php";
function insert_users($user_name, $password, $name, $email, $phone, $image, $role_id)
{
    $sql = "INSERT INTO users(user_name, password,name, email, phone, image, role_id) 
                      VALUES ( '$user_name', '$password','$name', '$email', '$phone', '$image', $role_id)";
    pdo_execute($sql);
}
function update_users($user_name, $password, $name, $email, $phone, $image, $role_id, $user_id)
{
    $sql = "UPDATE users SET user_name='$user_name', password='$password',name='$name', email='$email', phone='$phone', image='$image', role_id=$role_id WHERE user_id=$user_id";
    pdo_execute($sql);
}
function delete_users($user_id)
{
    if (is_array($user_id)) {
        foreach ($user_id as $ma) {
            $sql = "DELETE FROM users WHERE user_id=$ma";

            pdo_execute($sql);
        }
    } else {
        $sql = "DELETE FROM users  WHERE user_id=$user_id";

        pdo_execute($sql);
    }
}
function select_all_users()
{
    $sql = "SELECT u.*,r.role_name FROM users u join roles r on u.role_id = r.role_id";
    return pdo_query($sql);
}
function select_by_id_users($user_id)
{
    $sql = "SELECT * FROM users WHERE user_id=$user_id";
    return pdo_query_one($sql);
}
function select_by_name_users($user_name)
{
    $sql = "SELECT * FROM users WHERE user_name='$user_name'";
    return pdo_query_one($sql);
}
function users_exist_by_id($user_id)
{
    $sql = "SELECT count(*) FROM users WHERE user_id=$user_id";
    return pdo_query_value($sql) > 0;
}
function users_exist_by_username($user_name)
{
    $sql = "SELECT count(*) FROM users WHERE user_name='$user_name'";
    return pdo_query_value($sql) > 0;
}
function users_exist_by_username_id($user_name, $user_id)
{
    $sql = "SELECT count(*) FROM users WHERE user_name='$user_name' AND user_id != $user_id";
    return pdo_query_value($sql) > 0;
}
function users_exist_by_email($email)
{
    $sql = "SELECT count(*) FROM users WHERE email='$email'";
    return pdo_query_value($sql) > 0;
}
function users_exist_by_email_id($email, $user_id)
{
    $sql = "SELECT count(*) FROM users WHERE email='$email' AND user_id != $user_id";
    return pdo_query_value($sql) > 0;
}
function users_exist_by_phone_id($phone, $user_id)
{
    $sql = "SELECT count(*) FROM users WHERE phone='$phone' AND user_id != $user_id";
    return pdo_query_value($sql) > 0;
}
function users_exist_by_phone($phone)
{
    $sql = "SELECT count(*) FROM users WHERE phone='$phone'";
    return pdo_query_value($sql) > 0;
}
function select_users_by_role($role_id)
{
    $sql = "SELECT * FROM users WHERE role_id=$role_id";
    return pdo_query($sql);
}
function users_change_password_by_id($user_id, $password)
{
    $sql = "UPDATE users SET password='$password' WHERE user_id=$user_id";
    pdo_execute($sql);
}
function users_change_password_by_username($user_name, $password)
{
    $sql = "UPDATE users SET password='$password' WHERE user_name='$user_name'";
    pdo_execute($sql);
}
function users_exist_by_password_id($password, $user_id)
{
    $sql = "SELECT count(*) FROM users WHERE password='$password' AND user_id = $user_id";
    return pdo_query_value($sql) > 0;
}