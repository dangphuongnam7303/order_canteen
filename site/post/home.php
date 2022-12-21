<?php $list_posts = post_accept();
$list_comments = comment_select_all();
?>
<article class="lg:px-10 ">
    <form id="new__post" action="./index.php" class="relative bg-white shadow rounded-lg mb-6 p-4" method="post"
        enctype="multipart/form-data">
        <textarea name="content" placeholder="Bạn đang nghĩ gì..."
            class="w-full rounded-lg p-3 text-sm focus:outline-none bg-gray-100 border border-transparent appearance-none rounded-tg placeholder-gray-400"></textarea>
        <div class="image-upload absolute top-7 right-7">
            <label for="file-input">
                <span
                    class="flex items-center transition ease-out duration-300 hover:bg-blue-500 hover:text-white bg-blue-100 w-10 h-10 px-2 rounded-full text-blue-400 cursor-pointer">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
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
                                                                ?>" />
        </div>

        <div class="btn__group flex justify-between">
            <button style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); backdrop-filter: blur(2.5px);
-webkit-backdrop-filter: blur(2.5px); border-radius: 10px; border: 1px solid
rgba(255, 255, 255, 0.18);
" name="btn_insert" class="flex items-center mt-3 py-2 px-4 rounded-lg text-sm bg-blue-600 text-white shadow-lg">
                Đăng
                <svg class="ml-1" viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
            </button>
            <!-- Nếu role != 3 thì hiển thị -->
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) { ?>
            <button type="submit" name="<?= $VIEW_NAME == './home.php' ? 'btn_check' : '' ?>" style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); backdrop-filter: blur(2.5px);
-webkit-backdrop-filter: blur(2.5px); border-radius: 10px; border: 1px solid
rgba(255, 255, 255, 0.18);
" class="flex items-center gap-2 mt-3 py-2 px-4 rounded-lg text-sm bg-red-600 text-white shadow-lg">
                <span><?= $VIEW_NAME == './home.php' ? 'Kiểm duyệt' : 'Blog' ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
            </button>
            <?php } ?>
        </div>
    </form>
    <?php foreach ($list_posts as $post) : ?>
    <?php extract($post) ?>
    <div class="bg-white shadow-lg rounded-lg mb-6 relative">


        <div class="flex flex-row px-2 py-3 mx-3">
            <a href="<?= $SITE_URL ?>/post/profile.php?user_id=<?= $user_id ?>">
                <div class="w-auto h-auto rounded-full">
                    <?php
            $user = select_by_id_users($user_id);
            extract($user);
            echo '<img src="' . $CONTENT_URL . '/images/users/' . $image . '" class="w-10 h-10 rounded-full" alt="avatar">';
            ?>
                </div>
            </a>
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
        <div class="text-gray-700 text-sm mt-2 mx-3 p-2">
            <?= $content ?>
        </div>

        <div class="text-gray-400 font-medium text-sm mb-7 mt-3 mx-3 px-2">
            <a href="<?= $SITE_URL ?>/post/detail.php?post_id=<?= $post_id ?>">
                <div class=" flex flex-wrap justify-center gap-4">
                    <?php
            $post_images = post_image_select_by_post_id($post_id);
            foreach ($post_images as $post_image) :
              extract($post_image);
            ?>
                    <?php if (!empty($image)) { ?>
                    <div class="overflow-hidden rounded-xl w-[47%]">
                        <img class="h-full w-full object-cover" src="
              <?= $CONTENT_URL ?>/images/posts/<?= $image ?>" alt="">
                    </div>
                    <?php } ?>
                    <?php endforeach; ?>
                    <?php if (count($post_images) >= 3) : ?>
                    <div class="relative overflow-hidden rounded-xl w-[47%]">
                        <div
                            class="text-white text-sm absolute inset-0 bg-slate-900/80 flex justify-center items-center">
                            + Xem thêm
                        </div>
                        <img class="h-full w-full object-cover" src="../IMG/background-product.jpg" alt="" />
                    </div>
                    <?php endif; ?>
                </div>
            </a>
        </div>

        <div class="flex justify-end items-center px-5 mb-3 border-t border-gray-100">
            <?php if (isset($_SESSION['user'])) { ?>
            <!-- Xóa post -->
            <?php if ($_SESSION['user']['user_id'] == $user_id || $_SESSION['user']['role_id'] == 1) { ?>
            <div class="menu__post absolute ">
                <form id="delete_post" method="post" action="./index.php">
                    <button class="btn__delete__post flex gap-2 items-center text-lg text-gray-500 font-medium"
                        type="submit" name="btn_delete_post">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                    <input type="number" name="post_id" class="hidden" value="<?php echo $post_id; ?>" />
                </form>
            </div>

            <!-- --------------------------------------------------- -->
            <?php } ?>
            <?php } ?>
            <div class="flex justify-start items-center w-full mt-1 pt-2 pr-5">
                <span
                    class="transition ease-out duration-300 hover:bg-blue-50 bg-blue-100 w-8 h-8 px-2 py-2 text-center rounded-full text-blue-400 cursor-pointer mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="14px" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                        </path>
                    </svg>
                </span>
                <span
                    class="transition ease-out duration-300 hover:bg-gray-50 bg-gray-100 h-8 px-2 py-2 text-center rounded-full text-gray-100 cursor-pointer">
                    <svg class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z">
                        </path>
                    </svg>
                </span>
            </div>
        </div>
        <div class="flex w-full border-t border-gray-100">
            <div class="mt-3 mx-5 flex items-center gap-5 text-xs">
                <span class="flex text-gray-700 font-normal rounded-md gap-1 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                    </svg>

                    <div class="ml-1 text-gray-400 text-ms">30</div>
                </span>
                <span class="flex text-gray-700 font-normal rounded-md items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    <span class="ml-1 text-gray-400 text-ms">6000</span>
                </span>
            </div>
            <div class="mt-3 mx-5 w-full flex justify-end text-xs">
                <div class="flex text-gray-700 rounded-md mb-2 mr-4 items-center">
                    Lượt thích
                    <div class="ml-1 text-gray-400 text-ms">120</div>
                </div>
            </div>
        </div>


        <!--Đổ Comment -->
        <?php
      $list_comments = comment_select_by_post_id($post_id);
      foreach ($list_comments as $comment) :
        extract($comment);
      ?>
        <div class="text-black p-4 w-full flex">
            <a href="<?= $SITE_URL ?>/post/profile.php?user_id=<?= $user_id ?>">
                <img class="rounded-full h-8 w-8 mr-2 mt-1" src="
            <?= $CONTENT_URL ?>/images/users/<?= $avatar ?>
          " />
            </a>
            <div>
                <div class="bg-gray-100 rounded-lg px-4 pt-2 pb-2.5">
                    <div class="font-semibold text-sm leading-relaxed">
                        <?= $name ?>
                    </div>
                    <div class="text-xs leading-snug md:leading-normal max-w-lg ">
                        <?= $content ?>
                    </div>
                    <?php if ($image != "") { ?>
                    <div class="comment__img my-2">
                        <img class="w-20 h-20 rounded-lg" src="<?= $CONTENT_URL ?>/images/comments/<?= $image ?>">
                    </div>
                    <?php } ?>
                </div>
                <div class="text-xs mt-0.5 text-gray-500">
                    <?= $time_send ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <form action="./index.php" method="post" enctype="multipart/form-data" class="flex items-center gap-1">
            <div
                class="relative flex items-center self-center w-full max-w-xl p-4 overflow-hidden text-gray-600 focus-within:text-gray-400">
                <img class="w-10 h-10 object-cover rounded-full shadow mr-2 cursor-pointer" alt="User avatar"
                    src="<?= $CONTENT_URL ?>/images/users/<?= $_SESSION['user']['image'] ?>" />
                <input type="hidden" name="post_id" value="<?= $post_id ?>" />
                <span class="absolute inset-y-0 right-4 flex items-center">
                    <input type="file" name="image" id="file" class="inputfile hidden" />
                    <label for="file"><span
                            class="flex items-center transition ease-out duration-300 hover:bg-blue-500 hover:text-white bg-blue-100 w-8 h-8 px-2 rounded-full text-blue-400 cursor-pointer">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </span></label>
                </span>

                <input type="search" name="content"
                    class="w-full py-2 pl-4 pr-10 text-sm bg-gray-100 border border-transparent appearance-none rounded-tg placeholder-gray-400"
                    style="border-radius: 25px" placeholder="Nhập bình luận..." autocomplete="off" />
            </div>
            <button style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); backdrop-filter: blur(2.5px);
-webkit-backdrop-filter: blur(2.5px); border-radius: 10px; border: 1px solid
rgba(255, 255, 255, 0.18);
" name="btn_add_comment" class="flex items-center h-8 px-3 rounded-lg text-sm bg-blue-600 text-white shadow-lg">
                Gửi
            </button>
        </form>

    </div>
    <?php endforeach; ?>

    </div>
    </form>


    </div>



</article>
</main>