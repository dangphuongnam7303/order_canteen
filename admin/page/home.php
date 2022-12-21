
        <article class="w-[85%]">
          <header
            style="border-radius: 10px; background: #fff; box-shadow: 35px 35px 70px #bebebe,
-35px -35px 70px #ffffff;
"
            class="w-full h-[60px] flex items-center justify-between px-5 py-2"
          >
            <div
              class="logo-[100px] h-auto px-2 flex gap-2 items-center justify-center"
            >
              <a href="<?= $SITE_URL ?>/page/index.php">
                <img
                  src="../../site/IMG/logo.png"
                  alt="logo"
                  class="w-16 h-auto"
                />
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
                <a
                  href="index.php?action=logout"
                  class="logout text-xs text-gray-500 flex items-center gap-1"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"
                    />
                  </svg>
                  Logout
                </a>
              </div>
            </div>
          </header>
          <!-- End header -->
          <main
            style="border-radius: 10px; background: #fff; box-shadow: 35px 35px 70px
#bebebe, -35px -35px 70px #ffffff; "
            class="w-full  p-5 mt-5 bg-gray-100"
          >
            <div
              class="quantity__statistics flex justify-between gap-3 pt-5 mb-8"
            >
              <div
                style="border-radius: 20px; background: linear-gradient(145deg, #ffffff, #e6e6e6);
box-shadow: 25px 25px 43px #dedede, -25px -25px 43px #ffffff;
"
                class="quantity__statistics-products flex items-center gap-3 p-5"
              >
                <div
                  class="icon__product w-20 h-20 rounded-[50%] bg-orange-500 p-5"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-10 h-10 text-white"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"
                    />
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M6 6h.008v.008H6V6z"
                    />
                  </svg>
                </div>
                <div
                  class="quantity__statistics-products--content flex flex-col gap-2"
                >
                  <h1 class="font-medium text-4xl text-center text-gray-700">
                  123
                  </h1>
                  <p class="font-medium text-sm text-gray-500">
                    Total products
                  </p>
                </div>
              </div>

              <div
                style="border-radius: 20px; background: linear-gradient(145deg, #ffffff, #e6e6e6);
box-shadow: 25px 25px 43px #dedede, -25px -25px 43px #ffffff;
"
                class="quantity__statistics-products flex items-center gap-3 p-5"
              >
                <div
                  class="icon__product w-20 h-20 rounded-[50%] bg-sky-500 p-5"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-10 h-10 text-white"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                    />
                  </svg>
                </div>
                <div
                  class="quantity__statistics-products--content flex flex-col gap-2"
                >
                  <h1 class="font-medium text-4xl text-center text-gray-700">
                  456
                  </h1>
                  <p class="font-medium text-sm text-gray-500">
                    Total users
                  </p>
                </div>
              </div>

              <div
                style="border-radius: 20px; background: linear-gradient(145deg, #ffffff, #e6e6e6);
box-shadow: 25px 25px 43px #dedede, -25px -25px 43px #ffffff;
"
                class="quantity__statistics-products flex items-center gap-3 p-5"
              >
                <div
                  class="icon__product w-20 h-20 rounded-[50%] bg-green-600 p-5"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-10 h-10 text-white"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"
                    />
                  </svg>
                </div>
                <div
                  class="quantity__statistics-products--content flex flex-col gap-2"
                >
                  <h1 class="font-medium text-4xl text-center text-gray-700">
                   789
                  </h1>
                  <p class="font-medium text-sm text-gray-500">
                    Total comments
                  </p>
                </div>
              </div>

              <div
                style="border-radius: 20px; background: linear-gradient(145deg, #ffffff, #e6e6e6);
box-shadow: 25px 25px 43px #dedede, -25px -25px 43px #ffffff;
"
                class="quantity__statistics-products flex items-center gap-3 p-5"
              >
                <div
                  class="icon__product w-20 h-20 rounded-[50%] bg-pink-600 p-5"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-10 h-10 text-white"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"
                    />
                  </svg>
                </div>
                <div
                  class="quantity__statistics-products--content flex flex-col gap-2"
                >
                  <h1 class="font-medium text-4xl text-center text-gray-700">
                  101112
                  </h1>
                  <p class="font-medium text-sm text-gray-500">
                    Total orders
                  </p>
                </div>
              </div>
            </div>
            <!-- End quantity__statistics -->
          </main>
        </article>
      </div>
    </div>
  </body>
</html>
