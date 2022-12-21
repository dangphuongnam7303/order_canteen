<?php
require_once '/xampp/htdocs/polyfood/global.php';
require_once '/xampp/htdocs/polyfood/dao/categories.php';

check_login();
extract($_REQUEST);

if (exist_param('btn_insert')) {
    $error = [];
    $category_name = trim($category_name);
    $suggest = trim($suggest);
    $flag = true;
    if (strlen($category_name) <= 0) {
        $error['category_name'] = "Bạn chưa nhập tên danh mục!";
        $flag = false;
    }
    if (categories_name_exist($category_name)) {
        $error['category_name'] = "Tên danh mục này đã tồn tại!";
        $flag = false;
    }
    if (strlen($suggest) <= 0) {
        $error['suggest'] = "Bạn chưa nhập gợi ý!";
        $flag = false;
    }
    if ($flag) {
        $upload_category_image = save_file("category_image", "$IMAGE_DIR/categories/");
        $category_image = strlen("$upload_category_image") > 0 ? $upload_category_image : 'category.png';
        try {
            insert_categories($category_name, $category_image, $suggest);
            $MESSAGE = "Thêm danh mục thành công";
            unset($category_name, $category_id, $category_image, $suggest);
        } catch (Exception $exc) {
            $MESSAGE = "Thêm danh mục thất bại";
        }
        global $category_name, $category_id, $category_image, $suggest;
    }
    $VIEW_NAME = "../categories/new.php";
} else if (exist_param('btn_update')) {
    $error = [];
    $category_name = trim($category_name);
    $suggest = trim($suggest);
    $flag = true;
    if (strlen($category_name) <= 0) {
        $error['category_name'] = "Bạn chưa nhập tên danh mục!";
        $flag = false;
    }
    if (categories_name_exist_id($category_name, $category_id)) {
        $error['category_name'] = "Tên danh mục này đã tồn tại!";
        $flag = false;
    }
    if (strlen($suggest) <= 0) {
        $error['suggest'] = "Bạn chưa nhập gợi ý!";
        $flag = false;
    }
    if ($flag) {
        $upload_category_image = save_file("upload_category_image", "$IMAGE_DIR/categories/");
        $category_image = strlen("$upload_category_image") > 0 ? $upload_category_image : $category_image;
        try {
            update_categories($category_name, $category_image, $suggest, $category_id);
            $MESSAGE = "Cập nhật danh mục thành công";
        } catch (Exception $exc) {
            $MESSAGE = "Cập nhật danh mục thất bại";
        }
    }
    $VIEW_NAME = "../categories/edit.php";
} else if (exist_param('btn_delete')) {
    try {
        categories_delete($category_id);
        $items = categories_select_all();
        $MESSAGE = "Xóa thành công!";
    } catch (Exception $exc) {
        $MESSAGE = "Xóa thất bại!";
    }
    $VIEW_NAME = "../categories/list.php";
} else if (exist_param('btn_edit')) {
    $item = categories_select_by_id($category_id);
    extract($item);
    $VIEW_NAME = "../categories/edit.php";
} else if (exist_param("btn_list")) {
    $items = categories_select_all();
    $VIEW_NAME = "../categories/list.php";
} else {
    global $category_name, $category_id, $category_image, $suggest;
    $VIEW_NAME = "../categories/new.php";
}
require_once '/xampp/htdocs/polyfood/staff/page/layout.php';
