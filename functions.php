<?php
if (!defined('ABSPATH')) exit;

// Include Bootstrap Walker
require_once get_template_directory() . '/inc/class-bootstrap-walker-nav-menu.php';

// Theme Setup
function newmathphys_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Главное меню', 'newmathphys'),
        'footer' => esc_html__('Меню в подвале', 'newmathphys'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'newmathphys_setup');

// Register Custom Post Types
function newmathphys_register_post_types() {
    // Articles Post Type
    register_post_type('article', array(
        'labels' => array(
            'name' => __('Статьи', 'newmathphys'),
            'singular_name' => __('Статья', 'newmathphys'),
            'add_new' => __('Добавить новую', 'newmathphys'),
            'add_new_item' => __('Добавить новую статью', 'newmathphys'),
            'edit_item' => __('Редактировать статью', 'newmathphys'),
            'new_item' => __('Новая статья', 'newmathphys'),
            'view_item' => __('Просмотреть статью', 'newmathphys'),
            'search_items' => __('Искать статьи', 'newmathphys'),
            'not_found' => __('Статьи не найдены', 'newmathphys'),
            'not_found_in_trash' => __('В корзине статьи не найдены', 'newmathphys'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'menu_icon' => 'dashicons-media-document',
        'rewrite' => array('slug' => 'article'),
    ));
}
add_action('init', 'newmathphys_register_post_types');

// Register Custom Taxonomies
function newmathphys_register_taxonomies() {
    // Categories for Articles
    register_taxonomy('article_category', array('post'), array(
        'labels' => array(
            'name' => __('Категории', 'newmathphys'),
            'singular_name' => __('Категория', 'newmathphys'),
            'menu_name' => __('Категории', 'newmathphys'),
            'all_items' => __('Все категории', 'newmathphys'),
            'edit_item' => __('Редактировать категорию', 'newmathphys'),
            'view_item' => __('Просмотреть категорию', 'newmathphys'),
            'update_item' => __('Обновить категорию', 'newmathphys'),
            'add_new_item' => __('Добавить новую категорию', 'newmathphys'),
            'new_item_name' => __('Название новой категории', 'newmathphys'),
            'search_items' => __('Искать категории', 'newmathphys'),
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => array(
            'slug' => 'category',
            'with_front' => false
        ),
        'show_in_rest' => true,
        'query_var' => true,
    ));

    // Add default categories
    $default_categories = array(
        'mathematics' => __('Математика', 'newmathphys'),
        'physics' => __('Физика', 'newmathphys'),
        'interdisciplinary' => __('Смежные', 'newmathphys'),
    );

    foreach ($default_categories as $slug => $name) {
        if (!term_exists($slug, 'article_category')) {
            wp_insert_term($name, 'article_category', array('slug' => $slug));
        }
    }
}
add_action('init', 'newmathphys_register_taxonomies');

// Enqueue scripts and styles
function newmathphys_scripts() {
    // Main stylesheet
    wp_enqueue_style('newmathphys-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Google Fonts
    wp_enqueue_style('newmathphys-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', array(), null);
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
    
    // Bootstrap CSS
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    
    // jQuery (если еще не подключен)
    if (!wp_script_is('jquery', 'enqueued')) {
        wp_enqueue_script('jquery');
    }
    
    // Bootstrap JS (без jQuery в зависимостях)
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), null, true);
    
    // Theme JavaScript (без jQuery в зависимостях)
    wp_enqueue_script('newmathphys-theme', get_template_directory_uri() . '/js/theme.js', array(), '1.0.0', true);
    
    // Markdown Editor
    wp_enqueue_script('marked', 'https://cdn.jsdelivr.net/npm/marked/marked.min.js', array(), null, true);
    wp_enqueue_script('newmathphys-markdown', get_template_directory_uri() . '/js/markdown-editor.js', array('marked'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'newmathphys_scripts');

// Editor Setup
function newmathphys_editor_setup() {
    add_editor_style('editor-style.css');
    
    // Add support for special characters in editor
    add_filter('tiny_mce_before_init', function($init) {
        $init['extended_valid_elements'] = 'span[class|style],math[*],annotation[*]';
        return $init;
    });
}
add_action('admin_init', 'newmathphys_editor_setup');

// File Upload Support
function newmathphys_upload_mimes($mimes) {
    $mimes['doc'] = 'application/msword';
    $mimes['docx'] = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    $mimes['pdf'] = 'application/pdf';
    $mimes['mp4'] = 'video/mp4';
    $mimes['webm'] = 'video/webm';
    return $mimes;
}
add_filter('upload_mimes', 'newmathphys_upload_mimes');

// Increase upload size limit
function newmathphys_upload_size_limit($size) {
    return 64 * 1024 * 1024; // 64MB
}
add_filter('upload_size_limit', 'newmathphys_upload_size_limit');

// KaTeX Support
function newmathphys_katex_scripts() {
    wp_enqueue_style('katex-css', 'https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css');
    wp_enqueue_script('katex-js', 'https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js', array(), null, true);
    wp_enqueue_script('katex-auto-render', 'https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js', array('katex-js'), null, true);
    wp_enqueue_script('newmathphys-katex-init', get_template_directory_uri() . '/js/katex-init.js', array('katex-auto-render'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'newmathphys_katex_scripts');

// Admin KaTeX Support
function newmathphys_admin_katex_scripts() {
    wp_enqueue_style('katex-css', 'https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css');
    wp_enqueue_script('katex-js', 'https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js', array(), null, true);
    wp_enqueue_script('katex-auto-render', 'https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/contrib/auto-render.min.js', array('katex-js'), null, true);
    wp_enqueue_script('newmathphys-admin-katex', get_template_directory_uri() . '/js/admin-katex.js', array('katex-auto-render'), '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'newmathphys_admin_katex_scripts');

// Custom Excerpt Length
function newmathphys_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'newmathphys_excerpt_length');

// Custom Excerpt More
function newmathphys_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'newmathphys_excerpt_more');

// Add Contact Form Shortcode
function newmathphys_contact_form_shortcode() {
    ob_start();
    ?>
    <div class="contact-form">
        <form id="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="submit_contact_form">
            <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
            
            <div class="mb-3">
                <label for="name" class="form-label"><?php _e('Имя', 'newmathphys'); ?></label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><?php _e('Email', 'newmathphys'); ?></label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label"><?php _e('Сообщение', 'newmathphys'); ?></label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><?php _e('Отправить сообщение', 'newmathphys'); ?></button>
        </form>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('contact_form', 'newmathphys_contact_form_shortcode');

// Handle Contact Form Submission
function handle_contact_form_submission() {
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
        wp_die('Ошибка безопасности');
    }

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_textarea_field($_POST['message']);

    $to = get_option('admin_email');
    $subject = 'Новое сообщение с сайта ' . get_bloginfo('name');
    $body = "Имя: $name\nEmail: $email\n\nСообщение:\n$message";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    wp_mail($to, $subject, $body, $headers);

    wp_redirect(add_query_arg('contact_sent', '1', wp_get_referer()));
    exit;
}
add_action('admin_post_submit_contact_form', 'handle_contact_form_submission');
add_action('admin_post_nopriv_submit_contact_form', 'handle_contact_form_submission');

// Add Telegram Contact Widget
function newmathphys_telegram_widget() {
    register_sidebar(array(
        'name' => __('Telegram Contact', 'newmathphys'),
        'id' => 'telegram-contact',
        'description' => __('Add your Telegram contact information here', 'newmathphys'),
        'before_widget' => '<div class="telegram-contact">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'newmathphys_telegram_widget'); 