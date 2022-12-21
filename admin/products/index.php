<?php
require_once '/xampp/htdocs/polyfood/global.php';
require_once '/xampp/htdocs/polyfood/dao/products.php';
require_once '/xampp/htdocs/polyfood/dao/categories.php';
require_once '/xampp/htdocs/polyfood/dao/menus.php';

check_login();
extract($_REQUEST);

if (exist_param('btn_insert')) {
    $error = [];
    $product_name = trim($product_name);
    $price = trim($price);
    $discount = trim($discount);
    $quantity = trim($quantity);
    $detail = trim($detail);
    $flag = true;
    if (strlen($product_name) <= 0) {
        $error['product_name'] = "Bạn chưa nhập tên sản phẩm!";
        $flag = false;
    }
    if (products_name_exist($product_name)) {
        $error['product_name'] = "Tên sản phẩm này đã tồn tại!";
        $flag = false;
    }
    if ($price <= 0) {
        $error['price'] = "Giá sản phẩm phải lớn hơn 0!";
        $flag = false;
    }
    if (strlen($price) <= 0) {
        $error['price'] = "Bạn chưa nhập giá!";
        $flag = false;
    }
    if (strlen($discount) <= 0) {
        $error['discount'] = "Bạn chưa nhập số phần trăm giảm giá!";
        $flag = false;
    }
    if ($quantity <= 0) {
        $error['quantity'] = "Số lượng sản phẩm phải lớn hơn 0!";
        $flag = false;
    }
    if (strlen($quantity) <= 0) {
        $error['quantity'] = "Bạn chưa nhập số lượng!";
        $flag = false;
    }
    if (strlen($detail) <= 0) {
        $error['detail'] = "Bạn chưa nhập chi tiết sản phẩm!";
        $flag = false;
    }
    if ($flag) {
        $upload_image = save_file("image", "$IMAGE_DIR/products/");
        $image = strlen("$upload_image") > 0 ? $upload_image : 'product.png';
        try {
            products_insert($product_name, $price, $discount, $image, $category_id, $quantity, $detail, $menu_id);
            unset($product_name, $price, $discount, $image, $category_id, $quantity, $detail, $menu_id);
            $MESSAGE = "Thêm mới thành công!";
        } catch (Exception $exc) {
            $MESSAGE = "Thêm mới thất bại!";
        }
        global $product_id, $product_name, $price, $discount, $image, $category_id,  $quantity, $detail, $menu_id;
    }
    $VIEW_NAME = "../products/new.php";
} else if (exist_param('btn_update')) {
    $error = [];
    $product_name = trim($product_name);
    $price = trim($price);
    $discount = trim($discount);
    $quantity = trim($quantity);
    $detail = trim($detail);
    $flag = true;
    if (strlen($product_name) <= 0) {
        $error['product_name'] = "Bạn chưa nhập tên sản phẩm!";
        $flag = false;
    }
    if (products_name_exist_id($product_name, $product_id)) {
        $error['product_name'] = "Tên sản phẩm này đã tồn tại!";
        $flag = false;
    }
    if ($price <= 0) {
        $error['price'] = "Giá sản phẩm phải lớn hơn 0!";
        $flag = false;
    }
    if (strlen($price) <= 0) {
        $error['price'] = "Bạn chưa nhập giá!";
        $flag = false;
    }
    if (strlen($discount) <= 0) {
        $error['discount'] = "Bạn chưa nhập số phần trăm giảm giá!";
        $flag = false;
    }
    if ($quantity <= 0) {
        $error['quantity'] = "Số lượng sản phẩm phải lớn hơn 0!";
        $flag = false;
    }
    if (strlen($quantity) <= 0) {
        $error['quantity'] = "Bạn chưa nhập số lượng!";
        $flag = false;
    }
    if (strlen($detail) <= 0) {
        $error['detail'] = "Bạn chưa nhập chi tiết sản phẩm!";
        $flag = false;
    }
    if ($flag) {
        $upload_image = save_file("upload_image", "$IMAGE_DIR/products/");
        $image = strlen("$upload_image") > 0 ? $upload_image : $image;
        try {
            products_update($product_id, $product_name, $price, $discount, $image, $category_id,  $quantity, $detail, $menu_id);
            $MESSAGE = "Cập nhật thành công!";
        } catch (Exception $exc) {
            $MESSAGE = "Cập nhật thất bại!";
        }
    }
    $VIEW_NAME = "../products/edit.php";
} else if (exist_param('btn_delete')) {
    try {
        products_delete($product_id);
        $items = products_select_all();
        $MESSAGE = "Xóa thành công!";
    } catch (Exception $exc) {
        $MESSAGE = "Xóa thất bại!";
    }
    $VIEW_NAME = "../products/list.php";
} else if (exist_param('btn_edit')) {
    $item = products_select_by_id($product_id);
    extract($item);
    $VIEW_NAME = "../products/edit.php";
} else if (exist_param("btn_list")) {
    $items = products_select_all();
    $VIEW_NAME = "../products/list.php";
} else {
    global $product_id, $product_name, $price, $discount, $image, $category_id,  $quantity, $detail, $menu_id;
    $VIEW_NAME = "../products/new.php";
}
require_once '/xampp/htdocs/polyfood/admin/page/layout.php';
