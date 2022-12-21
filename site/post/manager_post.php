<?php $list_posts = post_reject(); ?>
<article class="lg:px-10 ">
    <form id="new__post" action="./index.php" class="relative bg-white shadow rounded-lg mb-6 p-4" method="post" enctype="multipart/form-data">
        <textarea name="content" placeholder="Bạn đang nghĩ gì..." class="w-full rounded-lg p-3 text-sm focus:outline-none bg-gray-100 border border-transparent appearance-none rounded-tg placeholder-gray-400"></textarea>
        <div class="image-upload absolute top-7 right-7">
            <label for="file-input">
                <span class="flex items-center transition ease-out duration-300 hover:bg-blue-500 hover:text-white bg-blue-100 w-10 h-10 px-2 rounded-full text-blue-400 cursor-pointer">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                </span>
            </label>
            <input id="file-input" name="image[]" type="file" class="hidden" multiple />
            <input name="post_id" type="number" class="hidden" value="<?php
                                                                        $check = check_exist();
                                                                        extract($check);
                                                                        if (empty($post_id)) {
                                                                            echo 1;
                                                                        } else {
                                                                            echo $post_id + 1;
                                                                        }
                                                                        ?>" multiple />
        </div>

        <div class="btn__group flex justify-between">
            <button style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); backdrop-filter: blur(2.5px);
-webkit-backdrop-filter: blur(2.5px); border-radius: 10px; border: 1px solid
rgba(255, 255, 255, 0.18);
" name="btn_insert" class="flex items-center mt-3 py-2 px-4 rounded-lg text-sm bg-blue-600 text-white shadow-lg">
                Đăng
                <svg class="ml-1" viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
            </button>
            <!-- Nếu role = 1 thì hiển thị -->
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] !== 3) { ?>
                <button type="submit" name="<?= $VIEW_NAME == './home.php' ? 'btn_check' : '' ?>" style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); backdrop-filter: blur(2.5px);
                -webkit-backdrop-filter: blur(2.5px); border-radius: 10px; border: 1px solid
                rgba(255, 255, 255, 0.18);
                " class="flex items-center gap-2 mt-3 py-2 px-4 rounded-lg text-sm bg-red-600 text-white shadow-lg">
                    <span><?= $VIEW_NAME == './home.php' ? 'Kiểm duyệt' : 'Blog' ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                    </a>


        </div>
    </form>
    <?php if (count($list_posts) == 0) { ?>
        <div class="flex justify-center items-center">
            <h1 class="text-2xl font-semibold">Không có bài viết nào cần kiểm duyệt !</h1>
        </div>
    <?php } ?>
    <?php foreach ($list_posts as $post) : ?>
        <?php extract($post) ?>
        <div class="bg-white shadow-lg rounded-lg mb-6">
            <div class="flex flex-row px-2 py-3 mx-3">
                <div class="w-auto h-auto rounded-full">
                    <?php
                    $user = select_by_id_users($user_id);
                    extract($user);
                    echo '<img src="' . $CONTENT_URL . '/images/users/' . $image . '" class="w-10 h-10 rounded-full" alt="avatar">';
                    ?>
                </div>
                <div class="flex flex-col mb-2 ml-4 mt-1">
                    <div class="text-gray-600 text-sm font-semibold">
                        <?= $name ?>
                    </div>
                    <div class="flex w-full mt-1">
                        <div class="text-gray-700 font-light text-xs">
                            <?= $time_post ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-b border-gray-100"></div>
            <div class="text-gray-700 text-sm mt-4 mx-3 p-2">
                <?= $content ?>
            </div>

            <div class="text-gray-400 font-medium text-sm mb-7 mt-6 mx-3 px-2">
                <div class="flex flex-wrap justify-center  gap-4">
                    <?php
                    $post_images = post_image_select_by_post_id($post_id);
                    foreach ($post_images as $post_image) :
                        extract($post_image);
                    ?>
                        <div class="overflow-hidden rounded-xl w-[47%]">
                            <img class="h-full w-full object-cover" src="
              <?= $CONTENT_URL ?>/images/posts/<?= $image ?>" alt="">
                        </div>
                    <?php endforeach; ?>
                    <?php if (count($post_images) >= 3) : ?>
                        <div class="relative overflow-hidden rounded-xl w-[47%]">
                            <div class="text-white text-sm absolute inset-0 bg-slate-900/80 flex justify-center items-center">
                                + Xem thêm
                            </div>
                            <img class="h-full w-full object-cover" src="../IMG/background-product.jpg" alt="" />
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="flex justify-center mb-4 border-t border-gray-100">
                <form action="./index.php" method="POST" class="flex my-5 gap-4 justify-end mr-10 mb-5 border-t border-gray-100">
                    <input type="hidden" name="post_id" value="<?= $post_id ?>">
                    <button name="btn_confirm" class="flex gap-1 items-center mt-3 py-3 px-4 rounded-lg  bg-green-500 text-white shadow-lg">
                        <svg class="mr-1" viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        Duyệt
                    </button>
                    <button name="btn_cancel" class="flex gap-1 items-center mt-3 py-2 px-4 rounded-lg  bg-red-600 text-white shadow-lg">
                        <span>Xóa</span> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg></button>
                </form>
            </div>
        <?php endforeach; ?>
        </div>
    <?php  } ?>
</article>
</main>