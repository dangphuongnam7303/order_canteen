<?php
require_once "/xampp/htdocs/polyfood/site/layout/header.php";
require_once "/xampp/htdocs/polyfood/site/layout/menu.php";
require_once "/xampp/htdocs/polyfood/global.php";
$total_price = 0;
$count = 0;
products_select_all();
foreach ($_SESSION['my_cart'] as $cart) {
    $total_price += $cart['total_price'];
    $count += 1;
}
?>
<div class="container flex flex-col justify-center px-5 mx-auto mt-10 lg:px-20">
    <div class="flex flex-col gap-1 my__cart-title sm:flex-row sm:justify-between">
        <h1 class="text-xl font-semibold md:text-2xl lg:text-3xl">
            Giỏ hàng của bạn
        </h1>
        <p class="text-gray-500">Có <?= $count ?> sản phẩm trong giỏ hàng</p>
    </div>
    <div class="flex flex-col gap-5 my-6 cart__info md:flex-row lg:gap-6">
        <div style="
              background: rgba(255, 255, 255, 0.25);
              box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
              backdrop-filter: blur(4px);
              -webkit-backdrop-filter: blur(4px);
              border-radius: 10px;
              border: 1px solid rgba(255, 255, 255, 0.18);
            " class="list__products flex flex-col gap-4 w-full  h-fit sm:w-[60%] p-3 md:p-5">
            <!-- --------------------------Đổ sản phẩm ra từ đây----------------------------- -->
            <!-- ------------------------1 products__item là 1 sp--------------------------- -->
            <?php if ($count > 0) { ?>
            <?php
                foreach ($_SESSION['my_cart'] as $item) {
                ?>
            <div
                class="product__item  flex justify-between items-center rounded-lg border-[3px] border-dashed p-3 relative">
                <div class="flex gap-2 sm:gap-5">
                    <div class="flex product__img ">
                        <img style="width:100px; height:100px;" class="rounded-lg  object-cover object-center"
                            src="<?= $CONTENT_URL ?>/images/products/<?= $item['image'] ?>" alt="" />
                    </div>
                    <div class="flex flex-col justify-between px-2 product__info">
                        <h3 class="text-sm font-semibold sm:text-base whitespace-nowrap">
                            <?= $item['product_name'] ?>
                        </h3>
                        <p class="text-xs text-gray-500 sm:text-sm whitespace-nowrap">
                            Đơn giá: <?= number_format($item['price'], 0, ",", ".") ?>đ
                        </p>
                        <form action="index.php?btn_re_quantity" method="POST">
                            <div class="flex">
                                <button style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37)" name="choose" value="0"
                                    class="bg-white rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                    </svg>
                                </button>

                                <input id="quantity" name="quantity"
                                    class="w-10 mx-2 text-xs text-center border rounded-md sm:text-sm" type="text"
                                    value="<?= $item['quantity'] ?>" />
                                <input type="hidden" id="product_id" name="product_id"
                                    value="<?= $item['product_id'] ?>" />
                                <button style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37)" name="choose" value="1"
                                    class="bg-white rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                        <p class="text-xs text-gray-500 sm:text-sm whitespace-nowrap">
                            Thành tiền : <?= number_format($item['price'] * $item['quantity'], 0, ",", ".") ?>đ
                        </p>
                    </div>
                </div>
                <form class="absolute top-0 right-0 product__delete sm:p-2">
                    <button type="submit" name="btn_delete" class="btn__delete__cart">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </form>
            </div>
            <?php } ?>
            <?php } else { ?>
            <div class="flex flex-col items-center justify-center">
                <img style="width:200; height:200;" src="../IMG/empty-cart.png" alt="">
                <h3 class="text-xl font-semibold">Giỏ hàng của bạn trống</h3>
                <a href="<?= $SITE_URL ?>/page/product.php" class="flex mt-5 text-sm font-semibold text-indigo-600">
                    <svg class="w-4 mr-2 text-indigo-600 fill-current" viewBox="0 0 448 512">
                        <path
                            d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                    </svg>
                    Tiếp tục mua hàng
                </a>
            </div>
            <?php   } ?>

        </div>

        <div style="
              background: rgba(255, 255, 255, 0.25);
              box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
              backdrop-filter: blur(4px);
              -webkit-backdrop-filter: blur(4px);
              border-radius: 10px;
              border: 1px solid rgba(255, 255, 255, 0.18);
            " class="cart__checkout w-full h-fit sm:w-[40%] flex flex-col gap-3 p-5">
            <h1 class="text-xl font-semibold cart__checkout-title">
                Thông tin đơn hàng
            </h1>

            <div class="flex flex-col gap-5 cart__checkout-info">
                <?php if ($count > 0) { ?>
                <?php
                    foreach ($_SESSION['my_cart'] as $item) {
                    ?>
                <div class="cart__checkout-item flex justify-between border-b-[2px] border-dashed py-3">
                    <p class="text-gray-500"> <?= $item['product_name'] ?></p>
                    <p class="text-gray-500">x <?= $item['quantity'] ?></p>
                    <p class="text-gray-500">
                        <?= number_format($item['price'], 0, ",", ".") ?>đ
                    </p>
                </div>
                <?php } ?>
                <?php } else {
                    echo "<p class='text-center text-gray-500'>Không có thông tin !</p>";
                } ?>
                <div class="flex justify-between font-semibold cart__checkout-item">
                    <p class="text-indigo-500">Tổng cộng</p>
                    <p class="text-indigo-500">
                        <?= number_format($total_price, 0, ",", ".") ?>đ
                    </p>
                </div>

            </div>
            <form action="index.php?btn_checkout" method="post">
                <button style="
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                border: 1px solid rgba(255, 255, 255, 0.18);
              " class="w-full py-3 text-sm font-semibold text-white uppercase bg-indigo-500 rounded-lg hover:bg-indigo-600">
                    Thanh toán
                </button>
            </form>
        </div>
    </div>
    <?php if ($count > 0) { ?>
    <a href="<?= $SITE_URL ?>/page/product.php" class="flex mt-10 text-sm font-semibold text-indigo-600">
        <svg class="w-4 mr-2 text-indigo-600 fill-current" viewBox="0 0 448 512">
            <path
                d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
        </svg>
        Tiếp tục mua hàng
    </a>
    <?php } ?>
</div>
<?php
require_once '/xampp/htdocs/polyfood/site/layout/footer.php';
?>