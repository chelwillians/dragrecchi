window.addEventListener('load', function () {
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
