<?php

/*
* Template Name: Página Inicial
*/

get_header() ?>

<?php if (!empty(get_field_cmb2('banner_show')) && !empty(get_field_cmb2('sliders'))): ?>
    <section class="main-banner">
        <h1 class="hide-title"><?= !empty(get_field_cmb2('h1_content')) ? get_field_cmb2('h1_content') : get_the_title() ?></h1>
        <div class="main-banner__list swiper">
            <div class="swiper-wrapper">
                <?php foreach (get_field_cmb2('sliders') as $index => $item): ?>
                    <div class="main-banner__item swiper-slide">
                        <?php if (!empty($item['image_desk'])): ?>
                            <img src="<?= $item['image_desk'] ?>" class="main-banner__item-image main-banner__item-image--desk" alt="<?= !empty(get_post_meta($item['image_desk_id'], '_wp_attachment_image_alt', TRUE)) ? get_post_meta($item['image_desk_id'], '_wp_attachment_image_alt', TRUE) : 'Imagem do banner' ?>">
                        <?php endif; ?>
                        <?php if (!empty($item['image_mobile'])): ?>
                            <img src="<?= $item['image_mobile'] ?>" class="main-banner__item-image main-banner__item-image--mobile" alt="<?= !empty(get_post_meta($item['image_mobile_id'], '_wp_attachment_image_alt', TRUE)) ? get_post_meta($item['image_mobile_id'], '_wp_attachment_image_alt', TRUE) : 'Imagem do banner' ?>">
                        <?php endif; ?>
                        <div class="container wrap">
                            <?php if (!empty($item['pretitle'])): ?>
                                <span class="main-banner__item-subtitle"><?= $item['pretitle'] ?></span>
                            <?php endif; ?>
                            <?php if (!empty($item['title'])): ?>
                                <span class="main-banner__item-title"><?= $item['title'] ?></span>
                            <?php endif; ?>
                            <?php if (!empty($item['link_btn'])): ?>
                                <div class="main-banner__item-button-area">
                                    <a href="<?= $item['link_btn'] ?>" class="main-banner__item-button btn btn--default"><?= !empty($item['text_btn']) ? $item['text_btn'] : "Agendar";  ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty(get_field_cmb2('about_show'))): ?>
    <section class="about">
        <div class="container wrap">
            <div class="about__left">
                <?php if (!empty(get_field_cmb2('about_title'))): ?>
                    <h2 class="about__title title"><?= get_field_cmb2('about_title') ?></h2>
                <?php endif; ?>
                <?php if (!empty(get_field_cmb2('about_desc'))): ?>
                    <div class="about__desc">
                        <?= wpautop(get_field_cmb2('about_desc')) ?>
                    </div>
                <?php endif; ?>
            </div>
            <img src="<?= !empty(get_field_cmb2('about_image')) ? get_field_cmb2('about_image') : get_template_directory_uri() . '/dist/images/nose.jpg' ?>" alt="<?= !empty(get_post_meta(get_field_cmb2('about_image_id'), '_wp_attachment_image_alt', TRUE)) ? get_post_meta(get_field_cmb2('about_image_id'), '_wp_attachment_image_alt', TRUE) : 'Imagem do banner' ?>" class="about__image">
        </div>
    </section>
<?php endif; ?>

<?php
$args_blog = array(
    'post_type'      => 'procedimentos',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
);
query_posts($args_blog);

if (have_posts()) :
?>
    <?php if (!empty(get_field_cmb2('procedures_show'))): ?>
        <section class="procedures">
            <div class="container wrap">
                <div class="procedures__call">
                    <?php if (!empty(get_field_cmb2('procedures_title'))): ?>
                        <h2 class="procedures__title title"><?= get_field_cmb2('procedures_title') ?></h2>
                    <?php endif; ?>
                    <?php if (!empty(get_field_cmb2('procedures_desc'))): ?>
                        <div class="procedures__desc">
                            <?= wpautop(get_field_cmb2('procedures_desc')) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php $i = 0;
                $duration = 400;
                while (have_posts()) :
                    the_post();
                ?>
                    <a href="<?= get_the_permalink() ?>" title="<?= "Procedimento: " .  get_the_title() ?>" class="procedures__item">
                        <img src="<?= has_post_thumbnail() ? get_the_post_thumbnail_url('', 'medium_large') : "https://placehold.co/420" ?>" alt="<?= has_post_thumbnail() ? get_alt(get_post_thumbnail_id()) : "Imagem do post " . get_the_title() ?>" class="procedures__item-image">
                    </a>
                <?php $i++;
                    $duration += 200;
                endwhile; ?>
                <?php wp_reset_query(); ?>
                <?php if (!empty(get_field_cmb2('procedures_link_btn'))): ?>
                    <div class="procedures__button-area">
                        <a href="<?= get_field_cmb2('procedures_link_btn') ?>" class="procedures__button btn btn--gold"><?= !empty(get_field_cmb2('procedures_text_btn')) ? get_field_cmb2('procedures_text_btn') : "Ver todos" ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<?php if (!empty(get_field_cmb2('text_image_list_show'))): ?>
    <section class="image-text">
        <div class="container wrap">
            <img src="<?= !empty(get_field_cmb2('text_image_list_image')) ? get_field_cmb2('text_image_list_image') : get_template_directory_uri() . '/dist/images/nose.jpg' ?>" alt="<?= !empty(get_post_meta(get_field_cmb2('text_image_list_image_id'), '_wp_attachment_image_alt', TRUE)) ? get_post_meta(get_field_cmb2('text_image_list_image_id'), '_wp_attachment_image_alt', TRUE) : 'Imagem do banner' ?>" class="image-text__image">
            <div class="image-text__content">
                <?php if (!empty(get_field_cmb2('text_image_list_title'))): ?>
                    <h2 class="image-text__title title"><?= get_field_cmb2('text_image_list_title') ?></h2>
                <?php endif; ?>
                <?php if (!empty(get_field_cmb2('text_image_list_desc'))): ?>
                    <div class="image-text__desc">
                        <?= wpautop(get_field_cmb2('text_image_list_desc')) ?>
                    </div>
                <?php endif; ?>
                <ul class="image-text__bullets">
                    <?php if (!empty(get_field_cmb2('list'))): ?>
                        <?php foreach (get_field_cmb2('list') as $index => $item): ?>
                            <li class="image-text__bullets-item">
                                <?php if (!empty($item['icon'])): ?>
                                    <img class="image-text__bullets-icon" src="<?= $item['icon'] ?>" alt="<?= !empty(get_post_meta($item['icon'], '_wp_attachment_image_alt', TRUE)) ? get_post_meta($item['icon'], '_wp_attachment_image_alt', TRUE) : 'Imagem do banner' ?>" />
                                <?php endif; ?>
                                <?php if (!empty($item['text'])): ?>
                                    <span><?= $item['text'] ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty(get_field_cmb2('testmonials_show'))): ?>
    <section class="testimonials testimonials--image">
        <div class="container wrap">
            <div class="testimonials__call">
                <?php if (!empty(get_field_cmb2('testmonials_title'))): ?>
                    <h2 class="testimonials__title title"><?= get_field_cmb2('testmonials_title') ?></h2>
                <?php endif; ?>
                <?php if (!empty(get_field_cmb2('testmonials_desc'))): ?>
                    <div class="testimonials__desc">
                        <?= wpautop(get_field_cmb2('testmonials_desc')) ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="testimonials__list">
                <?php foreach (get_field_cmb2('testmonials') as $index => $item): ?>
                    <?php
                    // Supondo que $item contenha a URL do vídeo
                    $video_url = $item['video'];
                    $ext = pathinfo($video_url, PATHINFO_EXTENSION); // pega a extensão (mp4, webm, etc.)
                    $type = "video/" . strtolower($ext); // gera o type automaticamente
                    if (1 == 0):
                    ?>

                        <div class="testimonials__item">
                            <video class="depoimento-video" width="100%" height="auto" autoplay muted playsinline loop preload="auto">
                                <source src="<?= esc_url($video_url) ?>" type="<?= esc_attr($type) ?>">
                                Seu navegador não suporta vídeos HTML5.
                            </video>
                        </div>
                    <?php endif; ?>
                    <img src="<?= $item['video'] ?>" alt="<?= !empty(get_post_meta($item['video_id'], '_wp_attachment_image_alt', TRUE)) ? get_post_meta($item['video_id'], '_wp_attachment_image_alt', TRUE) : 'Imagem' ?>" class="testimonials__item">
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
$args_blog = array(
    'post_type'      => 'post',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
);
query_posts($args_blog);

if (have_posts()) :
?>
    <section class="blog-list">
        <div class="container wrap">
            <div class="blog-list__header">
                <h2 class="blog-list__title title"><strong>Blog | </strong>Fique por dentro</h2>
                <a href="<?= get_home_url() . '/blog' ?>" class="blog-list__button btn btn--gold">Ver todos</a>
            </div>
            <div class="blog-list__list">
                <?php $i = 0;
                $duration = 400;
                while (have_posts()) :
                    the_post();
                ?>
                    <div class="blog-list__item">
                        <a href="<?= get_permalink() ?>" class="">
                            <img src="<?= has_post_thumbnail() ? get_the_post_thumbnail_url('', 'medium_large') : "https://placehold.co/506x320" ?>" alt="<?= has_post_thumbnail() ? get_alt(get_post_thumbnail_id()) : "Imagem do post " . get_the_title() ?>" class="blog-list__item-img">
                        </a>
                        <a href="<?= get_permalink() ?>">
                            <h3 class="blog-list__item-title title"><?= get_the_title() ?></h3>
                        </a>
                    </div>
                <?php $i++;
                    $duration += 200;
                endwhile; ?>
                <?php wp_reset_query(); ?>
            </div>

            <div class="blog-list__button-area">
                <a href="<?= get_home_url() . '/blog' ?>" class="blog-list__button btn btn--gold">Ver todos</a>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty(get_option('opt_page_theme_options')['contact_show'])): ?>
    <section class="contacts">
        <div class="container wrap">
            <div class="contacts__header">
                <?php if (!empty(get_option('opt_page_theme_options')['contact_pretitle'])): ?>
                    <strong class="contacts__subtitle"><?= get_option('opt_page_theme_options')['contact_pretitle'] ?></strong>
                <?php endif; ?>
                <?php if (!empty(get_option('opt_page_theme_options')['contact_title'])): ?>
                    <h2 class="contacts__title title"><?= get_option('opt_page_theme_options')['contact_title'] ?></h2>
                <?php endif; ?>
            </div>
            <div class="contacts__list">
                <?php foreach (get_option('opt_page_theme_options')['contacts'] as $index => $item): ?>
                    <div class="contacts__item">
                        <?php if (!empty($item['icon'])): ?>
                            <img src="<?= $item['icon'] ?>" alt="<?= !empty(get_post_meta($item['icon'], '_wp_attachment_image_alt', TRUE)) ? get_post_meta($item['icon'], '_wp_attachment_image_alt', TRUE) : 'Ícone de contato' ?>" class="contacts__item-icon">
                        <?php endif; ?>
                        <?php if (!empty($item['title'])): ?>
                            <h3 class="contacts__item-title"><?= $item['title'] ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($item['desc'])): ?>
                            <div class="contacts__item-desc">
                                <?= wpautop($item['desc']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer() ?>