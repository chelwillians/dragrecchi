<?php

/*
* Template Name: Blog
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

<?php if (!empty(get_field_cmb2('call_text_show'))): ?>
    <section class="call-text">
        <div class="container wrap">
            <?php if (!empty(get_field_cmb2('call_text_title'))): ?>
                <h2 class="call-text__title title"><?= get_field_cmb2('call_text_title') ?></h2>
            <?php endif; ?>
            <?php if (!empty(get_field_cmb2('call_text_desc'))): ?>
                <div class="call-text__text-area">
                    <?= wpautop(get_field_cmb2('call_text_desc')) ?>
                </div>
            <?php endif; ?>
            <section class="blog-categories blog-categories--internal ">
                <div class="blog-categories__list">
                    <?php foreach (get_categories() as $category) : ?>
                        <a href="<?= get_category_link($category->term_id) ?>" class="blog-categories__item"><?= $category->name ?></a>
                    <?php endforeach; ?>
                </div>
            </section>
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
    <section class="blog-list blog-list--transparent blog-list--only-articles">
        <div class="container wrap">
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