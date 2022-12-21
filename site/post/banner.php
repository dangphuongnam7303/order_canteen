  <section class="grid grid-cols-1 gap-6 my-5 w-full container px-2 mx-auto">
      <aside class="">
          <div style="background-image: url('<?= $CONTENT_URL ?>/images/users/<?= $_SESSION['user']['image'] ?>')" class="shadow rounded-lg bg-cover bg-center bg-no-repeat">
              <div class="flex flex-col gap-1 text-center items-center backdrop-blur-sm p-16">
                  <img class="h-32 w-32 bg-white p-2 rounded-full shadow mb-4" src="<?= $CONTENT_URL ?>/images/users/<?= $_SESSION['user']['image'] ?>" alt="" />
                  <p class="font-semibold text-white"><?= $_SESSION['user']['name'] ?> </p>
                  <p class="text-white text-xs">@<?= $_SESSION['user']['user_name'] ?></p>
                  <div class="text-sm leading-normal text-gray-100 flex justify-center items-center">
                      <svg viewBox="0 0 24 24" class="mr-1" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                          <circle cx="12" cy="10" r="3"></circle>
                      </svg>
                      Fpoly, Việt Nam
                  </div>
              </div>
          </div>
      </aside>