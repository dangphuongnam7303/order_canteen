<?php
require_once '/xampp/htdocs/polyfood/global.php';
require_once '/xampp/htdocs/polyfood/dao/orders.php';
require_once '/xampp/htdocs/polyfood/dao/users.php';
require_once '/xampp/htdocs/polyfood/dao/products.php';
check_login();
extract($_REQUEST);
if (!isset($_SESSION['my_cart'])) {
    $_SESSION['my_cart'] = [];
}
// unset($_SESSION['my_cart']);
if (exist_param("btn_order")) {
    $product_id = $_POST['product_id'];
    $order_product = products_select_by_id($product_id);
    extract($order_product);
    $image = $_POST['image'];
    $total_price = $price * (1 - $discount / 100) * $quantity;
    $status = 0;

    if (!empty($_SESSION['my_cart'])) {
        foreach ($_SESSION['my_cart'] as  $cart => $key) {
            if ($product_id == $key['product_id']) {
                $add = false;
                break;
            } else {
                $add = true;
            }
        }
        if ($add) {
            $quantity = 1;
            $add_orders = [
                'product_id' => $product_id,
                'image' => $image,
                'quantity' => $quantity,
                'total_price' => $total_price,
                'status' => $status,
                'product_name' => $product_name,
                'price' => $price,
                'discount' => $discount,
                'category_id' => $category_id,
                'menu_id' => $menu_id,
                'detail' => $detail,
            ];
            array_push($_SESSION['my_cart'], $add_orders);
        } else {

            $items_tmp = products_select_by_id($product_id);
            extract($items_tmp);
            $_SESSION['my_cart'][$cart]['quantity'] += 1;
            $quantity = $_SESSION['my_cart'][$cart]['quantity'];
            update_product_cart($quantity, $quantity * $price, $product_id);
        }
    } else {
        $quantity = 1;
        $add_orders = [
            'product_id' => $product_id,
            'image' => $image,
            'quantity' => $quantity,
            'total_price' => $total_price,
            'status' => $status,
            'product_name' => $product_name,
            'price' => $price,
            'discount' => $discount,
            'category_id' => $category_id,
            'menu_id' => $menu_id,
            'detail' => $detail,
            'note1'=>''
        ];
        array_push($_SESSION['my_cart'], $add_orders);
    }
    $VIEW_NAME = 'my-cart.php';
} else if (exist_param("btn_re_quantity")) {
    $VIEW_NAME = "my-cart.php";
    $quantity = $_POST["quantity"];
    $id = $_POST["product_id"];
    $items_tmp = products_select_by_id($id);
    $price = $items_tmp["price"];
    if ($_POST["choose"] == 1) {
        $quantity += 1;
    }
    if ($_POST["choose"] == 0) {

        if ($quantity > 1) {
            $quantity -= 1;
        } else {
            //nếu bé hơn 1 thì xóa mảng trong session
            foreach ($_SESSION['my_cart'] as $key => $value) {
                if ($value['product_id'] == $id) {
                    unset($_SESSION['my_cart'][$key]);
                }
            }
        }
    }
    update_product_cart($quantity, $quantity * $price, $id);
} else if (exist_param("btn_delete")) {
    $VIEW_NAME = "my-cart.php";
    $id = $_POST["product_id"];
    foreach ($_SESSION['my_cart'] as $key => $value) {
        if ($value['product_id'] == $id) {
            unset($_SESSION['my_cart'][$key]);
        }
    }
    // die; 
} else if (exist_param("btn_checkout")) {
    $VIEW_NAME = "checkout.php";
    $user_id = $_SESSION['user']['user_id'];
    $time_order = date("Y-m-d H:i:s");
    $status = 0;
} else if (exist_param("order")) {
    $user_id = $_SESSION['user']['user_id'];
    $time_order = date("Y-m-d H:i:s");
    $status = 0;
    $note = $_POST['note'];
    foreach ($_SESSION['my_cart'] as $cart) {
        extract($cart);
        insert_order($product_id, $quantity, $user_id, $note, $status);
    }
    //thêm note vào session my_cart
    foreach ($_SESSION['my_cart'] as $key => $value) {
        $_SESSION['my_cart'][$key]['note'] = $note;
    }
    $VIEW_NAME = "bill.php";
    // unset($_SESSION['my_cart']);
} else if (exist_param("my-cart")) {
    $VIEW_NAME = "my-cart.php";
} else {
    $VIEW_NAME = "my-cart.php";
}
require_once $VIEW_NAME;
