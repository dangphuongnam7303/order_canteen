<?php
require_once "/xampp/htdocs/polyfood/global.php";
require_once "../../dao/products.php";
require_once "../../dao/categories.php";
require_once '/xampp/htdocs/polyfood/dao/feedbacks.php';

extract($_REQUEST);
$cates = categories_select_all();
if (exist_param("category_id")) {
    $items = products_select_by_categories($category_id);
} else if (exist_param("search_product")) {
    $items = products_select_keyword($keyword);
} else {
    $items = products_select_all();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sản Phẩm</title>
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/base.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="../Javascript/main.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
</head>

<body class="font-montserrat">
    <header class="hidden lg:block text-gray-700 bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex font title-font font-medium items-center mb-4 md:mb-0" href="#" target="_blank">
                <span class="text-orange-600">poly</span><span class="text-blue-600 font-semibold">F</span><span
                    class="text-orange-600 font-semibold">oo</span><span class="text-green-600 font-semibold">d</span>
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <ul class="menu flex w-full justify-center gap-6 text-sm uppercase">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </div>
                            <div id="sub-menu-drop"
                                class="animate-down hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1" role="none">
                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                    <a href="<?= $SITE_URL ?>/account/update-account.php"
                                        class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                        id="menu-item-0">
                                        Cài đặt tài khoản
                                    </a>
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem"
                                        tabindex="-1" id="menu-item-1">
                                        Hỗ trợ
                                    </a>
                                    <a href="<?= $SITE_URL ?>/cart/all-my-cart.php<?php if (isset($_SESSION['user'])) echo "?user_id=" . $_SESSION['user']['user_id'] ?>"
                                        class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                        id="menu-item-2">
                                        Đơn hàng của tôi
                                    </a>
                                    <a href="<?= $SITE_URL ?>/account/change-password.php"
                                        class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                        id="menu-item-2">
                                        Đổi mật khẩu
                                    </a>
                                    <?php if (isset($_SESSION['user'])) { ?>

                                    <?php extract($_SESSION['user']); ?>

                                    <?php if ($role_id == 1) { ?>
                                    <a href="<?= $ADMIN_URL ?>/page/index.php"
                                        class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                        id="menu-item-2">
                                        Trang quản trị
                                    </a>
                                    <a href="<?= $STAFF_URL ?>/page/index.php"
                                        class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                        id="menu-item-2">
                                        Trang nhân viên
                                    </a>

                                    <?php  } else if ($role_id == 2) { ?>
                                    <a href="<?= $STAFF_URL ?>/page/index.php"
                                        class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                        id="menu-item-2">
                                        Trang nhân viên
                                    </a>
                                    <?php } ?>
                                    <?php } ?>
                                    <form method="POST" action="<?= $SITE_URL ?>/account/sign-in.php" role="none">
                                        <?php if (isset($_SESSION['user'])) {


                                            echo " <button type='submit' name='btn_logoff' class='text-gray-700 block w-full px-4 py-2 text-left text-sm uppercase' role='menuitem' tabindex='-1' id='menu-item-3'>
                                          
                                    Đăng xuất
                                 
                                 </button>";
                                        } else {


                                            echo " <button type='submit' class='text-gray-700 block w-full px-4 py-2 text-left text-sm uppercase' role='menuitem' tabindex='-1' id='menu-item-3'>
                                          
                                    Đăng nhập
                                 
                                 </button>";
                                        }
                                        ?>

                                    </form>
                                    <form action="<?= $SITE_URL ?>/account/forgot-password.php">
                                        <?php if (!isset($_SESSION['user'])) {
                                            echo " <button type='submit' class='text-gray-700 block w-full px-4 py-2 text-left text-sm uppercase' role='menuitem' tabindex='-1' id='menu-item-3'>
                                          
Quên mật khẩu</button>";
                                        } ?>

                                    </form>
                                    <form action="<?= $SITE_URL ?>/account/sign-up.php" method="post"
                                        enctype="multipart/form-data">
                                        <?php if (!isset($_SESSION['user'])) {
                                            echo " <button type='submit' class='text-gray-700 block w-full px-4 py-2 text-left text-sm uppercase' role='menuitem' tabindex='-1' id='menu-item-3'>
                                          
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


    <section class="max-w-7xl mx-auto px-10">
        <div class="grid md:grid-cols-[190px,auto] mt-10 p-4">
            <div class="hidden md:block">
                <h1 class="text-3xl text-orange-500 font-medium">Danh mục</h1>
                <div style="
              background: rgba(255, 255, 255, 0.25);
              box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.23);
              backdrop-filter: blur(4px);
              -webkit-backdrop-filter: blur(4px);
              border-radius: 10px;
              border: 1px solid rgba(255, 255, 255, 0.18);" class="mt-5 p-3 bg-white">
                    <ul class="space-y-4">
                        <a href="<?= $SITE_URL ?>/page/product.php">
                            <li class="rounded py-2 px-2 text-gray-700 font-medium">Tất cả </li>
                        </a>

                        <?php foreach ($cates as $cate) : ?>
                        <?php extract($cate) ?>
                        <a class="text-gray-700 font-medium"
                            href="<?= $SITE_URL ?>/page/product.php?category_id=<?= $category_id ?>">
                            <li class="rounded py-2 px-2 hover:bg-gray-200">
                                <?= $category_name ?>
                            </li>
                        </a>


                        <?php endforeach; ?>

                    </ul>
                </div>

            </div>


            <div class="px-4">
                <div class="">
                    <div class="products__title text-center">
                        <p class="text-3xl font-medium text-orange-500 mt-5 ">
                            " Ăn đã – chuyện khác để sau "
                        </p>
                    </div>

                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 py-4">

                    <?php foreach ($items as $item) : ?>
                    <?php extract($item); ?>
                    <div style="
              background: rgba(255, 255, 255, 0.25);
              box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.20);
              backdrop-filter: blur(4px);
              -webkit-backdrop-filter: blur(4px);
              border-radius: 10px;
              border: 1px solid rgba(255, 255, 255, 0.18);" class="p-4 min-w-[170px]  rounded-2xl space-y-2">
                        <a class="mt-2" href="<?= $SITE_URL ?>/page/detail.php?product_id=<?= $product_id ?>">
                            <img class="rounded-xl min-w-[150px] h-[150px] lg:h-[180px] block mx-auto object-cover object-center"
                                src="<?= $CONTENT_URL ?>/images/products/<?= $image ?>" alt="" class="rounded">
                            <h2 class="truncate mt-3 font-medium"><?= $product_name ?></h2>
                            <p class="text-sm font-semibold flex justify-between items-center  text-orange-600 mt-2">
                                <span class="text-xs"> <?php
                                                            $avg = avg_feedbacks($product_id);
                                                            if ($avg == 0) {
                                                                echo "<span class='font-medium text-gray-500'>Chưa có đánh giá</span>";
                                                            } else if ($avg <= 1) {
                                                                echo "<span class='text-yellow-500'>★</span>";
                                                            } else if ($avg <= 2) {
                                                                echo "<span class='text-yellow-500'>★★</span>";
                                                            } else if ($avg <= 3) {
                                                                echo "<span class='text-yellow-500'>★★★</span>";
                                                            } else if ($avg <= 4) {
                                                                echo "<span class='text-yellow-500'>★★★★</span>";
                                                            } else if ($avg <= 5) {
                                                                echo "<span class='text-yellow-500'>★★★★★</span>";
                                                            }

                                                            ?></span>
                                <?= number_format($price * (1 - $discount / 100), 0, '', '.') ?>đ
                            </p>
                            <p class="leading-relaxed text-gray-700 mt-1 text-xs limited__content-2 h-10">
                                <?= $detail ?>
                            </p>
                        </a>
                        <form action="<?= $SITE_URL ?>/cart/index.php?btn_order" method="post">
                            <input type="hidden" name="product_id" value="<?= $product_id ?>">
                            <input type="hidden" name="image" value="<?= $image ?>">
                            <button class="btn__add w-full bg-orange-600 text-white px-2 py-2 rounded">
                                Thêm vào giỏ
                            </button>
                        </form>


                    </div>


                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <div class="py-14">
            <div class="text-center">
                <div class="inline-flex rounded-xl border border-[#e4e4e4] bg-white p-4">
                    <ul class="-mx-[6px] flex items-center">
                        <li class="px-[6px]">
                            <a href="javascript:void(0)"
                                class="hover:bg-primary hover:border-primary flex h-9 w-9 items-center justify-center rounded-md border border-[#EDEFF1] text-xs text-[#838995] hover:text-white">
                                Đầu
                            </a>
                        </li>
                        <li class="px-[6px] ">
                            <a href="javascript:void(0)"
                                class="hover:bg-primary hover:border-primary flex h-9 w-9 items-center justify-center rounded-md border border-[#EDEFF1] text-base text-[#838995] hover:text-white">
                                <span>
                                    <svg width="8" height="15" viewBox="0 0 8 15" class="fill-current stroke-current">
                                        <path
                                            d="M7.12979 1.91389L7.1299 1.914L7.1344 1.90875C7.31476 1.69833 7.31528 1.36878 7.1047 1.15819C7.01062 1.06412 6.86296 1.00488 6.73613 1.00488C6.57736 1.00488 6.4537 1.07206 6.34569 1.18007L6.34564 1.18001L6.34229 1.18358L0.830207 7.06752C0.830152 7.06757 0.830098 7.06763 0.830043 7.06769C0.402311 7.52078 0.406126 8.26524 0.827473 8.73615L0.827439 8.73618L0.829982 8.73889L6.34248 14.6014L6.34243 14.6014L6.34569 14.6047C6.546 14.805 6.88221 14.8491 7.1047 14.6266C7.30447 14.4268 7.34883 14.0918 7.12833 13.8693L1.62078 8.01209C1.55579 7.93114 1.56859 7.82519 1.61408 7.7797L1.61413 7.77975L1.61729 7.77639L7.12979 1.91389Z"
                                            stroke-width="0.3"></path>
                                    </svg>
                                </span>
                            </a>
                        </li>

                        <li class="px-[6px]">
                            <a href="javascript:void(0)"
                                class="hover:bg-primary hover:border-primary flex h-9 w-9 items-center justify-center rounded-md border border-[#EDEFF1] text-base text-[#838995] hover:text-white">
                                <span>
                                    <svg width="8" height="15" viewBox="0 0 8 15" class="fill-current stroke-current">
                                        <path
                                            d="M0.870212 13.0861L0.870097 13.086L0.865602 13.0912C0.685237 13.3017 0.684716 13.6312 0.895299 13.8418C0.989374 13.9359 1.13704 13.9951 1.26387 13.9951C1.42264 13.9951 1.5463 13.9279 1.65431 13.8199L1.65436 13.82L1.65771 13.8164L7.16979 7.93248C7.16985 7.93243 7.1699 7.93237 7.16996 7.93231C7.59769 7.47923 7.59387 6.73477 7.17253 6.26385L7.17256 6.26382L7.17002 6.26111L1.65752 0.398611L1.65757 0.398563L1.65431 0.395299C1.454 0.194997 1.11779 0.150934 0.895299 0.373424C0.695526 0.573197 0.651169 0.908167 0.871667 1.13067L6.37922 6.98791C6.4442 7.06886 6.43141 7.17481 6.38592 7.2203L6.38587 7.22025L6.38271 7.22361L0.870212 13.0861Z"
                                            stroke-width="0.3"></path>
                                    </svg>
                                </span>
                            </a>
                        </li>
                        <li class="px-[6px]">
                            <a href="javascript:void(0)"
                                class="hover:bg-primary hover:border-primary flex h-9 w-9 items-center justify-center rounded-md border border-[#EDEFF1] text-xs text-[#838995] hover:text-white">
                                Cuối
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

    </section>

    <footer class="text-gray-700 pt-24 mx-auto">
        <section class="w-full grid gap-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 px-8 md:px-14 lg:px-20">
            <div class="footer__item-logo ml-5">
                <img class="h-16" src="../IMG/logo.png" alt="logo" />
                <p class="footer-item-title--desc mt-4 text-gray-500 text-sm max-w-[220px]">
                    Website được phát triển bởi đội ngũ sinh viên FPT Polytechnic.
                </p>
            </div>
            <div class="footer__item mb-5 ml-5">
                <h1 class="footer__item-title text-xl block mb-3 font-bold">
                    Liên hệ
                </h1>
                <ul class="footer__item-list mt-3">
                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                            Giới thiệu
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                            Góp ý
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                            Tuyển dụng
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                            Điều khoản
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer__item mb-5 ml-5">
                <h1 class="footer__item-title text-xl block mb-3 font-bold">
                    Hỗ trợ
                </h1>
                <ul class="footer__item-list mt-3">
                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                            Hướng dẫn mua hàng
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                            Hướng dẫn thanh toán
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                            Khiếu nại
                        </a>
                    </li>

                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                            FAQs
                        </a>
                    </li>
                </ul>
            </div>

            <div class="footer__item mb-5 ml-5">
                <h1 class="footer__item-title text-xl block mb-3 font-bold">
                    ĐỊA CHỈ
                </h1>
                <ul class="footer__item-list mt-3">
                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                            Tòa nhà FPT Polytechnic, P. Trịnh Văn Bô, Xuân Phương, Nam Từ
                            Liêm, Hà Nội, Việt Nam
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                            https://caodang.fpt.edu.vn/
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                            098.172.5836
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                        </a>
                    </li>
                    <li class="footer__item-list-item">
                        <a href="#" class="footer__item-list-item-link block mb-3 text-sm text-gray-500">
                        </a>
                    </li>
                </ul>
            </div>
        </section>

        <div class="border-t border-gray-200">
            <div class="container px-5 py-8 flex flex-wrap mx-auto items-center">
                <form class="search__form flex md:flex-no-wrap flex-wrap justify-center md:justify-start"
                    action="./product.php" method="post">
                    <input name="keyword" style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37)"
                        class="sm:w-64 w-40 bg-gray-100 rounded sm:mr-4 mr-2 border focus:outline-none focus:border-orange-600 text-base py-2 px-4"
                        placeholder="Nhập tên món ăn..." type="text" />
                    <button name="search_product" style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37)"
                        class="inline-flex text-white bg-orange-600 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
                        Tìm kiếm
                    </button>
                </form>
                <span class="inline-flex lg:ml-auto lg:mt-0 mt-6 w-full justify-center md:justify-start md:w-auto">
                    <a class="text-gray-500">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-gray-500">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-5 h-5" viewBox="0 0 24 24">
                            <path
                                d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                            </path>
                        </svg>
                    </a>
                    <a class="ml-3 text-gray-500">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-gray-500">
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                            <path stroke="none"
                                d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                            </path>
                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                        </svg>
                    </a>
                </span>
            </div>
        </div>
        <div class="bg-gray-200">
            <div class="container mx-auto py-4 px-5 flex justify-center items-center sm:flex-row flex-col">
                <p class="text-gray-500 text-sm text-center sm:text-left">
                    © 2022 polyfood —
                    <a href="#" class="text-gray-600 ml-1" target="_blank" rel="noopener noreferrer">@fptpolytechnic</a>
                </p>
            </div>
        </div>
    </footer>
    <a style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37)" id="cart" href="<?= $SITE_URL ?>/cart/index.php?my-cart.php"
        class="rounded-full w-16 h-16 sm:w-20 sm:h-20 bg-orange-600 animate-bounce fixed bottom-8 right-0 flex items-center z-50 justify-center text-gray-800 mr-8 mb-8 shadow-sm border-gray-300 border"
        target="_blank"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-9 h-9 text-white">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
        </svg>
    </a>
    <nav style="
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(2.5px);
        -webkit-backdrop-filter: blur(2.5px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.18);
      " class="menu__mobile lg:hidden fixed bottom-0 left-0 right-0 p-3 z-40 text-gray-400">
        <ul class="flex justify-center items-center gap-6 sm:gap-8">
            <li>
                <a href="<?= $SITE_URL ?>/layout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 sm:w-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="<?= $SITE_URL ?>/page/introduce.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 sm:w-11">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="<?= $SITE_URL ?>/page/product.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 sm:w-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="<?= $SITE_URL ?>/post/index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 sm:w-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 sm:w-11">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
            </li>
        </ul>
    </nav>
</body>

</html>