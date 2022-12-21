<article class="w-[85%]">
    <header style="border-radius: 10px; background: #fff; box-shadow: 35px 35px 70px #bebebe,
-35px -35px 70px #ffffff;
" class="w-full h-[60px] flex items-center justify-between px-5 py-2">
        <div class="logo-[100px] h-auto px-2 flex gap-2 items-center justify-center">
            <a href="../../index.php">
                <img src="../../site/IMG/logo.png" alt="logo" class="w-16 h-auto" />
            </a>

        </div>
        <div class="account__admin flex items-center gap-2">
            <div class="account__admin--avatar">

                <img src="<?= $CONTENT_URL  ?>/images/users/<?= $_SESSION['user']['image'] ?>" alt=""
                    class="w-10 h-10 rounded-full" />
            </div>
            <div class="account__admin--name flex flex-col gap-1">
                <p class="font-medium text-sm text-gray-500">
                    <?= $_SESSION['user']['name'] ?>
                </p>
                <a href="index.php?action=logout" class="logout text-xs text-gray-500 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    Logout
                </a>
            </div>
        </div>
    </header>
    <!-- End header -->
    <main style="border-radius: 10px; background: #fff; box-shadow: 35px 35px 70px
#bebebe, -35px -35px 70px #ffffff; " class="w-full  p-5 mt-5 bg-gray-100">
        <section class="list__accounts w-full">
            <section class="list__accounts-title  flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-10 h-10 text-gray-500">
                    <path fill-rule="evenodd"
                        d="M2.625 6.75a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0zm4.875 0A.75.75 0 018.25 6h12a.75.75 0 010 1.5h-12a.75.75 0 01-.75-.75zM2.625 12a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0zM7.5 12a.75.75 0 01.75-.75h12a.75.75 0 010 1.5h-12A.75.75 0 017.5 12zm-4.875 5.25a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0zm4.875 0a.75.75 0 01.75-.75h12a.75.75 0 010 1.5h-12a.75.75 0 01-.75-.75z"
                        clip-rule="evenodd" />
                </svg>

                <h1 class="text-left text-xl text-gray-500 uppercase">
                    Chi tiết đơn hàng
                </h1>
            </section>
            <form action="index.php?user_id=<?= $user_id ?>" method="post">
                <h3 class="mt-5 text-sm text-gray-700 font-medium">Đơn hàng của :<span class="text-sm text-orange-500">
                        <?= $items[0]['name'] ?></span></h3>
                <div class="list__accounts-table w-full mt-4">
                    <table class="w-full text-center rounded-md shadow-md my-3">
                        <thead class="boder bg-gray-200 px-2 rounded-t-md">
                            <tr>
                                <th class=" text-xs  p-2  font-medium"></th>
                                <th class=" text-xs  p-2 whitespace-nowrap font-medium">
                                    Mã đơn hàng
                                </th>
                                <th class=" text-xs whitespace-nowrap p-2  font-medium">
                                    User Name
                                </th>
                                <th class=" text-xs whitespace-nowrap px-2 py-2 font-medium">
                                    Sản phẩm
                                </th>
                                <th class=" text-xs whitespace-nowrap px-2 py-2 font-medium">
                                    Hình ảnh
                                </th>
                                <th class=" text-xs whitespace-nowrap px-2 py-2 font-medium">
                                    Số lượng
                                </th>
                                <th class=" text-xs whitespace-nowrap  px-2 py-2 font-medium">
                                    Ngày đặt
                                </th>
                                <th class=" text-xs whitespace-nowrap px-2 py-2 font-medium">
                                    Ghi chú
                                </th>
                                <th class=" text-xs whitespace-nowrap px-2 py-2 font-medium">
                                    Trạng thái
                                </th>
                                <th class=" text-xs whitespace-nowrap px-2 py-2 font-medium">
                                    Tổng thanh toán
                                </th>
                                <th class=" text-xs whitespace-nowrap px-2 py-2 font-medium">
                                    Thao tác
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
              foreach ($items as $item) {
                extract($item);
              ?>
                            <tr class="border-b border-dashed">
                                <td class="p-2 whitespace-nowrap">
                                    <input type="checkbox" name="order_id[]" value="<?= $order_id ?>"
                                        class="checkbox" />
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <p class="text-xs text-gray-900">
                                        <?= $order_id ?>
                                    </p>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <p class="text-xs text-gray-900">
                                        <?= $user_name ?>
                                    </p>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <p class="text-xs text-gray-900">
                                        <?= $product_name ?>
                                    </p>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <p class="text-xs text-gray-900 flex justify-center">
                                        <img src="<?= $CONTENT_URL ?>/images/products/<?= $image ?>"
                                            class="w-14 h-14 object-cover rounded-lg" alt="">
                                    </p>
                                </td>
                                <td class="p-2 ">
                                    <p class="text-xs text-gray-900">
                                        <?= $quantity ?>
                                    </p>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <p class="text-xs text-gray-900">
                                        <?= $time_order ?>
                                    </p>
                                </td>
                                <td class="p-2 ">
                                    <p style="width:110px;" class="text-xs text-gray-900 limited__content-4">
                                        <?php if ($note == "") {
                        echo "Không có ghi chú";
                      } else {
                        echo $note;
                      } ?>
                                    </p>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <?php if ($status == 0) {
                      echo "<span class='text-xs text-yellow-500'>Đang làm</span>";
                    } else {
                      echo "<span class='text-xs text-green-500'>Đã xong</span>";
                    } ?>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <p class="text-xs text-gray-900">
                                        <?php $total = $price * $quantity * (1 - $discount / 100);
                      echo number_format($total, 0, ".", ".") . "đ"; ?>
                                    </p>
                                </td>
                                <td class="px-2 whitespace-nowrap">
                                    <div class="box__delete flex justify-center">
                                        <a href="index.php?btn_delete&order_id=<?= $order_id ?>&user_id=<?= $user_id ?>"
                                            class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6 text-indigo-600 hover:text-indigo-900">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>

                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="list__accounts-table--button w-full px-5 mt-7 flex justify-center gap-5">
                    <label for="checkAll" style="text-shadow: 0.6px 0.6px 0 #fff; color: #61677c; box-shadow:
1.5px 1.5px 2.5px #babecc, -2px -2px 5px #fff;" id="select"
                        class=" p-3  border  w-[120px] text-center rounded-md text-xs hover:bg-gray-200 leading-4 ">
                        Chọn tất cả
                    </label>
                    <label for="checkAll" style="text-shadow: 0.6px 0.6px 0 #fff; color: #61677c; box-shadow:
1.5px 1.5px 2.5px #babecc, -2px -2px 5px #fff;" id="unselect"
                        class=" p-3 whitespace-nowrap  border rounded-md w-[120px] text-center text-xs hover:bg-gray-200 leading-4 ">
                        Bỏ chọn tất cả
                    </label>

                    <button style="text-shadow: 0.6px 0.6px 0 #fff; color: #61677c; box-shadow:
1.5px 1.5px 2.5px #babecc, -2px -2px 5px #fff;" type="submit" name="btn_delete"
                        class=" p-3 whitespace-nowrap   border rounded-md w-[120px] text-center   text-xs hover:bg-gray-200 leading-4 ">
                        Xóa mục đã chọn
                    </button>
                    <button style="text-shadow: 0.6px 0.6px 0 #fff; color: #61677c; box-shadow:
1.5px 1.5px 2.5px #babecc, -2px -2px 5px #fff;" type="submit" name="btn_list"
                        class=" p-3 whitespace-nowrap  border rounded-md w-[120px] text-center   text-xs hover:bg-gray-200 leading-4 ">
                        Danh sách
                    </button>
                    <input type="checkbox" hidden id="checkAll" name="checkAll" />
                </div>
            </form>
        </section>
    </main>
</article>
</div>
</div>
</body>

</html>