<section id="order__step" class="text-gray-700 border-t border-gray-200">
    <div class="container px-5 py-8 lg:py-16 mx-auto">
        <div class="flex flex-col text-center w-full mb-20">
            <h2 class="text-sm text-orange-600 tracking-widest font-medium title-font mb-1">
                Làm thế nào tôi có thể đặt hàng?
            </h2>
            <h1 class="sm:text-4xl text-2xl font-medium title-font mt-2 text-gray-900">
                Các bước đặt hàng
            </h1>
        </div>
        <div class="flex flex-wrap -m-4 px-5 sm:px-3">
            <div class="p-4 md:w-1/3 relative">
                <div class="step">
                    <img class="w-16 absolute top-0 right-0 animate-bounce" src="../IMG/number-1.png" alt="" />
                </div>

                <div class="flex items-center rounded-lg h-full bg-gray-100 flex-col gap-5 p-5 sm:p-8">
                    <div class="flex-grow w-full">
                        <img class="w-[80%] block mx-auto" src="../IMG/online-order.png" alt="" />
                    </div>
                    <h2 class="text-gray-500 text-base md:text-lg title-font font-medium">
                        Chọn đồ ăn yêu thích của bạn
                    </h2>
                </div>
            </div>
            <div class="p-4 md:w-1/3 relative">
                <div class="step">
                    <img class="w-16 absolute top-0 right-0 animate-bounce" src="../IMG/number-2.png" alt="" />
                </div>

                <div class="flex items-center rounded-lg h-full bg-gray-100 flex-col gap-5 p-5 sm:p-8">
                    <div class="flex-grow w-full">
                        <img class="w-[80%] block mx-auto" src="../IMG/wait-time.png" alt="" />
                    </div>
                    <h2 class="text-gray-500 text-base md:text-lg title-font font-medium">
                        Chờ thông báo khi món ăn đã sẵn sàng
                    </h2>
                </div>
            </div>
            <div class="p-4 md:w-1/3 relative">
                <div class="step">
                    <img class="w-16 absolute top-0 right-0 animate-bounce" src="../IMG/number-3.png" alt="" />
                </div>

                <div class="flex items-center rounded-lg h-full bg-gray-100 flex-col gap-5 p-5 sm:p-8">
                    <div class="flex-grow w-full">
                        <img class="w-[80%] block mx-auto" src="../IMG/eat.png" alt="" />
                    </div>
                    <h2 class="text-gray-500 text-base md:text-lg title-font font-medium">
                        Thưởng thức món ăn !
                    </h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="category" class="text-gray-700 border-t border-gray-200">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                Danh mục
            </h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                Chúng ta có gì ?
            </p>
        </div>
        <div class="flex flex-wrap -m-2">
            <?php foreach ($cates as $cate) : ?>
            <?php extract($cate); ?>
            <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                <a href="<?= $SITE_URL ?>/page/product.php?category_id=<?= $category_id ?>">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 object-cover object-center flex-shrink-0 mr-4"
                            src="<?= $CONTENT_URL ?>/images/categories/<?= $category_image ?>" />
                        <div class="flex-grow">
                            <h2 class="text-gray-900 title-font font-medium"><?= $category_name ?></h2>
                            <p class="text-gray-500 text-xs">
                                <?= $suggest ?>
                            </p>
                        </div>
                    </div>
            </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="today__menu" class="text-gray-700 border-t border-gray-200">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">
                Thực đơn hôm nay
            </h1>
            <p class="lg:w-1/2 w-full leading-relaxed text-base text-orange-600 font-medium">
                " Ăn đã – chuyện khác để sau "
            </p>
        </div>
        <section id="list__products" class="flex space-x-4 overflow-y-scroll -m-4 px-10">
            <?php foreach ($items as $item) : ?>
            <?php extract($item); ?>
            <div class="product__item w-full   p-4">
                <div class="rounded-xl">
                    <a href="<?= $SITE_URL ?>/page/detail.php?product_id=<?= $product_id ?>">
                        <div class="product__img">
                            <img class="w-full object-cover object-center rounded-t-xl min-w-[200px] lg:min-w-[230px] h-[150px] lg:min-h-[170px] lg:max-h-[171px]"
                                src="<?= $CONTENT_URL ?>/images/products/<?= $image ?>" alt="content" />
                        </div>
                    </a>
                    <div class="product__info  flex flex-col gap-1 rounded-b-xl w-full p-3 border border-gray-300">
                        <a href="<?= $SITE_URL ?>/page/detail.php?product_id=<?= $product_id ?>">
                            <h2 class="text-gray-900 font-medium title-font"><?= $product_name ?></h2>
                            <p class="leading-relaxed text-xs limited__content-2 h-10">
                                <?= $detail ?>
                            </p>
                            <div class="product__cart-rate flex justify-between items-center my-1">
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
                                <span
                                    class="text-sm text-orange-600 font-medium"><?= number_format($price, 0, '', '.') ?>đ</span>
                            </div>
                        </a>
                        <form action="<?= $SITE_URL ?>/cart/index.php?btn_order" method="post">
                            <input type="hidden" value="<?= $product_id ?>" id="product_id" name="product_id">
                            <input type="hidden" id="image" name="image" value="<?= $image ?>">
                            <button
                                class="add-to-cart flex gap-2 sm:gap-3 items-center justify-center w-full px-4 py-2 text-xs font-medium text-white bg-orange-600 border border-transparent rounded-md hover:bg-indigo-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-orange-600">

                                <span> Thêm vào giỏ </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>

                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>
        </section>
    </div>
</section>