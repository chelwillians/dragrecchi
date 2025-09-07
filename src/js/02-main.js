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

window.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper(".internal-banner__list", {
        rewind: true,
        slidesPerView: 1,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.internal-banner__next',
            prevEl: '.internal-banner__prev',
        },
        pagination: {
            el: '.internal-banner__pagination',
            clickable: true,
        },
    });
})

window.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper(".image-text__slider", {
        rewind: true,
        slidesPerView: 1,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        // navigation: {
        //     nextEl: '.main-banner__next',
        //     prevEl: '.main-banner__prev',
        // },
        pagination: {
            // el: '.main-banner__pagination',
            clickable: true,
        },
    });
})

document.addEventListener('DOMContentLoaded', () => {
    const faq = document.querySelectorAll('.faq');
    if (!faq) return;

    faq[0]?.addEventListener('click', (e) => {
        if (!e.target.closest('.faq__item--answer')) {
            const question = e.target.closest('.faq__item');
            question.classList.toggle('active');
        }
    })
});
