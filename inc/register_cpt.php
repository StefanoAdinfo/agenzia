<?php


// registro i custom post type

function register_cpt()
{

    register_post_type(
        'news',
        array(
            'labels' => array(
                'name' => 'News',
                'singular_name' => 'News',
            ),
            'show_in_menu' => true,
            'menu_position' => 4, // Posizione nel menu di WordPress
            'public' => true, // Rende il post type pubblico
            'publicly_queryable' => true, // Rende il post type interrogabile
            'has_archive' => true, // Non mostrara l'archivio
            'show_in_rest' => true, // Abilita l'editor a blocchi
            'rewrite' => array('slug' => 'news'),
            'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
            'taxonomies' => array('category', 'post_tag'), // ✅ categorie e tag
            'menu_icon' => 'dashicons-format-aside',
        )
    );

    register_post_type(
        'video',
        array(
            'labels' => array(
                'name' => 'Video',
                'singular_name' => 'Video',
            ),
            'show_in_menu' => true,
            'menu_position' => 4, // Posizione nel menu di WordPress
            'public' => true, // Rende il post type pubblico
            'publicly_queryable' => true, // Rende il post type interrogabile
            'has_archive' => true, // Non mostrara l'archivio
            'show_in_rest' => true, // Abilita l'editor a blocchi
            'rewrite' => array('slug' => 'video'),
            'supports' => array('title', 'acf'),
            'taxonomies' => array('post_tag'), // Aggiunge il supporto per i tag
            'menu_icon' => 'dashicons-format-image',
        )
    );
    register_post_type(
        'foto',
        array(
            'labels' => array(
                'name' => 'Foto',
                'singular_name' => 'Foto',
            ),
            'show_in_menu' => true,
            'menu_position' => 4, // Posizione nel menu di WordPress
            'public' => true, // Rende il post type pubblico
            'publicly_queryable' => true, // Rende il post type interrogabile
            'has_archive' => true, // Non mostrara l'archivio
            'show_in_rest' => true, // Abilita l'editor a blocchi
            'rewrite' => array('slug' => 'foto'),
            'supports' => array('title'),
            'taxonomies' => array('post_tag'), // Aggiunge il supporto per i tag
            'menu_icon' => 'dashicons-format-image',
        )
    );
    register_post_type(
        'rassegna-stampa',
        array(
            'labels' => array(
                'name' => 'Rassegna Stampa',
                'singular_name' => 'Rassegna Stampa',
            ),
            'show_in_menu' => true,
            'menu_position' => 5, // Posizione nel menu di WordPress
            'public' => true, // Rende il post type pubblico
            'publicly_queryable' => true, // Rende il post type interrogabile
            'has_archive' => true, // Non mostrara l'archivio
            'show_in_rest' => true, // Abilita l'editor a blocchi
            'rewrite' => array('slug' => 'rassegna-stampa'),
            'supports' => array('title'),
            'taxonomies' => array('post_tag'), // Aggiunge il supporto per i tag
            'menu_icon' => 'dashicons-format-aside',
        )
    );
    register_post_type(
        'servizi',
        array(
            'labels' => array(
                'name' => 'Servizi',
                'singular_name' => 'Servizi',
            ),
            'show_in_menu' => true,
            'menu_position' => 5, // Posizione nel menu di WordPress
            'public' => true, // Rende il post type pubblico
            'publicly_queryable' => true, // Rende il post type interrogabile
            'has_archive' => true, // Non mostrara l'archivio
            'show_in_rest' => true, // Abilita l'editor a blocchi
            'rewrite' => array('slug' => 'servizi'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'taxonomies' => array('post_tag'), // Aggiunge il supporto per i tag
            'menu_icon' => 'dashicons-format-aside',
        )
    );
}

add_action('init', 'register_cpt');


add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query()) {

        // if ($query->is_search && !is_admin() && $query->is_main_query()) {
        //     $query->set('post_type', ['post']);
        // }

        if (is_category()) {
            // Qui specifico tutti i CPT che voglio includere nell'archivio categoria
            $query->set('post_type', ['post', 'news', 'rassegna-stampa', 'video', 'servizi', 'foto']);
            $query->set('posts_per_page', 4); // o 4 come preferisci
        }
        if (is_post_type_archive(['news', 'rassegna-stampa', 'video', 'servizi', 'foto'])) {
            $query->set('posts_per_page', 4);
        }
    }
});
