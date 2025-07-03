<?php






// script indice e ricerca

function pa_centrale_scripts()
{
    // Script solo per i singoli post (single.php)
    if (is_single()) {
        wp_enqueue_script(
            'agenzia-indice',
            get_template_directory_uri() . '/js/indice.js',
            [],
            wp_get_theme()->get('Version'),
            true
        );
    }

    // Script solo per la pagina di ricerca (page-ricerca.php)
    if (is_page('ricerca')) {
        wp_enqueue_script(
            'agenzia-search',
            get_template_directory_uri() . '/js/search.js',
            [],
            wp_get_theme()->get('Version'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'pa_centrale_scripts');




// Query di ricerca su piu cpt basata sul titolo di essi
function custom_news_search_callback()
{
    $term = isset($_GET['term']) ? sanitize_text_field($_GET['term']) : '';
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $post_type_filter = isset($_GET['post_type']) ? sanitize_text_field($_GET['post_type']) : '';

    $per_page = 4;

    if (empty($term)) {
        wp_send_json([]);
        return;
    }

    $post_types = ['news', 'servizi', 'comuni'];
    $results = [];
    $filterArray = [];
    $max_num_pages = 1; // Default

    $response = array(
        'posts' => $results,
        'filtri' => $filterArray,
        'current_page' => $page,
        'max_num_pages' => $max_num_pages,
    );


    foreach ($post_types as $post_type) {
        $args = array(
            'post_type' => $post_type,
            's' => $term,
            'posts_per_page' => ($post_type_filter && $post_type !== $post_type_filter) ? 1 : $per_page,
            'paged' => $page,
            'post_status' => 'publish',
        );

        $query = new WP_Query($args);

        // Sempre aggiungere il filtro, anche se non ci sono risultati
        $filterArray[] = array(
            'name' => $post_type,
            'count' => $query->found_posts,
        );


        // Se è il post_type selezionato, allora prendi i post
        if (!$post_type_filter || $post_type_filter === $post_type) {
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $results[] = array(
                        'title' => get_the_title(),
                        'link' => get_permalink(),
                        'date' => get_the_date('d/m/Y'),
                        'post_type' => $post_type,
                    );
                }
            }
            $max_num_pages = $query->max_num_pages;
        }

        wp_reset_postdata();
    }


    $response = array(
        'posts' => $results,
        'filtri' => $filterArray,
        'current_page' => $page,
        'max_num_pages' => $max_num_pages,
    );

    wp_send_json($response);
}

// wp_ajax_ + custom_news_search → registra un hook per utenti loggati
add_action('wp_ajax_custom_news_search', 'custom_news_search_callback');
// wp_ajax_nopriv_ + custom_news_search → registra un hook per utenti non loggati
add_action('wp_ajax_nopriv_custom_news_search', 'custom_news_search_callback');
