<section class="text-gray-700 background min-w-[320px]">
    <div class="container mx-auto">
        <div class="swiper mySwiper h-auto max-h-[750px]">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="w-full h-full block object-cover" src="../IMG/slide1.jpg" alt="" />
                </div>
                <div class="swiper-slide">
                    <img class="w-full h-full block object-cover" src="../IMG/slide2.jpg" alt="" />
                </div>
                <div class="swiper-slide">
                    <img class="w-full h-full block object-cover" src="../IMG/slide3.jpg" alt="" />
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

        <script>
            var swiper = new Swiper('.mySwiper', {
                spaceBetween: 30,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false
                }
            })
        </script>
    </div>
</section>
