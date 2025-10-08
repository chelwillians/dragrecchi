<?php get_header('', ['class' => 'main-header--float main-header--background']) ?>

<div class="the-content">
    <div class="container wrap">
        <h1 class="the-content__title title"><?= get_the_title() ?></h1>
        <div class="the-content__thumbnail">
            <img src="<?= has_post_thumbnail() ? get_the_post_thumbnail_url() : "https://placehold.co/600x400" ?>" alt="<?= has_post_thumbnail() ? get_alt(get_post_thumbnail_id()) : "Imagem do post " . get_the_title() ?>">
        </div>
        <?php while (have_posts()) : the_post(); ?>
            <div class="the-content__text">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer() ?>