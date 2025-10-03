<?php

/*
* Template Name: Página Inicial
*/

get_header() ?>
<section class="main-banner">
    <h1 class="hide-title">Dra. Camille Grecchi</h1>
    <div class="main-banner__list swiper">
        <div class="swiper-wrapper">
            <div class="main-banner__item swiper-slide">
                <img src="<?= get_template_directory_uri() ?>/dist/images/banner.jpg" class="main-banner__item-image main-banner__item-image--desk" alt="">
                <img src="<?= get_template_directory_uri() ?>/dist/images/banner-mobile.jpg" class="main-banner__item-image main-banner__item-image--mobile" alt="">
                <div class="container wrap">
                    <span class="main-banner__item-subtitle">1Lorem Ipsum</span>
                    <span class="main-banner__item-title">1Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dictum mauris ac turpis ultrices efficitur.</span>
                    <div class="main-banner__item-button-area">
                        <a href="#" class="main-banner__item-button btn btn--default">Agendar</a>
                    </div>
                </div>
            </div>
            <div class="main-banner__item swiper-slide">
                <img src="<?= get_template_directory_uri() ?>/dist/images/banner.jpg" class="main-banner__item-image main-banner__item-image--desk" alt="">
                <img src="<?= get_template_directory_uri() ?>/dist/images/banner-mobile.jpg" class="main-banner__item-image main-banner__item-image--mobile" alt="">
                <div class="container wrap">
                    <span class="main-banner__item-subtitle">2Lorem Ipsum</span>
                    <span class="main-banner__item-title">2Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dictum mauris ac turpis ultrices efficitur.</span>
                    <div class="main-banner__item-button-area">
                        <a href="#" class="main-banner__item-button btn btn--default">Agendar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about">
    <div class="container wrap">
        <div class="about__left">
            <h2 class="about__title title">Lorem ipsum dolor sit amet</h2>
            <div class="about__desc">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tincidunt aliquam orci a imperdiet. In pellentesque laoreet odio eu venenatis. Sed efficitur non nisl a congue. Vestibulum ac leo a ipsum fermentum faucibus vel nec lacus. Maecenas nec purus ac purus tincidunt porta nec non leo. Proin ullamcorper ac diam nec commodo. Nulla consectetur sollicitudin orci ac viverra. Suspendisse et justo sit amet nisl suscipit volutpat lobortis sit amet ligula. Morbi ut congue mauris, eget imperdiet urna. Praesent vestibulum sapien eu ante venenatis, id feugiat ipsum rhoncus.</p>
                <p>In auctor odio ut nulla blandit, ac congue risus aliquet. Aliquam aliquet congue ante id elementum. Ut eu tortor vel magna hendrerit venenatis et sed dui. Etiam at viverra elit, nec pellentesque augue. Etiam ac lacus viverra, semper est ut, iaculis purus. Etiam lobortis justo neque, sed efficitur tellus egestas ac. Etiam dignissim, turpis id semper ultrices, quam nibh molestie ligula, non finibus eros dui id arcu. Morbi fermentum consequat urna, et feugiat urna porta non. Aliquam vehicula, nulla id cursus dapibus, enim ex scelerisque risus, sed semper erat magna id enim. Donec quis ligula justo. Phasellus blandit dolor at urna cursus iaculis. Cras in urna id massa maximus scelerisque nec vel magna.</p>
            </div>
        </div>
        <img src="<?= get_template_directory_uri() ?>/dist/images/nose.jpg" alt="" class="about__image">
    </div>
</section>

<section class="procedures">
    <div class="container wrap">
        <div class="procedures__call">
            <h2 class="procedures__title title">Procedimentos</h2>
            <div class="procedures__desc">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tincidunt aliquam orci a imperdiet. In pellentesque laoreet odio eu venenatis. Sed efficitur non nisl a congue.</p>
            </div>
        </div>
        <a href="#" class="procedures__item">
            <img src="https://placehold.co/420" alt="" class="procedures__item-image">
        </a>
        <a href="#" class="procedures__item">
            <img src="https://placehold.co/420" alt="" class="procedures__item-image">
        </a>
        <a href="#" class="procedures__item">
            <img src="https://placehold.co/420" alt="" class="procedures__item-image">
        </a>
        <a href="#" class="procedures__item">
            <img src="https://placehold.co/420" alt="" class="procedures__item-image">
        </a>
        <a href="#" class="procedures__item">
            <img src="https://placehold.co/420" alt="" class="procedures__item-image">
        </a>
        <div class="procedures__button-area">
            <a href="#" class="procedures__button btn btn--gold">Ver todos</a>
        </div>
    </div>
</section>

<section class="image-text">
    <div class="container wrap">
        <img src="<?= get_template_directory_uri() ?>/dist/images/nose.jpg" alt="" class="image-text__image">
        <div class="image-text__content">
            <h2 class="image-text__title title">Lorem ipsum dolor sit amet</h2>
            <div class="image-text__desc">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tincidunt aliquam orci a imperdiet. In pellentesque laoreet odio eu venenatis. Sed efficitur non nisl a congue. Vestibulum ac leo a ipsum fermentum faucibus vel nec lacus. Maecenas nec purus ac purus tincidunt porta nec non leo. Proin ullamcorper ac diam nec commodo. Nulla consectetur sollicitudin orci ac viverra. Suspendisse et justo sit amet nisl suscipit volutpat lobortis sit amet ligula. Morbi ut congue mauris, eget imperdiet urna. Praesent vestibulum sapien eu ante venenatis, id feugiat ipsum rhoncus.</p>
            </div>
            <ul class="image-text__bullets">
                <li class="image-text__bullets-item">
                    <img class="image-text__bullets-icon" src="https://placehold.co/24" />
                    <span>Lorem ipsum dolor sit ametet</span>
                </li>
                <li class="image-text__bullets-item">
                    <img class="image-text__bullets-icon" src="https://placehold.co/24" />
                    <span>Lorem ipsum dolor sit ametet</span>
                </li>
                <li class="image-text__bullets-item">
                    <img class="image-text__bullets-icon" src="https://placehold.co/24" />
                    <span>Lorem ipsum dolor sit ametet</span>
                </li>
                <li class="image-text__bullets-item">
                    <img class="image-text__bullets-icon" src="https://placehold.co/24" />
                    <span>Lorem ipsum dolor sit ametet</span>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="testimonials">
    <div class="container wrap">
        <div class="testimonials__call">
            <h2 class="testimonials__title title">Depoimentos</h2>
            <div class="testimonials__desc">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tincidunt aliquam orci a imperdiet. In pellentesque laoreet odio eu venenatis. Sed efficitur non nisl a congue.</p>
            </div>
        </div>
        <div class="testimonials__list">
            <div class="testimonials__item">
                <video class="depoimento-video" width="100%" height="auto" autoplay muted playsinline loop preload="auto" poster="<?= get_template_directory_uri() ?>/dist/videos/depoimento.jpg">
                    <source src="<?= get_template_directory_uri() ?>/dist/videos/depoimento.mp4" type="video/mp4">
                    <source src="<?= get_template_directory_uri() ?>/dist/videos/depoimento.webm" type="video/webm">
                    Seu navegador não suporta vídeos HTML5.
                </video>
            </div>
            <div class="testimonials__item">
                <video class="depoimento-video" width="100%" height="auto" autoplay muted playsinline loop preload="auto" poster="<?= get_template_directory_uri() ?>/dist/videos/depoimento.jpg">
                    <source src="<?= get_template_directory_uri() ?>/dist/videos/depoimento.mp4" type="video/mp4">
                    <source src="<?= get_template_directory_uri() ?>/dist/videos/depoimento.webm" type="video/webm">
                    Seu navegador não suporta vídeos HTML5.
                </video>
            </div>
            <div class="testimonials__item">
                <video class="depoimento-video" width="100%" height="auto" autoplay muted playsinline loop preload="auto" poster="<?= get_template_directory_uri() ?>/dist/videos/depoimento.jpg">
                    <source src="<?= get_template_directory_uri() ?>/dist/videos/depoimento.mp4" type="video/mp4">
                    <source src="<?= get_template_directory_uri() ?>/dist/videos/depoimento.webm" type="video/webm">
                    Seu navegador não suporta vídeos HTML5.
                </video>
            </div>
            <div class="testimonials__item">
                <video class="depoimento-video" width="100%" height="auto" autoplay muted playsinline loop preload="auto" poster="<?= get_template_directory_uri() ?>/dist/videos/depoimento.jpg">
                    <source src="<?= get_template_directory_uri() ?>/dist/videos/depoimento.mp4" type="video/mp4">
                    <source src="<?= get_template_directory_uri() ?>/dist/videos/depoimento.webm" type="video/webm">
                    Seu navegador não suporta vídeos HTML5.
                </video>
            </div>
        </div>
    </div>
</section>

<section class="blog-list">
    <div class="container wrap">
        <div class="blog-list__header">
            <h2 class="blog-list__title title"><strong>Blog | </strong>Fique por dentro</h2>
            <a href="#" class="blog-list__button btn btn--gold">Ver todos</a>
        </div>

        <div class="blog-list__list">
            <div class="blog-list__item">
                <a href="#" class="">
                    <img src="https://placehold.co/506x320" alt="" class="blog-list__item-img">
                </a>
                <a href="#">
                    <h3 class="blog-list__item-title title">Artigo 1</h3>
                </a>
            </div>
            <div class="blog-list__item">
                <a href="#" class="">
                    <img src="https://placehold.co/506x320" alt="" class="blog-list__item-img">
                </a>
                <a href="#">
                    <h3 class="blog-list__item-title title">Artigo 2</h3>
                </a>
            </div>
            <div class="blog-list__item">
                <a href="#" class="">
                    <img src="https://placehold.co/506x320" alt="" class="blog-list__item-img">
                </a>
                <a href="#">
                    <h3 class="blog-list__item-title title">Artigo 3</h3>
                </a>
            </div>
        </div>

        <div class="blog-list__button-area">
            <a href="#" class="blog-list__button btn btn--gold">Ver todos</a>
        </div>
    </div>
</section>

<section class="contacts">
    <div class="container wrap">
        <div class="contacts__header">
            <strong class="contacts__subtitle">Contato</strong>
            <h2 class="contacts__title title">Lorem Ipsum Dolor</h2>
        </div>
        <div class="contacts__list">
            <div class="contacts__item">
                <img src="https://placehold.co/84" alt="" class="contacts__item-icon">
                <h3 class="contacts__item-title">Lorem ipsum dolor</h3>
                <div class="contacts__item-desc">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tincidunt aliquam orci a imperdiet. In pellentesque laoreet odio eu venenatis. Sed efficitur non nisl a congue.</p>
                </div>
            </div>
            <div class="contacts__item">
                <img src="https://placehold.co/84" alt="" class="contacts__item-icon">
                <h3 class="contacts__item-title">Lorem ipsum dolor</h3>
                <div class="contacts__item-desc">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tincidunt aliquam orci a imperdiet. In pellentesque laoreet odio eu venenatis. Sed efficitur non nisl a congue.</p>
                </div>
            </div>
            <div class="contacts__item">
                <img src="https://placehold.co/84" alt="" class="contacts__item-icon">
                <h3 class="contacts__item-title">Lorem ipsum dolor</h3>
                <div class="contacts__item-desc">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tincidunt aliquam orci a imperdiet. In pellentesque laoreet odio eu venenatis. Sed efficitur non nisl a congue.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer() ?>