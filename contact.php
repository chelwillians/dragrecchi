<?php

/*
* Template Name: Contato
*/

get_header() ?>

<?php if (!empty(get_field_cmb2('internal_banner_show')) && !empty(get_field_cmb2('internal_sliders'))): ?>
    <h1 class="hide-title"><?= !empty(get_field_cmb2('h1_content')) ? get_field_cmb2('h1_content') : get_the_title() ?></h1>
    <section class="internal-banner">
        <div class="internal-banner__list swiper">
            <div class="swiper-wrapper">
                <?php foreach (get_field_cmb2('internal_sliders') as $index => $item): ?>
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

<?php if (!empty(get_field_cmb2('contact_form_show'))): ?>
    <section class="contact-form">
        <div class="container wrap">
            <?php if (!empty(get_field_cmb2('contact_form_desc'))): ?>
                <div class="contact-form__call">
                    <?= wpautop(get_field_cmb2('contact_form_desc')) ?>
                </div>
            <?php endif; ?>
            <div class="contact-form__wrap">
                <?= do_shortcode(get_field_cmb2('contact_form_shortcode'))?>
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
        </div>
    </section>
<?php endif; ?>

<?php get_footer() ?>