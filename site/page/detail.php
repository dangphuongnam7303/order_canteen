<?php
require_once "/xampp/htdocs/polyfood/global.php";
require_once '/xampp/htdocs/polyfood/dao/products.php';
require_once '/xampp/htdocs/polyfood/dao/feedbacks.php';

$product_id = $_GET['product_id'];

$user_feedbacks = join_feedbacks_user($product_id);
$count = count_feedbacks($product_id);
extract($_REQUEST);
$items = products_select_by_id($product_id);
extract($items);
$category_id = $items['category_id'];
$price_discount = $price * (1 - $discount / 100);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/base.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="../Javascript/main.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
</head>

<body class="font-montserrat">
    <header class="sticky top-0 z-50 hidden text-gray-700 bg-white border-b border-gray-200 lg:block">
        <div class="container flex flex-col flex-wrap items-center p-5 mx-auto md:flex-row">
            <a class="flex items-center mb-4 font-medium font title-font md:mb-0" href="#" target="_blank">
                <span class="text-orange-600">poly</span><span class="font-semibold text-blue-600">F</span><span class="font-semibold text-orange-600">oo</span><span class="font-semibold text-green-600">d</span>
            </a>

            <nav class="flex flex-wrap items-center justify-center text-base md:ml-auto">
                <ul class="flex justify-center w-full gap-6 text-sm uppercase menu">
                    <li><a href="<?= $SITE_URL ?>/page/index.php">Trang chủ</a></li>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <?php if ($_SESSION['user']['role_id'] != 3) { ?>
                            <li><a href='<?= $STAFF_URL ?>/list-orders/index.php'>Danh sách đặt hàng</a></li>
                        <?php } ?>
                    <?php } ?>
                    <li><a href="<?= $SITE_URL ?>/page/introduce.php">Giới thiệu</a></li>
                    <li><a href="<?= $SITE_URL ?>/page/product.php">Sản Phẩm</a></li>
                    <li><a href="<?= $SITE_URL ?>/post/index.php">Blog</a></li>
                    <li>
                        <div class="relative inline-block text-left">
                            <div>
                                <button type="button" id="menu-drop" aria-expanded="true" aria-haspopup="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </div>
                            <div id="sub-menu-drop" class="absolute right-0 z-10 hidden w-56 mt-2 origin-top-right bg-white rounded-md shadow-lg animate-down ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1" role="none">
                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                    <a href="<?= $SITE_URL ?>/account/update-account.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-0">
                                        Cài đặt tài khoản
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">
                                        Hỗ trợ
                                    </a>
                                    <a href="<?= $STAFF_URL ?>/list-orders/index.php<?php if (isset($_SESSION['user'])) echo "?user_id=" . $_SESSION['user']['user_id'] ?>" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">
                                        Đơn hàng của tôi
                                    </a>
                                    <a href="<?= $SITE_URL ?>/account/change-password.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">
                                        Đổi mật khẩu
                                    </a>
                                    <?php if (isset($_SESSION['user'])) { ?>

                                        <?php extract($_SESSION['user']); ?>

                                        <?php if ($role_id == 1) { ?>
                                            <a href="<?= $ADMIN_URL ?>/page/index.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-2">
                                                Trang quản trị
                                            </a>

                                        <?php  } ?>
                                    <?php } ?>
                                    <form method="POST" action="<?= $SITE_URL ?>/account/sign-in.php" role="none">
                                        <?php if (isset($_SESSION['user'])) {


                                            echo " <button type='submit' name='btn_logoff' class='block w-full px-4 py-2 text-sm text-left text-gray-700 uppercase' role='menuitem' tabindex='-1' id='menu-item-3'>
                                          
                                    Đăng xuất
                                 
                                 </button>";
                                        } else {


                                            echo " <button type='submit' class='block w-full px-4 py-2 text-sm text-left text-gray-700 uppercase' role='menuitem' tabindex='-1' id='menu-item-3'>
                                          
                                    Đăng nhập
                                 
                                 </button>";
                                        }
                                        ?>

                                    </form>
                                    <form action="<?= $SITE_URL ?>/account/forgot-password.php">
                                        <?php if (!isset($_SESSION['user'])) {
                                            echo " <button type='submit' class='block w-full px-4 py-2 text-sm text-left text-gray-700 uppercase' role='menuitem' tabindex='-1' id='menu-item-3'>
                                          
Quên mật khẩu</button>";
                                        } ?>

                                    </form>
                                    <form action="<?= $SITE_URL ?>/account/sign-up.php" method="post" enctype="multipart/form-data">
                                        <?php if (!isset($_SESSION['user'])) {
                                            echo " <button type='submit' class='block w-full px-4 py-2 text-sm text-left text-gray-700 uppercase' role='menuitem' tabindex='-1' id='menu-item-3'>
                                          
Đăng ký</button>";
                                        } ?>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="max-w-6xl mx-auto mt-10">

        <div class="grid gap-12 p-6 bg-white rounded-lg shadow-md md:grid-cols-2">
            <div class="rounded-lg">
                <img src="<?= $CONTENT_URL ?>/images/products/<?= $items['image'] ?>" alt="" class="rounded-xl">
            </div>
            <div class="">
                <form action="../cart/index.php?btn_order" method="POST">
                    <input type="hidden" name="product_id" id="product_id" value="<?= $items['product_id'] ?>">
                    <input type="hidden" name="product_name" id="product_name" value="<?= $items['product_name'] ?>">
                    <input type="hidden" name="price" id="price" value="<?= $items['price'] ?>">
                    <input type="hidden" name="image" id="image" value="<?= $items['image'] ?>">

                    <div class="text-3xl font-bold text-gray-700"><?= $items['product_name'] ?></div>
                    <div class="flex items-center py-4 space-x-2 ">
                        <p class="text-sm text-gray-500">
                            <?php
                            $avg = avg_feedbacks($items['product_id']);
                            if ($avg == 0) {
                                echo "Chưa có đánh giá";
                            } else if ($avg <= 1) {
                                echo "★";
                            } else if (1 < $avg && $avg <= 2) {
                                echo "★★";
                            } else if (2 < $avg && $avg <= 3) {
                                echo "★★★";
                            } else if (3 < $avg && $avg <= 4) {
                                echo "★★★★";
                            } else if (4 < $avg && $avg <= 5) {
                                echo "★★★★★";
                            }

                            ?>

                        </p>
                        <p class="text-sm text-orange-500">/</p>
                        <p class="text-sm text-gray-500"><?= $count ?>
                            Phản hồi
                        </p>
                    </div>
                    <div class="flex space-x-2 text-3xl text-orange-600">

                        <strike class="text-3xl font-light text-gray-400"><?= number_format($price, 0, ",", ".") ?>
                            đ</strike>
                        <p class="flex gap-2 text-3xl"> <span></span>
                            <?= number_format($price_discount, 0, ",", ".") ?>đ
                    </div>

                    <div class="py-4">
                        <img style="width:96px" src="../IMG/logo.png" alt="">
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-orange-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>

                        <p class="font-light text-gray-500">
                            Hỗ trợ tận tình , đồ ăn tận răng !
                        </p>
                    </div>
                    <div class="flex items-center py-2 space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-orange-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>

                        <p class="font-light text-gray-500">
                            Đồ ăn sẵn sàng , điện thoại reo
                        </p>
                    </div>
                    <button class="flex items-center px-5 py-2 mt-5 text-sm text-white bg-orange-600 rounded-lg">
                        <p class="px-2">Thêm vào giỏ</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>
    <section class="max-w-6xl mx-auto mt-20">
        <div class="flex items-center justify-center space-x-4 button-box">
            <div id="btn" class="inlinde-block md:mr-44  text-xl text-center rounded-xl md:w-[90px] md:h-[48px] border-red-500 bg-orange-500">
            </div>
            <button type="button" class="toggle-btn" onclick="leftClick()"><span id="trai" class="inline-block px-8 py-2 text-xl text-white rounded-xl sili">Mô tả</span></button>
            <button type="button" class="toggle-btn" onclick="rightClick()"><span id="phai" class="inline-block px-8 py-2 text-xl text-red-500 rounded-xl ">Nhận xét ( <?= $count ?>
                    )</span></button>
        </div>
        <p class="px-6 py-6 font-light text-gray-500 text-md" id="description"><?= $detail ?></p>
        <div class="hidden px-16 py-12" id="comment">

            <?php


            $today = gmdate('Y-m-d');
            $first_date = strtotime($today);


            foreach ($user_feedbacks as $fb) :
                $second_date = strtotime($fb['time_send']);
                $datediff = abs($first_date - $second_date);
                $count_date = floor($datediff / (24 * 60 * 60));
            ?>

                <div class="grid grid-cols-[48px,auto] gap-8">
                    <div class="rounded-full rounded-2 rounded-red-500 w-[48px] h-[48px]">
                        <img src="<?= $CONTENT_URL ?>/images/users/<?= $fb['img_user'] ?>" style="border-radius:50%" alt="">
                    </div>
                    <div class="">
                        <div class="flex items-center space-x-4">
                            <h1 class="font-bold text-md"><?= $fb['name_user'] ?></h1>
                            <p class="text-gray-400 text-md">
                                <?= $count_date < 30 ? $count_date . ' ngày' : floor($count_date / 30) . ' tháng' ?> trước
                            </p>
                        </div>
                        <div class="text-yellow-500">

                            <?php
                            if ($fb['rate'] == 1) {
                                echo '★';
                            } else if ($fb['rate'] == 2) {
                                echo '★★';
                            } else if ($fb['rate'] == 3) {
                                echo '★★★';
                            } else if ($fb['rate'] == 4) {
                                echo '★★★★';
                            } else if ($fb['rate'] == 5) {
                                echo '★★★★★';
                            }

                            ?>

                        </div>
                        <div class="text-md"><?= $fb['content'] ?></div>
                    </div>
                </div>

            <?php endforeach; ?>

            <form action="index.php?feedback" method="post" enctype="multipart/form-data">
                <input type="hidden" id="product_id" name="product_id" value="<?= $product_id ?>">
                <?php
                if (isset($_SESSION['user'])) { ?>

                    <input type="hidden" id="user_id" name="user_id" value="<?= $_SESSION['user']['user_id'] ?>">
                <?php
                }
                ?>

                <div class=" grid grid-cols-[100px,auto]  mt-10">
                    <div class="rounded-full flex items-center gap-5 rounded-2 rounded-red-500 w-[100px] h-[48px]">
                        <img src="<?= $CONTENT_URL . '/images/users/' ?><?= isset($_SESSION['user']) ? $_SESSION['user']['image'] : 'user.png' ?>" alt="" class="rounded-full w-[48px] h-[48px]">
                        <span class="text-gray-500 whitespace-nowrap">
                            <?= isset($_SESSION['user']) ? $_SESSION['user']['name'] : 'Đăng nhập để bình luận' ?>
                        </span>
                    </div>
                    <div class="mt-5 space-y-2">
                        <div class="flex flex-col items-center py-4 space-x-4 lg:flex-row">
                            <fieldset class="rating">
                                <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                                <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                            </fieldset>
                            <p class="text-sm text-gray-500">(Vui lòng chọn đánh giá)</p>
                        </div>
                        <textarea id="note" name="note" placeholder="Điền đánh giá ...." class="md:w-[612px] md:h-[97px] border-2 rounded px-4 py-1"></textarea>
                        <br>
                        <?php
                        if (isset($_SESSION['error'])) {
                            $err = $_SESSION['error'];
                            echo "<h5 class='text-red-500'>$err</h5>";
                        }
                        ?>
                        <button type="submit" class="px-10 py-2 text-white bg-orange-500 rounded">Gửi</button>
                    </div>
                </div>

            </form>
        </div>
    </section>

    </section>
    <section class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-center text-orange-500">Có thể bạn cũng thích</h1>
        <div class="grid grid-cols-2 gap-4 py-4 md:grid-cols-4">
            <?php
            require_once '/xampp/htdocs/polyfood/site/food/product/products_cate.php';
            ?>
        </div>

    </section>
    </main>
    <footer class="pt-24 mx-auto text-gray-700">
        <section class="grid w-full grid-cols-2 gap-4 px-8 md:grid-cols-3 lg:grid-cols-4 md:px-14 lg:px-20">
            <div class="ml-5 footer__item-logo">
                <img class="h-16" src="../IMG/logo.png" alt="logo" />
                <p class="footer-item-title--desc mt-4 text-gray-500 text-sm max-w-[220px]">
                    Website được phát triển bởi đội ngũ sinh viên FPT Polytechnic.
                </p>
            </div>
            <div class="mb-5 ml-5 footer__item">
                <h1 class="block mb-3 text-xl font-bold footer__item-title">
                    Liên hệ
                </h1>
                <ul class="mt-3 footer__item-list">
                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                            Giới thiệu
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                            Góp ý
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                            Tuyển dụng
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                            Điều khoản
                        </a>
                    </li>
                </ul>
            </div>
            <div class="mb-5 ml-5 footer__item">
                <h1 class="block mb-3 text-xl font-bold footer__item-title">
                    Hỗ trợ
                </h1>
                <ul class="mt-3 footer__item-list">
                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                            Hướng dẫn mua hàng
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                            Hướng dẫn thanh toán
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                            Khiếu nại
                        </a>
                    </li>

                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                            FAQs
                        </a>
                    </li>
                </ul>
            </div>

            <div class="mb-5 ml-5 footer__item">
                <h1 class="block mb-3 text-xl font-bold footer__item-title">
                    ĐỊA CHỈ
                </h1>
                <ul class="mt-3 footer__item-list">
                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                            Tòa nhà FPT Polytechnic, P. Trịnh Văn Bô, Xuân Phương, Nam Từ
                            Liêm, Hà Nội, Việt Nam
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                            https://caodang.fpt.edu.vn/
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                            098.172.5836
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="block mb-3 text-sm text-gray-500 footer__item-list-item-link">
                        </a>
                    </li>
                </ul>
            </div>
        </section>

        <div class="border-t border-gray-200">
            <div class="container flex flex-wrap items-center px-5 py-8 mx-auto">
                <div>
                    <div class="container flex flex-col items-center justify-center px-5 py-4 mx-auto sm:flex-row">
                        <p class="text-sm text-center text-gray-500 sm:text-left">
                            © 2022 polyfood —
                            <a href="#" class="ml-1 text-gray-600" target="_blank" rel="noopener noreferrer">@fptpolytechnic</a>
                        </p>
                    </div>
                </div>
                <span class="inline-flex justify-center w-full mt-6 lg:ml-auto lg:mt-0 md:justify-start md:w-auto">
                    <a class="text-gray-500">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-gray-500">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                            </path>
                        </svg>
                    </a>
                    <a class="ml-3 text-gray-500">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-gray-500">
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                            </path>
                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                        </svg>
                    </a>
                </span>
            </div>
        </div>
    </footer>
    <a style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37)" id="cart" href="<?= $SITE_URL ?>/cart/index.php?my-cart.php" class="fixed right-0 z-50 flex items-center justify-center w-16 h-16 mb-8 mr-8 text-gray-800 bg-orange-600 border border-gray-300 rounded-full shadow-sm sm:w-20 sm:h-20 animate-bounce bottom-8" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white w-9 h-9">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
        </svg>
    </a>
    <nav style="
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(2.5px);
        -webkit-backdrop-filter: blur(2.5px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.18);
      " class="fixed bottom-0 left-0 right-0 z-40 p-3 text-gray-400 menu__mobile lg:hidden">
        <ul class="flex items-center justify-center gap-6 sm:gap-8">
            <li>
                <a href="<?= $SITE_URL ?>/page/index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 sm:w-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="<?= $SITE_URL ?>/page/introduce.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 sm:w-11">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="<?= $SITE_URL ?>/page/product.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 sm:w-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="<?= $SITE_URL ?>/post/index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 sm:w-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 sm:w-11">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
            </li>
        </ul>
    </nav>
</body>

</div>
</div>

<script src="../../css/ha.js"></script>

</body>

</html>