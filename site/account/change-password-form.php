<?php extract($_SESSION['user']) ?>
<main class="w-full mt-14">
    <h1 class="text-3xl text-center mt-10">Đổi mật khẩu</h1>
    <div class="form__login my-10 w-full flex justify-center mb-20">
        <form action="change-password.php" method="post" enctype="multipart/form-data" class="form__login--content w-[600px] sm:w-[500px]  flex flex-col  gap-4">
            <?php
            if (strlen($MESSAGE)) {
                echo "<h5 class=''>$MESSAGE</h5>";
            }
            ?>
            <div class="form__group flex flex-col gap-2">
                <input type="hidden" name="user_name" id="user_name" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg
                  focus:border-orange-500 focus:outline-none" placeholder="Tên đăng nhập" value="<?= $user_name ?>" readonly />
                <span class="text-red-500 text-xs">
                    <?php echo isset($error['user_name']) ? $error['user_name'] : ''; ?>
                </span>
            </div>

            <div class="form__group flex flex-col gap-2">
                <label for="password">Mật khẩu hiện tại</label>
                <input type="password" name="password" id="password" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg
                  focus:border-orange-500 focus:outline-none" placeholder="Mật khẩu hiện tại" value="<?= $password ?>" />
                <span class="text-red-500 text-xs">
                    <?php echo isset($error['password']) ? $error['password'] : ''; ?>
                </span>
            </div>

            <div class="form__group flex flex-col gap-2">
                <label for="password2">Mật khẩu mới</label>
                <input type="password" name="password2" id="password2" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg
                  focus:border-orange-500 focus:outline-none" placeholder="Mật khẩu mới" value="<?= $password2 ?>" />
                <span class="text-red-500 text-xs">
                    <?php echo isset($error['password2']) ? $error['password2'] : ''; ?>
                </span>
            </div>


            <div class="form__group flex flex-col gap-2">
                <label for="password3">Xác nhận mật khẩu mới</label>
                <input type="password" name="password3" id="password3" class="form__input  text-xs border border-gray-700  p-3 w-full rounded-lg
                  focus:border-orange-500 focus:outline-none" placeholder="Xác nhận mật khẩu mới" value="<?= $password3 ?>" />
                <span class="text-red-500 text-xs">
                    <?php echo isset($error['password3']) ? $error['password3'] : ''; ?>
                </span>
            </div>
            <div class="form__group flex flex-col justify-center items-center gap-3">
                <button type="submit" name="btn_change" class="text-white bg-orange-600 p-2 rounded-lg w-full sm:w-[100px] text-center">
                    Đổi
                </button>
            </div>
            <!--Default value-->
            <input name="user_id" value="<?= $user_id ?>" type="hidden">
        </form>
    </div>
</main>