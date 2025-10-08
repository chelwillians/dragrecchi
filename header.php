<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/dist/css/style.min.css">

    <?php wp_head() ?>
</head>

<body <?php body_class() ?>>
    <?php wp_body_open(); ?>
    <header class="main-header main-header--float <?= !empty($args['class']) && isset($args['class']) ? $args['class'] : '' ?>">
        <div class="container wrap">
            <a href="<?= get_home_url() ?>" class="main-header__logo">
                <img src="<?php echo !empty(get_option('opt_page_theme_options')['logo']) ? get_option('opt_page_theme_options')['logo'] : get_template_directory_uri() . '/dist/images/logo.svg' ?>" alt="Logo">
            </a>
            <?php
            $menu = get_menu_items('menu_header');
            if (count($menu) > 0):
            ?>
                <nav class="main-header__menu">
                    <ul class="main-header__menu-content">
                        <?php foreach ($menu as $item): ?>
                            <li class="main-header__menu-item"><a title="Link para <?= $item->title ?>" href="<?= $item->url ?>"><?= $item->title ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if (!empty(get_option('opt_page_theme_options')['link_btn_header'])): ?>
                        <a href="<?= get_option('opt_page_theme_options')['link_btn_header'] ?>" class="main-header__menu-button btn btn--default"><?php echo !empty(get_option('opt_page_theme_options')['text_btn_header']) ? get_option('opt_page_theme_options')['text_btn_header'] : "Agendar" ?></a>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>
            <?php if (!empty(get_option('opt_page_theme_options')['link_btn_header'])): ?>
                <div class="main-header__actions">
                    <a href="<?= get_option('opt_page_theme_options')['link_btn_header'] ?>" class="main-header__button btn btn--default"><?php echo !empty(get_option('opt_page_theme_options')['text_btn_header']) ? get_option('opt_page_theme_options')['text_btn_header'] : "Agendar" ?></a>
                </div>
            <?php endif; ?>
            <div class="main-header__hamburguer">
                <span></span>
            </div>
        </div>
    </header>