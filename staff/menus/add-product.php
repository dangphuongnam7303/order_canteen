<?php
require_once '/xampp/htdocs/polyfood/global.php';
check_login();
extract($_REQUEST);
?>


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

        <img src="<?= $CONTENT_URL  ?>/images/users/<?= $_SESSION['user']['image'] ?>" alt="" class="w-10 h-10 rounded-full" />
      </div>
      <div class="account__admin--name flex flex-col gap-1">
        <p class="font-medium text-sm text-gray-500">
          <?= $_SESSION['user']['name'] ?>
        </p>
        <a href="index.php?action=logout" class="logout text-xs text-gray-500 flex items-center gap-1">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
          </svg>
          Logout
        </a>
      </div>
    </div>
  </header>
  <!-- End header -->
  <main style="border-radius: 10px; background: #fff; box-shadow: 35px 35px 70px
#bebebe, -35px -35px 70px #ffffff; " class="w-full  p-5 mt-5 bg-gray-100">
    <?php
    if (strlen($MESSAGE)) {
      echo "<h5>$MESSAGE</h5>";
    }
    ?>
    <?php
    if (isset($error['product_id'])) {
      echo "<script>alert('Đăng bài thành công!')</script>";
    }
    ?>
    <section class="add__category w-full mt-5">
      <section class="add__products-title flex  items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h1 class="text-left lg:text-xl text-gray-500">ADD CATEGORY</h1>
      </section>

      <section class="mt-5  w-full">
        <form action="index.php?menu_id=<?= $menu_id ?>" class="form__add-category w-full" method="post" enctype="multipart/form-data">
          <input name="keyword" style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37)" class="sm:w-64 w-40 bg-gray-100 rounded sm:mr-4 mr-2 border focus:outline-none focus:border-orange-600 text-base py-2 px-4" placeholder="Nhập tên món ăn..." type="text" />
          <button name="search_product" style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37)" class="inline-flex text-white bg-orange-600 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
            Tìm kiếm
          </button>
          <div class="list__form-group w-full grid  grid-cols-1 gap-10">
            <?php foreach ($items as $item) : extract($item); ?>

              <div class="form__group flex flex-col">

                <input type="checkbox" name="product_id[]" value="<?= $product_id ?>" class="checkbox" />
                <span><?= $product_name ?></span>
              </div>
            <?php endforeach; ?>

            <div class="form__add-category--list-button w-full mt-7 flex gap-3 justify-center items-center">
              <button type="submit" name="btn_add_product" style="text-shadow: 0.6px 0.6px 0 #fff; color: #61677c; box-shadow: 1.5px 1.5px
2.5px #babecc, -2px -2px 5px #fff;" class="p-2 border w-[120px] text-center
rounded-md text-sm hover:bg-gray-200 leading-4 ">
                Add new
              </button>
              <button type="reset" name="reset" style="text-shadow: 0.6px 0.6px 0 #fff; color: #61677c; box-shadow: 1.5px 1.5px
2.5px #babecc, -2px -2px 5px #fff;" class="p-2 border w-[120px] text-center
rounded-md text-sm hover:bg-gray-200 leading-4 ">
                Reset
              </button>
              <button type="submit" name="btn_list" style="text-shadow: 0.6px 0.6px 0 #fff; color: #61677c; box-shadow: 1.5px 1.5px
2.5px #babecc, -2px -2px 5px #fff;" class="p-2 border w-[120px] text-center
rounded-md text-sm hover:bg-gray-200 leading-4 ">
                List
              </button>
            </div>
          </div>
        </form>
      </section>
    </section>
    <!-- End add_product -->
  </main>
</article>
</div>
</div>
</body>

</html>