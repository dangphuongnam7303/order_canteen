<?php
require_once '/xampp/htdocs/polyfood/global.php';
require_once '/xampp/htdocs/polyfood/site/layout/header.php';
require_once '/xampp/htdocs/polyfood/site/layout/menu.php';
require_once '/xampp/htdocs/polyfood/dao/users.php';
$items = $_SESSION['my_cart'];
$total_price_all = 0;
if (isset($_SESSION['my_cart'])) {
  foreach ($items as $item) {
    extract($item);
    $total_price_all += $total_price;
  }
}

if (isset($_SESSION['user'])) {
  $user_id = $_SESSION['user']['user_id'];
  $user = select_by_id_users($user_id);
  extract($user);
}
?>
<main class="w-full px-8 mt-10 sm:px-24 md:px-32 lg:px-36 font-montserrat">
  <div class="flex items-center w-full gap-5 mb-5 header__checkout">
    <h1 class="flex items-center w-full gap-3 text-3xl font-semibold text-indigo-500 ">
      <span>Thanh toán</span>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-indigo-500">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
      </svg>
    </h1>
  </div>

  <form action="index.php?order" method="post" class="flex flex-col gap-3 mx-auto ">
    <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
    <h2 class="flex items-center gap-2 text-xl text-orange-500">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-orange-700">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
      </svg>
      Thông tin người nhận
    </h2>

    <div class="flex flex-col gap-3 delivery__address">
      <div class="flex flex-col gap-2 form__group">
        <label for="fullname">Họ và tên</label>
        <input style="background: rgba( 255, 255, 255, 0.25 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.23);
backdrop-filter: blur( 0px );
-webkit-backdrop-filter: blur( 0px );
border-radius: 10px;
border: 1px solid rgba( 255, 255, 255, 0.18 );" type="text" name="fullname" id="fullname" class="w-full p-3 text-sm form__input focus:outline-none" placeholder="Nhập họ và tên" value="<?= isset($_SESSION['user']) ? $name : '' ?>" />
      </div>

      <div class="flex flex-col gap-2 form__group">
        <label for="phone">Số điện thoại</label>
        <input style="background: rgba( 255, 255, 255, 0.25 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.23);
backdrop-filter: blur( 0px );
-webkit-backdrop-filter: blur( 0px );
border-radius: 10px;
border: 1px solid rgba( 255, 255, 255, 0.18 );" type="number" name="phone" id="phone" class="w-full p-3 text-sm form__input focus:outline-none" placeholder="Nhập số điện thoại" value="<?= isset($_SESSION['user']) ? $phone : '' ?>" />
      </div>

      <div class="flex flex-col gap-2 form__group">
        <label for="email">Email</label>
        <input style="background: rgba( 255, 255, 255, 0.25 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.23);
backdrop-filter: blur( 0px );
-webkit-backdrop-filter: blur( 0px );
border-radius: 10px;
border: 1px solid rgba( 255, 255, 255, 0.18 );" type="email" name="email" id="email" class="w-full p-3 text-sm form__input focus:outline-none" placeholder="Nhập email" value="<?= isset($_SESSION['user']) ? $email : '' ?>" />
      </div>
    </div>


    <h2 class="flex items-center gap-2 mt-4 text-xl text-orange-500">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-orange-700">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
      </svg>
      Phương thức thanh toán
    </h2>

    <div class="bg-white payment__method flex flex-wrap gap-4 p-5 border-[3px] rounded-lg border-dashed">
      <div class="form__group">
        <input type="radio" name="payment" value="1" checked />
        <label for="payment">Tiền mặt</label>
      </div>

      <div class="form__group">
        <input type="radio" name="payment" value="2" />
        <label for="payment">MOMO</label>
      </div>

      <div class="form__group">
        <input type="radio" name="payment" value="3" />
        <label for="payment">Chuyển khoản</label>
      </div>
    </div>

    <h2 class="flex items-center gap-2 mt-4 text-xl text-orange-500 product__checkout ">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-orange-700">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
      </svg>
      Sản phẩm đã chọn
    </h2>


    <div class="flex flex-wrap justify-center gap-5 list__products">
      <?php
      foreach ($_SESSION['my_cart'] as $item) {
      ?>
        <div style="
                  background: rgba(255, 255, 255, 0.25);
                  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.23);
                  backdrop-filter: blur(4px);
                  -webkit-backdrop-filter: blur(4px);
                  border-radius: 10px;
                  border: 1px solid rgba(255, 255, 255, 0.18);
                " class="product__checkout w-[310px] flex gap-5 p-2 ">
          <div class="bg-white rounded product__img">
            <img style="width:96px; height: 96px;" src=" <?= $CONTENT_URL ?>/images/products/<?= $item['image'] ?>" alt="" class="object-cover rounded-md " />
          </div>
          <div class="flex flex-col justify-between product__name">
            <h3 class="font-medium">
              <?= $item['product_name'] ?>
            </h3>
            <p class="text-sm text-gray-500">
              Số lượng :
              <span class="text-orange-500">
                <?= $item['quantity'] ?>
              </span>
            </p>
            <p class="text-sm text-gray-500">
              Đơn giá :
              <span class="text-orange-500"> <?= number_format($item['price'], 0, ",", ".") ?> đ</span>
            </p>
            <p class="text-sm text-gray-500">
              Thành tiền :
              <span class="text-orange-500">
                <?= number_format($item['price'] * $item['quantity'], 0, ",", ".") ?> đ
              </span>
            </p>
          </div>
        </div>
      <?php
      }
      ?>
    </div>

    <a href="index.php?action=index.php" class="flex text-sm font-semibold text-indigo-600">
      <svg class="w-4 mr-2 text-indigo-600 fill-current" viewBox="0 0 448 512">
        <path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
      </svg>
      Tiếp tục mua hàng
    </a>
    <!-- End product checkout -->
    <div class="total__price--note flex flex-col  gap-3 p-2  border-[3px] rounded-lg border-dashed bg-white">
      <div class="flex flex-col gap-2 form__group sm:mt-2">
        <label for="note">Ghi chú</label>
        <textarea style="background: rgba( 255, 255, 255, 0.25 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.23);
backdrop-filter: blur( 0px );
-webkit-backdrop-filter: blur( 0px );
border-radius: 10px;
border: 1px solid rgba( 255, 255, 255, 0.18 );" name="note" id="note" class="w-full p-3 text-sm border border-gray-700 rounded-sm form__input focus:border-orange-500 focus:outline-none" placeholder="Enter your note"></textarea>
      </div>
    </div>
    <div class="flex items-center justify-between gap-4 total__price sm:mt-4">
      <h3 class="text-xl font-semibold text-gray-700">Tổng thanh toán</h3>
      <h3 class="text-xl font-semibold text-orange-500">
        <?= number_format($total_price_all, 0, ",", ".") ?> đ
      </h3>
    </div>
    <div class="flex flex-col items-center justify-between w-full gap-3 mt-3 mb-10 form__group--oder sm:flex-row lg:mb-20">
      <p class="text-sm text-gray-500">
        Nhấp vào "Đặt hàng" có nghĩa là bạn đồng ý tuân theo các điều khoản của
        <a class="text-red-500" href="#">
          polyfood
        </a>
      </p>
      <button style="box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37);" name="order" class="w-full p-3 text-white bg-orange-600 rounded-lg form__input--submit sm:w-1/4 focus:outline-none">
        Đặt hàng
      </button>
    </div>
    </div>
  </form>
</main>
<?php
require_once '/xampp/htdocs/polyfood/site/layout/footer.php';
?>