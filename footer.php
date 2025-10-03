<footer class="main-footer">
    <div class="container wrap">
        <div class="main-footer__logo-area">
            <img src="<?php echo !empty(get_option('opt_page_theme_options')['logo_footer']) ? get_option('opt_page_theme_options')['logo_footer'] : get_template_directory_uri() . '/dist/images/logo.svg' ?>" alt="Logo">
        </div>
        <?php if (!empty(get_option('opt_page_theme_options')['desc_footer'])): ?>
            <div class="main-footer__text">
                <p><?= get_option('opt_page_theme_options')['desc_footer'] ?></p>
            </div>
        <?php endif; ?>
        <?php
        $menu_footer_1 = get_menu_items('menu_footer');
        if (count($menu_footer_1) > 0):
        ?>
            <div class="main-footer__menu-area">
                <h2 class="main-footer__menu-title"><?= count($menu_footer_1) > 0 ? wp_get_nav_menu_name('menu_footer') : '' ?></h2>
                <ul class="main-footer__menu">
                    <?php foreach ($menu_footer_1 as $item): ?>
                        <li class="main-footer__menu-item"><a title="Link para <?= $item->title ?>" href="<?= $item->url ?>"><?= $item->title ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php
        $menu_footer_2 = get_menu_items('menu_footer_2');
        if (count($menu_footer_2) > 0):
        ?>
            <div class="main-footer__menu-area">
                <h2 class="main-footer__menu-title"><?= count($menu_footer_2) > 0 ? wp_get_nav_menu_name('menu_footer_2') : '' ?></h2>
                <ul class="main-footer__menu">
                    <?php foreach ($menu_footer_2 as $item): ?>
                        <li class="main-footer__menu-item"><a title="Link para <?= $item->title ?>" href="<?= $item->url ?>"><?= $item->title ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="main-footer__social-area">
            <h2 class="main-footer__social-title">Social</h2>
            <ul class="main-footer__social">
                <?php if (!empty(get_option('opt_page_theme_options')['desc_footer'])): ?>
                    <li class="main-footer__social-item"><a href="<?= get_option('opt_page_theme_options')['desc_footer'] ?>"><img src="https://placehold.co/24" alt=""></a></li>
                <?php endif; ?>
                <?php if (!empty(get_option('opt_page_theme_options')['desc_footer'])): ?>
                    <li class="main-footer__social-item"><a href="<?= get_option('opt_page_theme_options')['desc_footer'] ?>"><img src="https://placehold.co/24" alt=""></a></li>
                <?php endif; ?>
                <?php if (!empty(get_option('opt_page_theme_options')['desc_footer'])): ?>
                    <li class="main-footer__social-item"><a href="<?= get_option('opt_page_theme_options')['desc_footer'] ?>"><img src="https://placehold.co/24" alt=""></a></li>
                <?php endif; ?>
                <?php if (!empty(get_option('opt_page_theme_options')['desc_footer'])): ?>
                    <li class="main-footer__social-item"><a href="<?= get_option('opt_page_theme_options')['desc_footer'] ?>"><img src="https://placehold.co/24" alt=""></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</footer>
<div class="copyright">
    <div class="container wrap">
        <p><?= date('Y') ?>. Todos os direito Reservadodos.</p>
        <p>Desenvolvido por <a target="_blank" href="https://michelwillians.com">Michel Willians</a>.</p>
    </div>
</div>

<script src="<?= get_template_directory_uri() ?>/dist/js/main.min.js"></script>
<?php wp_footer() ?>
</body>

</html>