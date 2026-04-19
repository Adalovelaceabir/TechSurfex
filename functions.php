<?php
/**
 * TechSurfex Theme Functions
 */

// Theme Setup
function techsurfex_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width' => 200,
        'flex-height' => true,
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    
    // Register Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'techsurfex'),
        'social' => __('Social Menu', 'techsurfex'),
    ));
    
    // Image Sizes
    add_image_size('featured-large', 1200, 600, true);
    add_image_size('post-card', 400, 250, true);
    add_image_size('slider-image', 1920, 800, true);
}
add_action('after_setup_theme', 'techsurfex_setup');

// Enqueue Scripts & Styles
function techsurfex_scripts() {
    // Styles
    wp_enqueue_style('techsurfex-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0');
    
    // Scripts
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true);
    wp_enqueue_script('techsurfex-main', get_template_directory_uri() . '/assets/js/main.js', array('swiper-js'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('techsurfex-main', 'techsurfex_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('techsurfex_nonce')
    ));
    
    if (is_singular()) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'techsurfex_scripts');

// Post Views Counter
function techsurfex_set_post_views() {
    if (is_single()) {
        $post_id = get_the_ID();
        $count = get_post_meta($post_id, 'post_views', true);
        $count = $count ? $count + 1 : 1;
        update_post_meta($post_id, 'post_views', $count);
    }
}
add_action('wp_head', 'techsurfex_set_post_views');

// Get Trending Posts (Last 7 days by views)
function techsurfex_get_trending_posts($limit = 6) {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'meta_key' => 'post_views',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'date_query' => array(
            'after' => date('Y-m-d', strtotime('-7 days'))
        )
    );
    return new WP_Query($args);
}

// Schema Markup (JSON-LD)
function techsurfex_schema_markup() {
    if (is_single()) {
        $post = get_post();
        $author = get_userdata($post->post_author);
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => get_the_title(),
            'url' => get_permalink(),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author(),
                'url' => get_author_posts_url($author->ID)
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
                'logo' => array(
                    '@type' => 'ImageObject',
                    'url' => get_custom_logo_url()
                )
            ),
            'mainEntityOfPage' => get_permalink(),
            'image' => get_the_post_thumbnail_url(get_the_ID(), 'full')
        );
        echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'techsurfex_schema_markup');

// Custom Walker for Mega Menu
class Mega_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        if ($depth === 0) {
            $output .= '<ul class="sub-menu mega-submenu">';
        } else {
            $output .= '<ul class="sub-menu">';
        }
    }
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        
        if ($depth === 0 && $item->menu_item_parent == 0 && in_array('menu-item-has-children', $classes)) {
            $class_names .= ' mega-menu';
        }
        
        $output .= '<li class="' . esc_attr($class_names) . '">';
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// Register Sidebars
function techsurfex_widgets_init() {
    register_sidebar(array(
        'name' => __('Main Sidebar', 'techsurfex'),
        'id' => 'sidebar-main',
        'description' => __('Main sidebar widget area', 'techsurfex'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Widgets', 'techsurfex'),
        'id' => 'footer-widgets',
        'description' => __('Footer widget area', 'techsurfex'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'techsurfex_widgets_init');

// Custom Excerpt Length
function techsurfex_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'techsurfex_excerpt_length');

// Get Custom Logo URL Helper
function get_custom_logo_url() {
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
    return $logo ? $logo[0] : get_site_icon_url();
}

// Lazy Loading Filter
function techsurfex_add_lazy_loading($content) {
    if (is_admin()) return $content;
    $content = preg_replace('/<img(.*?)src=/i', '<img$1loading="lazy" src=', $content);
    return $content;
}
add_filter('the_content', 'techsurfex_add_lazy_loading');

// Clean URL Structure (Remove category base)
add_filter('category_link', 'techsurfex_category_link', 10, 2);
function techsurfex_category_link($link, $category) {
    return str_replace('/category/', '/', $link);
}
?>
