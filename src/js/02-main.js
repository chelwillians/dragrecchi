window.addEventListener('DOMContentLoaded', function () {
    const mainHeader = document.querySelector('.main-header');
    const hamburguerItem = document.querySelector('.main-header__hamburguer');
    // const headerMenus = document.querySelector('.main-header__menus--mobile');
    hamburguerItem.addEventListener('click', (e) => {
        hamburguerItem.classList.toggle('active');
        // headerMenus.classList.toggle('active');
        mainHeader.classList.toggle('active');
        document.querySelector('html').classList.toggle('no-scroll');
        document.body.classList.toggle('no-scroll');

    })
})

window.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper(".main-banner__list", {
        rewind: true,
        slidesPerView: 1,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.main-banner__next',
            prevEl: '.main-banner__prev',
        },
        pagination: {
            el: '.main-banner__pagination',
            clickable: true,
        },
    });
})
