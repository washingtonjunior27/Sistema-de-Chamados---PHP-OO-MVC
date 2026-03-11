var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      grabCursor: true,
      spaceBetween: 20,
      breakpoints: {
        
        // when window width is >= 640px
        485: {
            slidesPerView: 2
        },
        987: {
            slidesPerView: 3
        },
        1200: {
            slidesPerView: 4
        }
    }
});