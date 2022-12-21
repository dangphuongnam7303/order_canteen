      <main class="w-full mt-14">
        <h1 class="text-3xl text-center mt-10 mb-10">Đăng ký</h1>
        <div class="form__login my-10 w-full flex justify-center mb-20">
          <form action="sign-up.php" method="post" enctype="multipart/form-data" class="form__login--content w-[300px] sm:w-[500px]  flex flex-col  gap-4">
            <?php
            if (strlen($MESSAGE)) {
              echo "<h5 class=''>$MESSAGE</h5>";
            }
            ?>
            <div class="form__group flex flex-col gap-2">
              <label for="user_name">Tên đăng nhập</label>
              <input type="text" name="user_name" id="username" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg
                  focus:border-orange-500 focus:outline-none" placeholder="Tên đăng nhập" value="<?= $user_name ?>" />
              <span class="text-red-500 text-xs">
                <?php echo isset($error['user_name']) ? $error['user_name'] : ''; ?>
              </span>
            </div>

            <div class="form__group flex flex-col gap-2 ">
              <label for="name">Họ và tên</label>
              <input type="text" name="name" id="name" placeholder="Họ và tên" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg
                  focus:border-orange-500 focus:outline-none" value="<?= $name ?>" />
              <span class="text-red-500 text-xs">
                <?php echo isset($error['name']) ? $error['name'] : ''; ?>
              </span>
            </div>

            <div class="form__group flex flex-col gap-2 ">
              <label for="password">Mật khẩu</label>
              <input type="password" name="password" id="password" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg 
                  focus:border-orange-500 focus:outline-none" placeholder="Mật khẩu" value="<?= $password ?>" />
              <span class="text-red-500 text-xs">
                <?php echo isset($error['password']) ? $error['password'] : ''; ?>
              </span>
            </div>

            <div class="form__group flex flex-col gap-2">
              <label for="password2">Xác nhận mật khẩu</label>
              <input type="password" name="password2" id="password2" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg focus:border-orange-500 focus:outline-none" placeholder="Xác nhận mật khẩu" value="<?= $password2 ?>" />
              <span class="text-red-500 text-xs">
                <?php echo isset($error['password2']) ? $error['password2'] : ''; ?>
              </span>
            </div>

            <div class="form__group flex flex-col gap-2">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg focus:border-orange-500 focus:outline-none" placeholder="example@gmail.com" value="<?= $email ?>" />
              <span class="text-red-500 text-xs">
                <?php echo isset($error['email']) ? $error['email'] : ''; ?>
              </span>
            </div>

            <div class="form__group flex flex-col gap-2">
              <label for="phone">Số điện thoại</label>
              <input type="tel" name="phone" id="phone" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg focus:border-orange-500 focus:outline-none" placeholder="Số điện thoại" value="<?= $phone ?>" />
              <span class="text-red-500 text-xs">
                <?php echo isset($error['phone']) ? $error['phone'] : ''; ?>
              </span>
            </div>

            <div class="form__group flex flex-col gap-2">
              <label for="image_upload">Avatar</label>
              <input type="file" name="image_upload" id="image_upload" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg focus:border-orange-500 focus:outline-none" />
            </div>
            <div class="form__group flex flex-col justify-center items-center gap-3">
              <button type="submit" name="btn_register" class="text-white bg-orange-600 p-2 rounded-sm w-full rounded-lg sm:w-[100px] text-center">
                Đăng ký
              </button>
            </div>
            <!--Default value-->
            <input name="role_id" value="3" type="hidden">
          </form>
        </div>
      </main>