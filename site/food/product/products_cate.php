<?php
require_once '/xampp/htdocs/polyfood/dao/products.php';
extract($_REQUEST);
$items = products_select_by_categories($category_id);
foreach ($items as $item) {
    extract($item);
?>
    <form action="<?= $SITE_URL ?>/cart/index.php?btn_order" method="post">
        <input type="hidden" value="<?= $product_id ?>" id="product_id" name="product_id">
        <input type="hidden" value="<?= $image ?>" value="image" id="image" name="image">
        <input type="hidden" value="<?= $price ?>" value="price" id="price" name="price">

        <div class="p-4 shadow__products  rounded-2xl bg-white space-y-2">
            <a href="<?= $SITE_URL ?>/page/detail.php?product_id=<?= $product_id ?>"><img class="block mx-auto min-w-[150px] h-[150px] lg:h-[180px] object-cover object-contain" src="<?= $CONTENT_URL ?>/images/products/<?= $image ?>" alt=""> </a>
            <h2 class=" space-y-2"><?= $product_name ?></h2>
            <p class="text-xs font-semibold flex justify-between  text-red-500 mt-2">
                <span class="text-sm text-red-600">★★★★★</span><?= number_format($price * (1 - $discount / 100), 0, '', '.') ?>đ
            </p>
            <p class="leading-relaxed text-xs limited__content-2 h-10">
                <?= $detail ?>
            </p>
            <button class="btn__add w-full bg-orange-600 text-white px-2 py-2 rounded">
                Thêm vào giỏ

            </button>
        </div>
    </form>
<?php
}
?>
