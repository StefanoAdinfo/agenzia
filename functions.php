<?php

function pa_centrale_styles()
{
    wp_enqueue_style(
        'Agenzia-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'pa_centrale_styles');


// Includo i file PHP della  cartella inc

foreach (glob(get_template_directory() . '/inc/*.php') as $file) {
    require_once $file;
}

// integro la thumbnail in tutti i post causa problemi 
add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
});


// Carico i file di splide
function enqueue_splide_cdn()
{
    // CSS Splide da CDN
    wp_enqueue_style('splide-css', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), '4.1.4');

    // JS Splide da CDN - caricato nel footer (true)
    wp_enqueue_script('splide-js', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), '4.1.4', true);
}
add_action('wp_enqueue_scripts', 'enqueue_splide_cdn');




// Bootstrap Italia 

// Carico i file di Bootstrap Italia nel frontend
function  bootstrap_italia_setup()
{

    wp_register_style('bootstrap-italia-style', get_parent_theme_file_uri('assets/css/bootstrap-italia.min.css'));
    wp_enqueue_style('bootstrap-italia-style');
    wp_register_script('bootstrap-italia-script', get_parent_theme_file_uri('assets/js/bootstrap-italia.min.js'));
    wp_enqueue_script('bootstrap-italia-script');
}
add_action('after_setup_theme', 'bootstrap_italia_setup');



// Carico i file di Bootstrap Italia anche nell'editor di WordPress
function mytheme_enqueue_editor_assets()
{
    // Carica il CSS principale del tema
    add_editor_style(get_parent_theme_file_uri('assets/css/bootstrap-italia.min.css'));

    // Carica il JS di Bootstrap Italia
    wp_enqueue_script(get_parent_theme_file_uri('assets/js/bootstrap-italia.min.js'));
}
add_action('admin_init', 'mytheme_enqueue_editor_assets');
