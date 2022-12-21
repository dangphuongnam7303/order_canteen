<?php
require_once '/xampp/htdocs/polyfood/global.php';
require_once '/xampp/htdocs/polyfood/site/layout/header.php';
require_once '/xampp/htdocs/polyfood/site/layout/menu.php';
require_once '/xampp/htdocs/polyfood/dao/orders.php';
require_once '/xampp/htdocs/polyfood/dao/users.php';
require_once '/xampp/htdocs/polyfood/dao/products.php';
check_login();
extract($_REQUEST);
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['user_id'];
    $user = select_by_id_users($user_id);
    extract($user);
}
$order = order_select_by_user_id($user_id);
extract($order);


?>
<div class="container mx-auto mt-10">
  <main class="w-full px-8 mt-14 md:px-14 lg:px-24">
    <div
      style="
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.23);
        backdrop-filter: blur(0px);
        -webkit-backdrop-filter: blur(0px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.18);
      "
      id="countdown__next__page"
      class="p-5 mx-auto text-center rounded-lg w-fit"
    >
      <h1 class="text-xl font-semibold text-center text-gray-700">
        Đặt hàng thành công !
      </h1>
      <p class="mt-2 text-center text-gray-500">
        Bạn sẽ được chuyển đến đơn hàng của tôi sau
        <span id="countdown__next__page__time" class="font-bold text-indigo-500"
          >5</span
        >
        giây
      </p>
    </div>
    <script>
      let time = 5
      const countdown = setInterval(() => {
        if (time > 0) {
          time--
          document.getElementById('countdown__next__page__time').innerHTML =
            time
        } else {
          clearInterval(countdown)
        }
      }, 1000)
      //Chuyển trang sau 5s
      setTimeout(() => {
        window.location.href = './my-order.php'
      }, 5000)
    </script>

    <img
      class="w-full h-auto"
      src="https://www.revechat.com/wp-content/uploads/2022/06/image_2022_06_09T10_44_05_419Z.png"
      alt=""
    />
    <div
      class="flex flex-col justify-between px-5 order__info sm:flex-row-reverse lg:px-20"
    >
      <div class="mt-5 order__info__title">
        <p class="mt-2 text-sm text-gray-500">
          Ngày đặt :
          <?= //hiển thị ngày hiện tại
                    gmdate('d-m-Y');
                    ?>
        </p>
      </div>
      <div class="mt-5 order__info__address">
        <h1 class="text-lg font-bold text-gray-700 sm:text-2xl">
          Thông tin người nhận
        </h1>
        <p class="mt-1 text-lg text-gray-500">
          <?= $name ?>
        </p>
        <p class="mt-2 text-sm text-gray-500">
          <?= $phone ?>
        </p>
      </div>
    </div>

    <div class="my-5 order__products lg:px-20"></div>

    <div
      class="flex flex-col justify-between w-full gap-5 px-5 mt-5 payment__method-total__price sm:flex-row lg:px-20"
    >
      <div
        class="flex flex-col justify-between sm:flex-row payment__method sm:gap-5"
      >
        <h1 class="text-base font-bold text-gray-700 sm:text-lg">Ghi chú :</h1>
        <p class="text-gray-500">
          <?php if ($note != "") {
                        echo $note;
                    } else {
                        echo "Không có ghi chú";
                    } ?>
        </p>
      </div>

      <div
        class="flex flex-col justify-between sm:flex-row payment__method sm:gap-5"
      >
        <h1 class="text-lg font-bold text-gray-700">Tổng thanh toán :</h1>
        <p class="text-lg text-orange-500">
          <?= number_format($total_price) ?>đ
        </p>
      </div>
    </div>

    <div class="flex w-full my-10 cancel-oder sm:justify-end">
      <a
        href="index.php?action=index.php"
        class="hidden mt-5 text-sm font-semibold text-indigo-600 lg:flex"
      >
        <svg
          class="w-4 mr-2 text-indigo-600 fill-current"
          viewBox="0 0 448 512"
        >
          <path
            d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"
          />
        </svg>
        Tiếp tục đặt hàng
      </a>
    </div>
  </main>
</div>
<?php
unset($_SESSION['my_cart']);
require_once '/xampp/htdocs/polyfood/site/layout/footer.php';
?>
