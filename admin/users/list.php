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

                <img src="<?= $CONTENT_URL ?>/images/users/<?= $_SESSION['user']['image'] ?>" alt=""
                    class="w-10 h-10 rounded-full" />
            </div>
            <div class="account__admin--name flex flex-col gap-1">
                <p class="font-medium text-sm text-gray-500">
                    <?= $_SESSION['user']['name'] ?>
                </p>
                <a href="index.php?action=logout" class="logout text-xs text-gray-500 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    Logout
                </a>
            </div>
        </div>
    </header>
    <!-- End header -->
    <main style="border-radius: 10px; background: #fff; box-shadow: 35px 35px 70px
#bebebe, -35px -35px 70px #ffffff; " class="w-full  p-5 mt-5 bg-gray-100">
        <section class="list__accounts w-full">
            <section class="list__accounts-title  flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-10 h-10 text-gray-500">
                    <path fill-rule="evenodd"
                        d="M2.625 6.75a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0zm4.875 0A.75.75 0 018.25 6h12a.75.75 0 010 1.5h-12a.75.75 0 01-.75-.75zM2.625 12a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0zM7.5 12a.75.75 0 01.75-.75h12a.75.75 0 010 1.5h-12A.75.75 0 017.5 12zm-4.875 5.25a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0zm4.875 0a.75.75 0 01.75-.75h12a.75.75 0 010 1.5h-12a.75.75 0 01-.75-.75z"
                        clip-rule="evenodd" />
                </svg>

                <h1 class="text-left text-xl text-gray-500 uppercase">Danh sách người dùng</h1>
            </section>
            <form action="index.php" method="post">
                <div class="list__accounts-table w-full mt-4">
                    <table class="w-full text-center rounded-md shadow-md my-3">
                        <thead class="boder bg-gray-200 px-2 rounded-t-md">
                            <tr>
                                <th>
                                    <input type="hidden" />
                                </th>
                                <th class=" text-xs  p-2 w-20 font-medium">
                                    Họ tên
                                </th>
                                <th class=" text-xs  px-2 py-2 font-medium">
                                    User name
                                </th>

                                <th class=" text-xs  px-2 py-2 font-medium">
                                    Email
                                </th>
                                <th class=" text-xs  px-2 py-2 font-medium">
                                    Số điện thoại
                                </th>
                                <th class=" text-xs  px-2 py-2 font-medium">
                                    Ảnh đại diện
                                </th>

                                <th class=" text-xs  px-2 py-2 font-medium">
                                    Vai trò
                                </th>
                                <th class=" text-xs  px-6 py-2 font-medium">
                                    Thao tác
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item) : ?>
                            <?php extract($item) ?>
                            <tr class="border-t-2 border-dashed">
                                <td class="p-2 whitespace-nowrap">
                                    <input type="checkbox" name="user_id[]" value="<?= $user_id ?>" class="checkbox" />
                                </td>

                                <td class="p-2 w-20 ">
                                    <p class="text-xs text-gray-900 whitespace-nowrap">
                                        <?= $name ?>
                                    </p>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <p class="text-xs text-gray-900">
                                        <?= $user_name ?>
                                </td>

                                <td class="p-2 whitespace-nowrap">
                                    <p class="text-xs text-gray-900">
                                        <?= $email ?>
                                    </p>
                                </td>

                                <td class="p-2 whitespace-nowrap">
                                    <p class="text-xs text-gray-900">
                                        <?= $phone ?>
                                    </p>
                                </td>
                                <td class="p-2">
                                    <img src="<?= $CONTENT_URL ?>/images/users/<?= $image ?>" alt=""
                                        class="w-16 h-16 block mx-auto rounded-full" />
                                </td>



                                <td class="p-2 whitespace-nowrap">
                                    <p class="text-xs text-gray-900">
                                        <?= $role_name ?>
                                    </p>
                                </td>
                                <td class="px-2 mt-7 whitespace-nowrap flex gap-3 items-center justify-center">
                                    <a href="index.php?btn_edit&user_id=<?= $user_id ?>"
                                        class="text-indigo-600 hover:text-indigo-900"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                    <a href="index.php?btn_delete&user_id=<?= $user_id ?>"
                                        class="text-indigo-600 hover:text-indigo-900"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </a>
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="list__accounts-table--button w-full px-5 mt-7 flex justify-center gap-5">
                    <label for="checkAll" style="text-shadow: 0.6px 0.6px 0 #fff; color: #61677c; box-shadow:
1.5px 1.5px 2.5px #babecc, -2px -2px 5px #fff;" id="select"
                        class=" p-3  border  w-[120px] text-center rounded-md text-xs hover:bg-gray-200 leading-4 ">
                        Chọn tất cả
                    </label>
                    <label for="checkAll" style="text-shadow: 0.6px 0.6px 0 #fff; color: #61677c; box-shadow:
1.5px 1.5px 2.5px #babecc, -2px -2px 5px #fff;" id="unselect"
                        class=" p-3  border rounded-md w-[120px] text-center text-xs hover:bg-gray-200 leading-4 ">
                        Bỏ chọn tất cả
                    </label>

                    <button style="text-shadow: 0.6px 0.6px 0 #fff; color: #61677c; box-shadow:
1.5px 1.5px 2.5px #babecc, -2px -2px 5px #fff;" type="submit" name="btn_delete"
                        class=" p-3  border rounded-md text-center   text-xs hover:bg-gray-200 leading-4 ">
                        Xóa mục đã chọn
                    </button>
                    <button style="text-shadow: 0.6px 0.6px 0 #fff; color: #61677c; box-shadow:
1.5px 1.5px 2.5px #babecc, -2px -2px 5px #fff;"
                        class="p-2  border rounded-md w-[120px] text-center   text-xs hover:bg-gray-200 leading-4 ">
                        <a href="<?= $ADMIN_URL ?>/users/index.php">Thêm mới</a>
                    </button>
                    <input type="checkbox" hidden id="checkAll" name="checkAll">
                </div>
            </form>
        </section>
    </main>

</article>
</div>
</div>
</body>

</html>