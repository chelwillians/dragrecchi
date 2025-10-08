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
        'about.php',
        'procedures.php',
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

function register_cpt_procedimentos()
{
    register_post_type('procedimentos', array(
        'publicly_queryable'  => true,
        'labels' => array(
            'name' => 'Procedimentos',
            'singular_name' => 'Procedimento',
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
            'slug'       => 'procedimentos'
        )
    ));
}
add_action('init', 'register_cpt_procedimentos');

// Fields
function cmb2_h1_title()
{
    $cmb_h1_title = new_cmb2_box(array(
        'id'            => 'cmb2_h1',
        'title'         => __('H1', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => ['index.php', 'about.php', 'procedures.php']),
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
        'show_on' => array('key' => 'page-template', 'value' => ['index.php', 'about.php']),
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
        'id'      => 'pretitle',
        'name'    => 'Pré Título',
        'type'    => 'text',
    ));

    $cmb_main_banner->add_group_field($banners, array(
        'id'      => 'title',
        'name'    => 'Título',
        'type'    => 'text',
    ));

    $cmb_main_banner->add_group_field($banners, array(
        'id'      => 'link_btn',
        'name'    => 'Link',
        'type'    => 'text',
    ));

    $cmb_main_banner->add_group_field($banners, array(
        'id'      => 'text_btn',
        'name'    => 'Texto botão',
        'type'    => 'text',
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
        'id'   => 'about_desc',
        'name' => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    // $cmb_about->add_field(array(
    //     'id'   => 'about_link',
    //     'name' => 'Link botão',
    //     'type' => 'text',
    // ));

    // $cmb_about->add_field(array(
    //     'id'   => 'about_text_button',
    //     'name' => 'Texto botão',
    //     'type' => 'text',
    // ));

    $cmb_about->add_field(array(
        'id'   => 'about_image',
        'name' => 'Imagem',
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

function cmb2_procedures()
{
    $cmb_procedures = new_cmb2_box(array(
        'id'            => 'cmb2_procedures',
        'title'         => __('Seção - Procedimentos', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_procedures->add_field(array(
        'id'   => 'procedures_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_procedures->add_field(array(
        'id'   => 'procedures_title',
        'name' => 'Título ',
        'type' => 'text',
    ));

    $cmb_procedures->add_field(array(
        'id'   => 'procedures_desc',
        'name' => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_procedures->add_field(array(
        'id'      => 'procedures_link_btn',
        'name'    => 'Link',
        'type'    => 'text',
    ));

    $cmb_procedures->add_field(array(
        'id'      => 'procedures_text_btn',
        'name'    => 'Texto botão',
        'type'    => 'text',
    ));
}
add_action('cmb2_admin_init', 'cmb2_procedures');

function cmb2_text_image_list()
{
    $cmb_text_image_list = new_cmb2_box(array(
        'id'            => 'cmb2_text_image_list',
        'title'         => __('Seção - Texto com imagem e lista', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_text_image_list->add_field(array(
        'id'   => 'text_image_list_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_text_image_list->add_field(array(
        'id'   => 'text_image_list_title',
        'name' => 'Título ',
        'type' => 'text',
    ));

    $cmb_text_image_list->add_field(array(
        'id'   => 'text_image_list_desc',
        'name' => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_text_image_list->add_field(array(
        'id'   => 'text_image_list_image',
        'name' => 'Imagem',
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

    $list = $cmb_text_image_list->add_field(array(
        'id'          => 'list',
        'type'        => 'group',
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Item {#} da lista', 'cmb2'),
            'add_button'        => __('Adicionar', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'closed'         => true,
            'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
        ),
    ));

    $cmb_text_image_list->add_group_field($list, array(
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

    $cmb_text_image_list->add_group_field($list, array(
        'id'      => 'text',
        'name'    => 'Texto',
        'type'    => 'text',
    ));
}
add_action('cmb2_admin_init', 'cmb2_text_image_list');

function cmb2_testmonials()
{
    $cmb_testmonials = new_cmb2_box(array(
        'id'            => 'cmb2_testmonials',
        'title'         => __('Seção - Depoimentos', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_testmonials->add_field(array(
        'id'   => 'testmonials_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_testmonials->add_field(array(
        'id'   => 'testmonials_title',
        'name' => 'Título ',
        'type' => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cmb_testmonials->add_field(array(
        'id'   => 'testmonials_desc',
        'name' => 'Descrição ',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $testmonials = $cmb_testmonials->add_field(array(
        'id'          => 'testmonials',
        'type'        => 'group',
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Depoimento {#}', 'cmb2'),
            'add_button'        => __('Adicionar', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'closed'         => true,
            'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
        ),
    ));

    $cmb_testmonials->add_group_field($testmonials, array(
        'id'      => 'video',
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
            'type' => array('video/mp4'),
        ),
        'preview_size' => 'medium',
    ));

    // $cmb_testmonials->add_group_field($testmonials, array(
    //     'id'      => 'poster',
    //     'name' => 'Capa do vídeo',
    //     'type'    => 'file',
    //     'options' => array(
    //         'url' => false,
    //     ),
    //     'text'    => array(
    //         'add_upload_file_text' => 'Adicionar vídeo'
    //     ),
    //     'query_args' => array(
    //         'type' => array('video/webm'),
    //     ),
    //     'preview_size' => 'medium',
    // ));
}
add_action('cmb2_admin_init', 'cmb2_testmonials');

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
        'id'   => 'contact_pretitle',
        'name' => 'Pré Título ',
        'type' => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cmb_contact->add_field(array(
        'id'   => 'contact_title',
        'name' => 'Título ',
        'type' => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $contacts = $cmb_contact->add_field(array(
        'id'          => 'contacts',
        'type'        => 'group',
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Contato {#}', 'cmb2'),
            'add_button'        => __('Adicionar', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'closed'         => true,
            'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
        ),
    ));

    $cmb_contact->add_group_field($contacts, array(
        'id'      => 'icon',
        'name' => 'Ícone',
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

    $cmb_contact->add_group_field($contacts, array(
        'id'      => 'title',
        'name' => 'Título',
        'type'    => 'text',
    ));

    $cmb_contact->add_group_field($contacts, array(
        'id'      => 'desc',
        'name' => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));
}
add_action('cmb2_admin_init', 'cmb2_contact');

function cmb2_text_image()
{
    $cmb_text_image = new_cmb2_box(array(
        'id'            => 'cmb2_text_image',
        'title'         => __('Seção - Imagem e Texto', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'about.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_text_image->add_field(array(
        'id'   => 'text_image_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_text_image->add_field(array(
        'id'   => 'text_image_title',
        'name' => 'Título ',
        'type' => 'text',
    ));

    $cmb_text_image->add_field(array(
        'id'   => 'text_image_desc',
        'name' => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    // $cmb_text_image->add_field(array(
    //     'id'   => 'text_image_link',
    //     'name' => 'Link botão',
    //     'type' => 'text',
    // ));

    // $cmb_text_image->add_field(array(
    //     'id'   => 'text_image_text_button',
    //     'name' => 'Texto botão',
    //     'type' => 'text',
    // ));

    $cmb_text_image->add_field(array(
        'id'   => 'text_image_image',
        'name' => 'Imagem',
        'desc'    => 'Resolução recomendada de 600x460',
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
add_action('cmb2_admin_init', 'cmb2_text_image');

function cmb2_video()
{
    $cmb_video = new_cmb2_box(array(
        'id'            => 'cmb2_video',
        'title'         => __('Seção - Vídeo', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'about.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_video->add_field(array(
        'id'   => 'video_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_video->add_field(array(
        'id'   => 'video_title',
        'name' => 'Título ',
        'type' => 'text',
    ));

    $cmb_video->add_field(array(
        'id'   => 'video_iframe',
        'name' => 'Iframe do vídeo',
        'type'    => 'textarea',
        'sanitization_cb' => 'prefix_sanitize_iframe'
    ));
}
add_action('cmb2_admin_init', 'cmb2_video');

function cmb2_text_image_2()
{
    $cmb_text_image_2 = new_cmb2_box(array(
        'id'            => 'cmb2_text_image_2',
        'title'         => __('Seção - Imagem e Texto', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'about.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_text_image_2->add_field(array(
        'id'   => 'text_image_2_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_text_image_2->add_field(array(
        'id'   => 'text_image_2_title',
        'name' => 'Título ',
        'type' => 'text',
    ));

    $cmb_text_image_2->add_field(array(
        'id'   => 'text_image_2_desc',
        'name' => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    // $cmb_text_image_2->add_field(array(
    //     'id'   => 'text_image_2_link',
    //     'name' => 'Link botão',
    //     'type' => 'text',
    // ));

    // $cmb_text_image_2->add_field(array(
    //     'id'   => 'text_image_2_text_button',
    //     'name' => 'Texto botão',
    //     'type' => 'text',
    // ));

    $cmb_text_image_2->add_field(array(
        'id'   => 'text_image_2_image',
        'name' => 'Imagem',
        'desc'    => 'Resolução recomendada de 600x460',
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
add_action('cmb2_admin_init', 'cmb2_text_image_2');

function cmb2_faq()
{
    $cmb_faq = new_cmb2_box(array(
        'id'            => 'cmb2_faq',
        'title'         => __('Seção - FAQ', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'about.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_faq->add_field(array(
        'id'   => 'faq_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_faq->add_field(array(
        'id'   => 'faq_title',
        'name' => 'Título ',
        'type' => 'text',
    ));

    $cmb_faq->add_field(array(
        'id'   => 'faq_desc',
        'name' => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $faq = $cmb_faq->add_field(array(
        'id'          => 'faq_list',
        'type'        => 'group',
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('FAQ Item {#}', 'cmb2'),
            'add_button'        => __('Adicionar', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'closed'         => true,
            'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
        ),
    ));

    $cmb_faq->add_group_field($faq, array(
        'id'      => 'pergunta',
        'name' => 'Pergunta',
        'type'    => 'text',
    ));

    $cmb_faq->add_group_field($faq, array(
        'id'      => 'resposta',
        'name' => 'Resposta',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));
}
add_action('cmb2_admin_init', 'cmb2_faq');

function cmb2_internal_banner()
{
    $cmb_internal_banner = new_cmb2_box(array(
        'id'            => 'cmb2_internal_banner',
        'title'         => __('Seção - Banner', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => ['procedures.php']),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_internal_banner->add_field(array(
        'id'   => 'internal_banner_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $internal_banners = $cmb_internal_banner->add_field(array(
        'id'          => 'internal_sliders',
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

    $cmb_internal_banner->add_group_field($internal_banners, array(
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

    $cmb_internal_banner->add_group_field($internal_banners, array(
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

    $cmb_internal_banner->add_group_field($internal_banners, array(
        'id'      => 'pretitle',
        'name'    => 'Pré Título',
        'type'    => 'text',
    ));

    $cmb_internal_banner->add_group_field($internal_banners, array(
        'id'      => 'title',
        'name'    => 'Título',
        'type'    => 'text',
    ));

    // $cmb_internal_banner->add_group_field($internal_banners, array(
    //     'id'      => 'link_btn',
    //     'name'    => 'Link',
    //     'type'    => 'text',
    // ));

    // $cmb_internal_banner->add_group_field($internal_banners, array(
    //     'id'      => 'text_btn',
    //     'name'    => 'Texto botão',
    //     'type'    => 'text',
    // ));
}
add_action('cmb2_admin_init', 'cmb2_internal_banner');

function cmb2_call_text()
{
    $cmb_call_text = new_cmb2_box(array(
        'id'            => 'cmb2_call_text',
        'title'         => __('Seção - Chamada', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => ['procedures.php']),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_call_text->add_field(array(
        'id'   => 'call_text_show',
        'name' => 'Mostrar seção? ',
        'type' => 'checkbox',
    ));

    $cmb_call_text->add_field(array(
        'id'   => 'call_text_title',
        'name' => 'Título ',
        'type' => 'text',
    ));

    $cmb_call_text->add_field(array(
        'id'   => 'call_text_desc',
        'name' => 'Descrição ',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));
}
add_action('cmb2_admin_init', 'cmb2_call_text');
