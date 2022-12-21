<?php
require_once '/xampp/htdocs/polyfood/global.php';
require_once '/xampp/htdocs/polyfood/dao/menus.php';
require_once '/xampp/htdocs/polyfood/dao/products.php';
require_once '/xampp/htdocs/polyfood/dao/statistics.php';

check_login();

//--------------------------------//

extract($_REQUEST);

if (exist_param("menu_id")) {
    if (exist_param("btn_delete")) {
        try {
            menus_delete($menu_id);
            $MESSAGE = "Xóa thành công!";
        } catch (Exception $exc) {
            $MESSAGE = "Xóa thất bại!";
        }
        $items = statistic_menus();
        $VIEW_NAME = "../menus/list.php";
    } else if (exist_param("btn_edit")) {
        $menu = menus_select_by_id($menu_id);
        extract($menu);
        $VIEW_NAME = "../menus/edit.php";
    } else if (exist_param("btn_update")) {
        $error = [];
        $menu_name = trim($menu_name);
        $flag = true;
        if ($menu_name == '') {
            $error['menu_name'] = "Tên menu không được để trống!";
            $flag = false;
        }
        if (menus_exist_menuname_by_id($menu_name, $menu_id)) {
            $error['menu_name'] = "Tên menu đã tồn tại!";
            $flag = false;
        }
        if ($flag) {
            try {
                update_menus($menu_name, $menu_id);
                $MESSAGE = "Cập nhật danh mục thành công";
            } catch (Exception $exc) {
                $MESSAGE = "Cập nhật danh mục thất bại";
            }
        }
        $VIEW_NAME = "../menus/edit.php";
    } else if (exist_param("btn_list")) {
        $items = statistic_menus();
        $VIEW_NAME = "../menus/list.php";
    }

    $items = products_select_by_menu_id($menu_id);
    if (count($items) == 0) {
        $items = statistic_menus();
        $VIEW_NAME = "../menus/list.php";
    } else if (exist_param("btn_detail")) {
        $items = info_menu($menu_id);
        $allproducts = products_select_all();
        $VIEW_NAME = "../menus/detail.php";
    } else if (exist_param("btn_delete_product")) {
        try {
            delete_product_by_product_id($product_id);
            $MESSAGE = "Xóa thành công!";
        } catch (Exception $exc) {
            $MESSAGE = "Xóa thất bại!";
        }
        $items = info_menu($menu_id);
        $VIEW_NAME = "../menus/detail.php";
    } else if (exist_param("btn_edit_product")) {

        $product = products_select_by_id($product_id);
        extract($product);
        $check = $product_id;
        $allproducts = products_select_all();
        $VIEW_NAME = "../menus/edit-product.php";
    } else if (exist_param("btn_update_product")) {
        try {
            update_product($menu_id, $product_id, $product_id1);
            $product = products_select_by_id($product_id1);
            extract($product);
            $check = $product_id;
            $allproducts = products_select_all();
            $items = info_menu($menu_id);
            $MESSAGE = "Sửa thành công!";
        } catch (Exception $exc) {
            $MESSAGE = "Sửa thất bại!";
        }
        $VIEW_NAME = "../menus/edit-product.php";
    } else if (exist_param("btn_list")) {
        $items = statistic_menus();
        $VIEW_NAME = "../menus/list.php";
    } else if (exist_param("btn_add_product")) {
        $error = [];
        // var_dump($product_id);die;
        $flag = true;
        if (!isset($product_id)) {
            $error['product_id'] = "Vui lòng chọn ít nhất 1 sản phẩm!";
            $flag = false;
        }
        if ($flag) {
            try {
                add_product($menu_id, $product_id);
                $MESSAGE = "Thêm sản phẩm thành công";
                unset($product_id);
                global $menu_id, $product_id;
            } catch (Exception $exc) {
                $MESSAGE = "Thêm sản phẩm thất bại";
            }
        }
        $items = info_menu($menu_id);
        // var_dump($items);die;
        $VIEW_NAME = "../menus/detail.php";
    } else if (exist_param("btn_add")) {
        $items = products_select_all();
        $VIEW_NAME = "../menus/add-product.php";
    } else if (exist_param("search_product")) {
        $items = products_select_keyword($keyword);
        $VIEW_NAME = "../menus/add-product.php";
    }
} else {
    if (exist_param("btn_insert")) {
        $error = [];
        $menu_name = trim($menu_name);
        $flag = true;
        if ($menu_name == '') {
            $error['menu_name'] = "Tên menu không được để trống!";
            $flag = false;
        }
        if (menus_exist_by_menuname($menu_name)) {
            $error['menu_name'] = "Tên menu đã tồn tại!";
            $flag = false;
        }
        if ($flag) {
            try {
                insert_menus($menu_name);
                $MESSAGE = "Thêm danh mục thành công";
                unset($menu_name, $menu_id);
                global $menu_name;
            } catch (Exception $exc) {
                $MESSAGE = "Thêm danh mục thất bại";
            }
        }
        $VIEW_NAME = "../menus/new.php";
    } else if (exist_param("btn_list")) {
        $items = statistic_menus();
        $VIEW_NAME = "../menus/list.php";
    } else if (exist_param("btn_list_menu")) {
        $items = menus_select_all();
        $VIEW_NAME = "../menus/list-menu.php";
    } else if (exist_param("btn_delete")) {

        try {
            menus_delete($menu_id);
            //         echo "<pre>";
            // var_dump($menu_id);die;
            $MESSAGE = "Xóa thành công!";
        } catch (Exception $exc) {
            $MESSAGE = "Xóa thất bại!";
        }
        $items = statistic_menus();

        $VIEW_NAME = "../menus/list.php";
    } else if (exist_param("btn_edit")) {
        $menu = menus_select_by_id($menu_id);
        extract($menu);

        $VIEW_NAME = "../menus/edit.php";
    } else if (exist_param("btn_update")) {
        try {
            update_menus($menu_name, $menu_id);
            $MESSAGE = "Cập nhật danh mục thành công";
        } catch (Exception $exc) {
            $MESSAGE = "Cập nhật danh mục thất bại";
        }
        $VIEW_NAME = "../menus/edit.php";
    } else {
        global $menu_name;
        $VIEW_NAME = "../menus/new.php";
    }
}
require "../page/layout.php";
