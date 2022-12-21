<div class="mt-5 mb-3 title__list-order">
    <h1 class="text-3xl font-bold text-center text-gray-700">
        Danh sách đơn hàng
    </h1>
</div>
<main style="border-radius: 10px; background: #fff; " class="w-full px-20 bg-gray-100">

    <!-- Đặt vòng for từ đây -->
    <!-- Khối chứa thông tin sản phẩm -->
    <?php foreach ($items as $item) : ?>
    <?php extract($item); ?>
    <div class="flex flex-col items-center justify-center gap-3 list__product__orded">
        <form class="all__my__cart" action="index.php?order_id=<?= $order_id ?>" method="post">
            <div class="flex sm:flex-row flex-col my-5 gap-3 p-4 border-b-[3px]">
                <div
                    class="list__product__orded-item overflow-y-scroll flex justify-center items-center  w-full gap-5 p-5 rounded-lg border-[3px] border-dashed">
                    <!-- 1 sản phẩm -->
                    <div style="
    background: rgba(255, 255, 255, 0.8);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    backdrop-filter: blur(2.5px);
    -webkit-backdrop-filter: blur(2.5px);
    border-radius: 15px;
    border: 1px solid rgba(255, 255, 255, 0.18);
  " class="list__product__orded__item__product min-w-[305px]  p-2  max-h-[115px] flex gap-5">
                        <div class="product__img">
                            <img style="width:96px; height:96px;" class="object-cover object-center rounded-lg w-"
                                src="<?= $CONTENT_URL ?>/images/products/<?= $image ?>" alt="" />
                        </div>
                        <div class="flex flex-col gap-1 product__info">
                            <h1 class="text-xl font-medium text-gray-700"><?= $product_name ?></h1>
                            <p class="text-xs text-gray-500">Số lượng : <?= $quantity ?></p>
                            <p class="text-xs text-gray-500">Đơn giá :
                                <?= number_format($price * (1 - $discount / 100), 0, '', '.') ?>đ</p>

                            <p class="text-xs text-gray-500">Ngày đặt :
                                <?php
                                    $date = date_create($time_order);
                                    echo date_format($date, 'd/m/Y');
                                    ?>
                            </p>
                            </p>
                        </div>
                    </div>


                </div>
                <!-- Khối chứa thông tin khách hàng -->
                <div class="list__porduct__orded__item__user  rounded-lg p-5 border-[3px] border-dashed">
                    <div class="flex gap-5 list__porduct__orded__item__user__info">
                        <div class="user__info flex flex-col gap-1">
                            <h1 style="width:210px;" class="text-xl font-medium whitespace-nowrap text-gray-700 ">
                                Thông tin người nhận
                            </h1>
                            <p class="text-sm font-medium text-gray-600 whitespace-nowrap">
                                Họ tên : <span class="font-normal whitespace-nowrap"><?= $name ?></span>
                            </p>
                            <p class="text-sm font-medium text-gray-600 whitespace-nowrap">
                                Mã đơn hàng : <span class="text-orange-500">#<?= $order_id ?></span>
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col list__porduct__orded__item__user__status">
                        <div class="flex items-center gap-1 user__status">
                            <h1 class="text-sm font-medium text-gray-600 whitespace-nowrap">Trạng thái : </h1>
                            <p class="text-xs text-yellow-500"><?= $status == 1 ? "Đã xong" : "Đang xử lý"; ?></p>
                        </div>
                        <p class="text-sm text-gray-600 break-normal">
                            <span class="font-medium">Ghi chú : </span> <?= $note ?>
                        </p>
                        <div class="flex items-center gap-1 user__status">

                            <h1 class="text-sm font-medium text-gray-600 whitespace-nowrap">Tổng tiền : </h1>
                            <p class="text-sm text-orange-500">
                                <?= number_format($price * (1 - $discount / 100) * $quantity, 0, '', '.') ?>đ</p>
                        </div>
                    </div>
                    <!-- 2 nút xác nhận và hủy -->
                    <div class="flex items-center justify-center gap-2 mt-2 list__porduct__orded__item__user-check">
                        <button type="submit" name="btn_confirm"
                            class="px-3 py-2 text-sm font-semibold text-white bg-green-500 rounded-lg whitespace-nowrap">
                            Xác nhận
                        </button>
                        <button style="background-color:red;" type="submit" name="btn_cancel"
                            class="px-3 py-2 text-sm font-semibold text-white  rounded-lg">
                            Hủy
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <hr>


    </div>
    <?php endforeach; ?>

</main>