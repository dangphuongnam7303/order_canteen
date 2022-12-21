<main class="w-full mt-14">
    <h1 class="text-3xl text-center mt-10 mb-10">Đăng nhập</h1>
    <div class="form__login my-10 w-full flex justify-center mb-20">
        <form action="sign-in.php" method="post" enctype="multipart/form-data" class="form__login--content w-[300px] sm:w-[500px]  flex flex-col  gap-4">
            <?php
            if (strlen($MESSAGE)) {
                echo "<h5 class=''>$MESSAGE</h5>";
            }
            ?>
            <div class="form__group flex flex-col gap-2">
                <label for="user_name">Tên đăng nhập</label>
                <input type="text" name="user_name" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg
                  focus:border-orange-500 focus:outline-none" placeholder="Tên đăng nhập" value="<?= $user_name ?>" />
                <span class="text-red-500 text-xs">
                    <?php echo isset($error['user_name']) ? $error['user_name'] : ''; ?>
                </span>
            </div>
            <div class="form__group flex flex-col gap-2 ">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" id="password" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg 
                  focus:border-orange-500 focus:outline-none" placeholder="Mật khẩu" value="<?= $password ?>" />
                <span class="text-red-500 text-xs">
                    <?php echo isset($error['password']) ? $error['password'] : ''; ?>
                </span>
                <span class="text-red-500 text-xs">
                    <?php
                    if (isset($error['login'])) {
                        echo $error['login'];
                    }
                    ?>
                </span>
            </div>
            <div class="form__group flex flex-col justify-center items-center gap-3">
                <a href="forgot-password.php" class="text-center text-gray-500 ">Quên mật khẩu?</a>
                <button type="submit" name="btn_login" class="text-white bg-orange-600 p-2 rounded-lg w-full sm:w-[100px] text-center">
                    Đăng nhập
                </button>

                <p class="text-center  text-gray-500">
                    Không có tài khoản?
                    <a href="sign-up.php" class=" text-orange-500 hover:underline">Đăng ký</a>
                </p>
            </div>
        </form>
    </div>
</main>