<?php

/*
* Template Name: Sobre
*/

get_header() ?>

<?php if (!empty(get_field_cmb2('banner_show')) && !empty(get_field_cmb2('sliders'))): ?>
    <h1 class="hide-title"><?= !empty(get_field_cmb2('h1_content')) ? get_field_cmb2('h1_content') : get_the_title() ?></h1>
    <section class="internal-banner">
        <div class="internal-banner__list swiper">
            <div class="swiper-wrapper">
                <?php foreach (get_field_cmb2('sliders') as $index => $item): ?>
                    <div class="internal-banner__item swiper-slide">
                        <?php if (!empty($item['image_desk'])): ?>
                            <img src="<?= $item['image_desk'] ?>" class="internal-banner__item-image internal-banner__item-image--desk" alt="<?= !empty(get_post_meta($item['image_desk_id'], '_wp_attachment_image_alt', TRUE)) ? get_post_meta($item['image_desk_id'], '_wp_attachment_image_alt', TRUE) : 'Imagem do banner' ?>">
                        <?php endif; ?>
                        <?php if (!empty($item['image_desk'])): ?>
                            <img src="<?= $item['image_desk'] ?>" class="internal-banner__item-image internal-banner__item-image--mobile" alt="<?= !empty(get_post_meta($item['image_desk_id'], '_wp_attachment_image_alt', TRUE)) ? get_post_meta($item['image_desk_id'], '_wp_attachment_image_alt', TRUE) : 'Imagem do banner' ?>">
                        <?php endif; ?>
                        <div class="container wrap">
                            <?php if (!empty($item['pretitle'])): ?>
                                <span class="internal-banner__item-subtitle"><?= $item['pretitle'] ?></span>
                            <?php endif; ?>
                            <?php if (!empty($item['title'])): ?>
                                <span class="internal-banner__item-title"><?= $item['title'] ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty(get_field_cmb2('text_image_show'))): ?>
    <section class="image-text">
        <div class="container wrap">
            <div class="image-text__left">
                <?php if (!empty(get_field_cmb2('text_image_title'))): ?>
                    <h2 class="image-text__title title"><?= get_field_cmb2('text_image_title') ?></h2>
                <?php endif; ?>
                <?php if (!empty(get_field_cmb2('text_image_desc'))): ?>
                    <div class="image-text__desc">
                        <?= wpautop(get_field_cmb2('text_image_desc')) ?>
                    </div>
                <?php endif; ?>
            </div>
            <img src="<?= !empty(get_field_cmb2('text_image_image')) ? get_field_cmb2('text_image_image') : get_template_directory_uri() . '/dist/images/nose.jpg' ?>" alt="<?= !empty(get_post_meta(get_field_cmb2('text_image_image_id'), '_wp_attachment_image_alt', TRUE)) ? get_post_meta(get_field_cmb2('text_image_image_id'), '_wp_attachment_image_alt', TRUE) : 'Imagem' ?>" class="image-text__image">
        </div>
    </section>
<?php endif; ?>

<?php if (!empty(get_field_cmb2('video_show'))): ?>
    <section class="video-area">
        <div class="container wrap">
            <?php if (!empty(get_field_cmb2('video_title'))): ?>
                <h2 class="video-area__title title"><?= get_field_cmb2('video_title') ?></h2>
            <?php endif; ?>

            <?php if (!empty(get_field_cmb2('video_iframe'))): ?>
                <div class="video-area__wrap">
                    <?= do_shortcode(get_field_cmb2('video_iframe')) ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty(get_field_cmb2('text_image_2_show'))): ?>
    <section class="image-text">
        <div class="container wrap">
            <div class="image-text__left">
                <?php if (!empty(get_field_cmb2('text_image_2_title'))): ?>
                    <h2 class="image-text__title title"><?= get_field_cmb2('text_image_2_title') ?></h2>
                <?php endif; ?>
                <?php if (!empty(get_field_cmb2('text_image_2_desc'))): ?>
                    <div class="image-text__desc">
                        <?= wpautop(get_field_cmb2('text_image_2_desc')) ?>
                    </div>
                <?php endif; ?>
            </div>
            <img src="<?= !empty(get_field_cmb2('text_image_2_image')) ? get_field_cmb2('text_image_2_image') : get_template_directory_uri() . '/dist/images/nose.jpg' ?>" alt="<?= !empty(get_post_meta(get_field_cmb2('text_image_2_image_id'), '_wp_attachment_image_alt', TRUE)) ? get_post_meta(get_field_cmb2('text_image_2_image_id'), '_wp_attachment_image_alt', TRUE) : 'Imagem' ?>" class="image-text__image">
        </div>
    </section>
<?php endif; ?>

<?php if (!empty(get_field_cmb2('faq_show'))): ?>
    <section class="faq">
        <div class="container wrap">
            <div class="faq__header">
                <?php if (!empty(get_field_cmb2('faq_title'))): ?>
                    <h2 class="faq__title title"><?= get_field_cmb2('faq_title') ?></h2>
                <?php endif; ?>
                <?php if (!empty(get_field_cmb2('faq_desc'))): ?>
                    <div class="faq__desc">
                        <?= wpautop(get_field_cmb2('faq_desc')) ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="faq__list">
                <?php foreach (get_field_cmb2('faq_list') as $index => $item): ?>
                    <div class="faq__item">
                        <?php if (!empty($item['pergunta'])): ?>
                            <div class="faq__item--question"><?= $item['pergunta'] ?></div>
                        <?php endif; ?>
                        <?php if (!empty($item['resposta'])): ?>
                            <div class="faq__item--answer">
                                <?= wpautop($item['resposta']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer() ?>