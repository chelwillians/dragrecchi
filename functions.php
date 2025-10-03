<?php

add_theme_support('post-thumbnails');

// Desabilitar suporte a comentários e trackbacks em todos os post types
function disable_comments_support()
{
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'disable_comments_support');

// Remover o menu de comentários no admin
function disable_comments_admin_menu()
{
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'disable_comments_admin_menu');

// Redirecionar ao tentar acessar a tela de comentários no admin
function disable_comments_admin_redirect()
{
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', 'disable_comments_admin_redirect');

// Remover o widget de comentários do Dashboard
function disable_comments_dashboard()
{
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'disable_comments_dashboard');

// Remover template de comentários no front-end
add_filter('comments_template', '__return_empty_string');

// disable api
add_filter('xmlrpc_enabled', '__return_false');


// Functions
function hide_editor()
{
    // Obtém o ID do Post
    $post_id = filter_input(INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT)
        ?? filter_input(INPUT_POST, 'post_ID', FILTER_SANITIZE_NUMBER_INT);

    if (!$post_id) {
        return; // Sai se não houver um ID de post válido
    }

    // Obtém o nome do arquivo de template da página
    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    // Lista de templates que ocultam o editor
    $templates_to_hide_editor = [
        'index.php',
    ];

    // Remove o suporte ao editor para templates especificados
    if (in_array($template_file, $templates_to_hide_editor, true)) {
        remove_post_type_support('page', 'editor');
    }
}
add_action('admin_init', 'hide_editor');

//Pagination
function pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged)) $paged = 1;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    if (1 != $pages) {
        echo "<div class=\"pagination\">";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link(1) . "'>&laquo; &laquo;</a>";
        if ($paged > 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a>";
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<span class=\"current\">" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class=\"inactive\">" . $i . "</a>";
            }
        }
        if ($paged < $pages && $showitems < $pages) echo "<a href=\"" . get_pagenum_link($paged + 1) . "\">&rsaquo;</a>";
        if ($paged < $pages - 1 &&  $paged + $range - 1 < $pages && $showitems < $pages) echo "<a href='" . get_pagenum_link($pages) . "'>&raquo; &raquo;</a>";
        echo "</div>\n";
    }
}

// Menus
function get_menu_items($menu_name)
{
    $menu = get_nav_menu_locations();
    $menu_id = $menu[$menu_name];
    return wp_get_nav_menu_items($menu_id);
}

function menu_header()
{
    register_nav_menu('menu_header', __('Menu Header'));
}
add_action('init', 'menu_header');

function menu_footer()
{
    register_nav_menu('menu_footer', __('Menu Footer 1'));
    register_nav_menu('menu_footer_2', __('Menu Footer 2'));
}
add_action('init', 'menu_footer');

// Functions CMB2
function prefix_sanitize_text_callback($value, $field_args, $field)
{
    $value = strip_tags($value, '<p><a><br><br/><strong><b><span>');

    return $value;
}

function prefix_sanitize_iframe($value, $field_args, $field)
{
    $value = strip_tags($value, '<iframe>');

    return $value;
}

function prefix_sanitize_simulate($value, $field_args, $field)
{
    $value = strip_tags($value, '<div><script>');

    return $value;
}

function get_field_cmb2($key, $page_id = 0)
{
    $id = $page_id !== 0 ? $page_id : get_the_ID();
    return get_post_meta($id, $key, true);
}

function the_field_cmb2($key, $page_id = 0)
{
    echo get_field_cmb2($key, $page_id);
}

function get_alt($key)
{
    return get_post_meta($key, '_wp_attachment_image_alt', TRUE);
}

// Options page - Geral
function opt_page_register_theme_options_metabox()
{
    $cmb_options = new_cmb2_box(array(
        'id'           => 'opt_page_theme_options_page',
        'title'        => 'Definições Gerais',
        'object_types' => array('options-page'),
        'option_key'   => 'opt_page_theme_options',
        'icon_url'     => 'dashicons-edit-large',
        'display_cb'   => 'opt_page_theme_options_page_output', // Override the options-page form output (CMB2_Hookup::options_page_output()).
    ));

    $cmb_options->add_field(array(
        'id'   => 'cmb2_title_general',
        'name' => 'Geral',
        'type' => 'title',
    ));

    $cmb_options->add_field(array(
        'id'      => 'logo',
        'name'    => 'Logo',
        // 'desc'    => 'Resolução recomendada de 108x33',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar arquivo'
        ),
        'query_args' => array(
            'type' => array('image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'),
        ),
        'preview_size' => 'large',
    ));

    $cmb_options->add_field(array(
        'name' => 'Link botão header',
        'id' => 'link_btn_header',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'name' => 'Texto botão header',
        'id' => 'text_btn_header',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'id'   => 'cmb2_title_footer',
        'name' => 'Footer',
        'type' => 'title',
    ));

     $cmb_options->add_field(array(
        'id'      => 'logo_footer',
        'name'    => 'Logo footer',
        // 'desc'    => 'Resolução recomendada de 108x33',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar arquivo'
        ),
        'query_args' => array(
            'type' => array('image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'),
        ),
        'preview_size' => 'large',
    ));

    $cmb_options->add_field(array(
        'id'   => 'desc_footer',
        'name' => 'Descrição footer',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'id'   => 'endereco',
        'name' => 'Endereço',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'id'   => 'telefone',
        'name' => 'Telefone',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'id'   => 'whatsapp',
        'name' => 'Whatsapp',
        'type' => 'text',
    ));

    $cmb_options->add_field(array(
        'id'   => 'email',
        'name' => 'E-mail',
        'type' => 'text',
    ));
}
add_action('cmb2_admin_init', 'opt_page_register_theme_options_metabox');

function register_cpt_produtos()
{
    register_post_type('produtos', array(
        'publicly_queryable'  => true,
        'labels' => array(
            'name' => 'Produtos',
            'singular_name' => 'Produto',
            'add_new_item' => 'Adiconar novo',
        ),
        'show_in_rest' => true,
        'supports' => array(
            'title',
            'thumbnail',
        ),
        'public' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-grid-view',
        'rewrite' => array(
            'with_front' => false,
            'slug'       => 'produtos'
        )
    ));
}
add_action('init', 'register_cpt_produtos');

// Fields
function cmb2_h1_title()
{
    $cmb_h1_title = new_cmb2_box(array(
        'id'            => 'cmb2_h1',
        'title'         => __('H1', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => ['index.php']),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_h1_title->add_field(array(
        'id'   => 'h1_content',
        'name' => 'Título H1 ',
        'type' => 'text',
    ));
}
add_action('cmb2_admin_init', 'cmb2_h1_title');

function cmb2_main_banner()
{
    $cmb_main_banner = new_cmb2_box(array(
        'id'            => 'cmb2_banner',
        'title'         => __('Seção - Banner', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_main_banner->add_field(array(
        'id'   => 'banner_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $banners = $cmb_main_banner->add_field(array(
        'id'          => 'sliders',
        'type'        => 'group',
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Slider {#}', 'cmb2'),
            'add_button'        => __('Adicionar slide', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'closed'         => true,
            'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
        ),
    ));

    $cmb_main_banner->add_group_field($banners, array(
        'id'      => 'image_desk',
        'name'    => 'Imagem Desktop',
        'desc'    => 'Resolução recomendada de 1920x724',
        'type'    => 'file',
        'options' => array(
            'url' => false,
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array('image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'),
        ),
        'preview_size' => 'medium',
    ));

    $cmb_main_banner->add_group_field($banners, array(
        'id'      => 'image_mobile',
        'name'    => 'Imagem Mobile',
        'desc'    => 'Resolução recomendada de 1080x1080',
        'type'    => 'file',
        'options' => array(
            'url' => false,
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array('image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'),
        ),
        'preview_size' => 'medium',
    ));

    $cmb_main_banner->add_group_field($banners, array(
        'id'      => 'title',
        'name'    => 'Título',
        'type'    => 'text',
    ));

    $cmb_main_banner->add_group_field($banners, array(
        'id'      => 'desc',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));
}
add_action('cmb2_admin_init', 'cmb2_main_banner');

function cmb2_about()
{
    $cmb_about = new_cmb2_box(array(
        'id'            => 'cmb2_about',
        'title'         => __('Seção - Sobre', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_about->add_field(array(
        'id'   => 'about_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_about->add_field(array(
        'id'   => 'about_title',
        'name' => 'Título ',
        'type' => 'text',
    ));

    $cmb_about->add_field(array(
        'id'   => 'about_subtitle',
        'name' => 'Subtítulo ',
        'type' => 'text',
    ));

    $cmb_about->add_field(array(
        'id'   => 'about_desc',
        'name' => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_about->add_field(array(
        'id'   => 'about_link',
        'name' => 'Link botão',
        'type' => 'text',
    ));

    $cmb_about->add_field(array(
        'id'   => 'about_text_button',
        'name' => 'Texto botão',
        'type' => 'text',
    ));

    $cmb_about->add_field(array(
        'id'   => 'about_image',
        'name' => 'Texto botão',
        'desc'    => 'Resolução recomendada de 1372x1074',
        'type'    => 'file',
        'options' => array(
            'url' => false,
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array('image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'),
        ),
        'preview_size' => 'medium',
    ));
}
add_action('cmb2_admin_init', 'cmb2_about');

function cmb2_telas()
{
    $cmb_telas = new_cmb2_box(array(
        'id'            => 'cmb2_telas',
        'title'         => __('Seção - Telas', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_telas->add_field(array(
        'id'   => 'telas_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_telas->add_field(array(
        'id'   => 'telas_title',
        'name' => 'Título ',
        'type' => 'text',
    ));

    $cmb_telas->add_field(array(
        'id'   => 'telas_desc',
        'name' => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_telas->add_field(array(
        'id'   => 'telas_subtitle',
        'name' => 'Subtítulo ',
        'type' => 'text',
    ));

    $telas = $cmb_telas->add_field(array(
        'id'          => 'telas',
        'type'        => 'group',
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Tela {#}', 'cmb2'),
            'add_button'        => __('Adicionar tela', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'closed'         => true,
            'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
        ),
    ));

    $cmb_telas->add_group_field($telas, array(
        'id'      => 'title',
        'name'    => 'Título',
        'type'    => 'text',
    ));

    $cmb_telas->add_group_field($telas, array(
        'id'      => 'desc',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_telas->add_group_field($telas, array(
        'id'      => 'icon',
        'name'    => 'Ícone',
        'desc'    => 'Resolução recomendada de 42x42',
        'type'    => 'file',
        'options' => array(
            'url' => false,
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array('image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'),
        ),
        'preview_size' => 'medium',
    ));

    $cmb_telas->add_group_field($telas, array(
        'id'      => 'image',
        'name'    => 'Imagem Desktop',
        'desc'    => 'Resolução recomendada de 588x485',
        'type'    => 'file',
        'options' => array(
            'url' => false,
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array('image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'),
        ),
        'preview_size' => 'medium',
    ));
}
add_action('cmb2_admin_init', 'cmb2_telas');

function cmb2_points()
{
    $cmb_points = new_cmb2_box(array(
        'id'            => 'cmb2_points',
        'title'         => __('Seção - Pontos', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_points->add_field(array(
        'id'   => 'points_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_points->add_field(array(
        'id'   => 'points_title',
        'name' => 'Título ',
        'type' => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cmb_points->add_field(array(
        'id'   => 'points_video',
        'name' => 'Vídeo',
        'type'    => 'file',
        'options' => array(
            'url' => false,
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar vídeo'
        ),
        'query_args' => array(
            'type' => array('video/webm'),
        ),
        'preview_size' => 'medium',
    ));

    $cmb_points->add_field(array(
        'id'   => 'points_video_poster',
        'name' => 'Poster',
        'desc' => 'Imagem de carregamento do vídeo',
        'type'    => 'file',
        'options' => array(
            'url' => false,
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar vídeo'
        ),
        'query_args' => array(
            'type' => array('image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'),
        ),
        'preview_size' => 'medium',
    ));

    $points = $cmb_points->add_field(array(
        'id'          => 'points',
        'type'        => 'group',
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Ponto {#}', 'cmb2'),
            'add_button'        => __('Adicionar ponto', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'closed'         => true,
            'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
        ),
    ));

    $cmb_points->add_group_field($points, array(
        'id'      => 'desc',
        'name'    => 'Descrição',
        'type'    => 'text',
    ));

    $cmb_points->add_group_field($points, array(
        'id'      => 'icon',
        'name'    => 'Ícone',
        'desc'    => 'Resolução recomendada de 42x42',
        'type'    => 'file',
        'options' => array(
            'url' => false,
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array('image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'),
        ),
        'preview_size' => 'medium',
    ));
}
add_action('cmb2_admin_init', 'cmb2_points');

function cmb2_products()
{
    $cmb_products = new_cmb2_box(array(
        'id'            => 'cmb2_products',
        'title'         => __('Seção - Produtos', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_products->add_field(array(
        'id'   => 'products_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_products->add_field(array(
        'id'   => 'products_title',
        'name' => 'Título',
        'type' => 'text',
    ));

    $cmb_products->add_field(array(
        'id'   => 'products_desc',
        'name' => 'Descrição ',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_products->add_field(array(
        'id'   => 'products_text_button',
        'name' => 'Texto botão',
        'type' => 'text',
    ));

    $cmb_products->add_field(array(
        'id'   => 'products_link_button',
        'name' => 'Link botão',
        'type' => 'text',
    ));
}
add_action('cmb2_admin_init', 'cmb2_products');

function cmb2_commitments()
{
    $cmb_commitments = new_cmb2_box(array(
        'id'            => 'cmb2_commitments',
        'title'         => __('Seção - Compromissos', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_commitments->add_field(array(
        'id'   => 'commitments_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_commitments->add_field(array(
        'id'   => 'commitments_bg',
        'name' => 'Imagem de fundo',
        'type'    => 'file',
        'options' => array(
            'url' => false,
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array('image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'),
        ),
        'preview_size' => 'medium',
    ));

    $cmb_commitments->add_field(array(
        'id'   => 'commitments_title',
        'name' => 'Título',
        'type' => 'text',
    ));

    $commitments = $cmb_commitments->add_field(array(
        'id'          => 'commitments',
        'type'        => 'group',
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Compromisso {#}', 'cmb2'),
            'add_button'        => __('Adicionar compromisso', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'closed'         => true,
            'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
        ),
    ));

    $cmb_commitments->add_group_field($commitments, array(
        'id'      => 'title',
        'name'    => 'Título',
        'type'    => 'text',
    ));

    $cmb_commitments->add_group_field($commitments, array(
        'id'      => 'desc',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));
}
add_action('cmb2_admin_init', 'cmb2_commitments');

function cmb2_logos_1()
{
    $cmb_logos_1 = new_cmb2_box(array(
        'id'            => 'cmb2_logos_1',
        'title'         => __('Seção - Logos 1', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_logos_1->add_field(array(
        'id'   => 'logos_1_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_logos_1->add_field(array(
        'id'   => 'logos_1_pre_title',
        'name' => 'Pré título ',
        'type' => 'text',
    ));

    $cmb_logos_1->add_field(array(
        'id'   => 'logos_1_title',
        'name' => 'Título ',
        'type' => 'text',
    ));

    $logos = $cmb_logos_1->add_field(array(
        'id'          => 'logos_1',
        'type'        => 'group',
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Logo {#}', 'cmb2'),
            'add_button'        => __('Adicionar logo', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'closed'         => true,
            'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
        ),
    ));
    $cmb_logos_1->add_group_field($logos, array(
        'id'      => 'logo',
        'name'    => 'Logo',
        'desc'    => 'Resolução recomendada de 356x100',
        'type'    => 'file',
        'options' => array(
            'url' => false,
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array('image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'),
        ),
        'preview_size' => 'medium',
    ));
}
add_action('cmb2_admin_init', 'cmb2_logos_1');

function cmb2_logos_2()
{
    $cmb_logos_2 = new_cmb2_box(array(
        'id'            => 'cmb2_logos_2',
        'title'         => __('Seção - Logos 2', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_logos_2->add_field(array(
        'id'   => 'logos_2_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_logos_2->add_field(array(
        'id'   => 'logos_2_pre_title',
        'name' => 'Pré título ',
        'type' => 'text',
    ));

    $cmb_logos_2->add_field(array(
        'id'   => 'logos_2_title',
        'name' => 'Título ',
        'type' => 'text',
    ));

    $logos = $cmb_logos_2->add_field(array(
        'id'          => 'logos_2',
        'type'        => 'group',
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Logo {#}', 'cmb2'),
            'add_button'        => __('Adicionar logo', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'closed'         => true,
            'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
        ),
    ));
    $cmb_logos_2->add_group_field($logos, array(
        'id'      => 'logo',
        'name'    => 'Logo',
        'desc'    => 'Resolução recomendada de 356x200',
        'type'    => 'file',
        'options' => array(
            'url' => false,
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array('image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'),
        ),
        'preview_size' => 'medium',
    ));
}
add_action('cmb2_admin_init', 'cmb2_logos_2');

function cmb2_contact()
{
    $cmb_contact = new_cmb2_box(array(
        'id'            => 'cmb2_contact',
        'title'         => __('Seção - Contato', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_contact->add_field(array(
        'id'   => 'contact_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_contact->add_field(array(
        'id'   => 'contact_title',
        'name' => 'Título ',
        'type' => 'text',
    ));

    $cmb_contact->add_field(array(
        'id'   => 'contact_desc',
        'name' => 'Descrição',
        'type'    => 'text',
    ));

     $cmb_contact->add_field(array(
        'id'   => 'contact_shortcode',
        'name' => 'Shortcode',
        'type'    => 'text',
    ));

     $cmb_contact->add_field(array(
        'id'   => 'contact_shortcode',
        'name' => 'Shortcode',
        'type'    => 'text',
    ));
}
add_action('cmb2_admin_init', 'cmb2_contact');
