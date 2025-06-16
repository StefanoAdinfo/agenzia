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


function enqueue_splide_cdn()
{
    // CSS Splide da CDN
    wp_enqueue_style('splide-css', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), '4.1.4');

    // JS Splide da CDN - caricato nel footer (true)
    wp_enqueue_script('splide-js', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), '4.1.4', true);
}
add_action('wp_enqueue_scripts', 'enqueue_splide_cdn');

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




add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
});


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
            'taxonomies' => array('post_tag'), // Aggiunge il supporto per i tag
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

        if (is_post_type_archive(['news', 'rassegna-stampa', 'video', 'servizi', 'foto'])) {
            $query->set('posts_per_page', 3);
        }
    }
});







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



// Galleria Start ( Aggiungere gi assets js e css , archive-foto e single-foto)

function enqueue_custom_assets()
{
    // Lightbox2 CSS
    wp_enqueue_style(
        'lightbox2',
        get_template_directory_uri() . '/assets/css/lightbox.min.css',
        [], // Nessuna dipendenza
        '2.11.4'  // Versione   
    );

    // Lightbox2 JS
    wp_enqueue_script(
        'lightbox2',
        get_template_directory_uri() . '/assets/js/lightbox.min.js',
        ['jquery'],         // Dipende da jQuery
        '2.11.4',
        true                // Carica nel footer
    );

    // Script personalizzato per configurare Lightbox2
    wp_add_inline_script(
        'lightbox2',
        'lightbox.option({
            "resizeDuration": 200,
            "wrapAround": true,
        });'
    );
}
add_action('wp_enqueue_scripts', 'enqueue_custom_assets');




add_action('admin_enqueue_scripts', function ($hook) {
    //serve per limitare il caricamento degli script solo nelle schermate di modifica o creazione di un post.
    if ($hook === 'post.php' || $hook === 'post-new.php') {
        // ✅ Carica Sortable.js dal tema (o plugin)
        wp_enqueue_script(
            'sortablejs',
            get_template_directory_uri() . '/assets/js/Sortable.min.js',
            [],
            '1.15.2',
            true
        );

        // ✅ Carica lo script custom che usa sortable nel footer 
        wp_enqueue_script(
            'custom_gallery',
            get_template_directory_uri() . '/assets/js/custom_gallery.js',
            [],
            '1.0',
            true
        );
    }
});





function foto_aggiungi_metabox_galleria()
{
    add_meta_box(
        'foto_galleria_metabox', // metabox ID
        'Galleria di Immagini', // title
        'foto_render_galleria_metabox', // callback function
        'foto',  // add meta box to custom post type (or post types in array)
        'normal',  // position (normal, side, advanced)
        'default' // priority (default, low, high, core)
    );
}
add_action('add_meta_boxes', 'foto_aggiungi_metabox_galleria');

function foto_render_galleria_metabox($post)
{
    // serve a generare un campo nascosto (<input type="hidden">) contenente un nonce, cioè un token di sicurezza usato per verificare che una richiesta provenga da una fonte attendibile
    wp_nonce_field('foto_salva_galleria', 'foto_galleria_nonce');

    // Recupera le immagini dalla galleria salvata nel post meta
    $immagini = get_post_meta($post->ID, '_foto_galleria', true);
?>

    <div id="foto-galleria-container" class="mt-5">
        <ul id="galleria-sortable">
            <?php
            if (!empty($immagini)) {
                foreach ($immagini as $index => $img) {
                    $img_id = is_array($img) ? $img['id'] : $img;
                    // wp_get_attachment_caption($img_id) restituisce la didascalia dell'immagine se e presente 
                    $caption = is_array($img) && isset($img['caption']) ? $img['caption'] : wp_get_attachment_caption($img_id);
                    $thumb = wp_get_attachment_image($img_id, 'thumbnail');
                    $featured_class = $index === 0 ? ' featured-img' : '';
                    $badge = $index === 0 ? '<div class="featured-badge">Immagine in evidenza</div>' : '';

                    echo "<li class='sortable-item{$featured_class}' data-id='$img_id'>
                        <div class='img-wrapper'>
                            $badge
                            $thumb
                        </div>
                        <textarea class='img-caption' placeholder='Descrizione...'>" . esc_textarea($caption) . "</textarea>
                        <button class='rimuovi-img button'>Rimuovi</button>
                    </li>";
                }
            }
            ?>
        </ul>
        <input type="hidden" id="foto-galleria-data" name="foto_galleria_data" />
        <button type="button" class="button" id="foto-aggiungi-img">Aggiungi Immagini</button>

        <style>
            #foto-galleria-container ul {
                list-style: none;
                padding: 0;
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            #foto-galleria-container li {
                position: relative;
                padding: 10px;
                background: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 4px;
            }

            .rimuovi-img {
                position: absolute;
                top: 5px;
                right: 5px;
            }

            .sortable-item {
                width: 180px;
                text-align: center;
            }

            .featured-img {
                width: 180px;
                border: 2px solid #0073aa;
                background-color: #e7f3ff;
            }

            .img-wrapper {
                position: relative;
                display: inline-block;
            }

            .featured-badge {
                position: absolute;
                top: -35px;
                left: 0;
                background: #0073aa;
                color: #fff;
                font-size: 11px;
                padding: 2px 5px;
                border-radius: 4px;
            }


            .img-caption {
                width: 100%;
                margin-top: 5px;
                resize: vertical;
            }
        </style>

        <!-- <script>
            jQuery(document).ready(function($) {
                let mediaFrame;

                $('#foto-aggiungi-img').on('click', function(e) {
                    e.preventDefault();

                    if (mediaFrame) {
                        mediaFrame.open();
                        return;
                    }

                    mediaFrame = wp.media({
                        title: 'Aggiungi immagini alla galleria',
                        multiple: true,
                        library: {
                            type: 'image'
                        },
                        button: {
                            text: 'Aggiungi immagini'
                        }
                    });

                    mediaFrame.on('select', function() {
                        const attachments = mediaFrame.state().get('selection');

                        // Prende gli ID delle immagini attuali nella ul
                        const idsCorrenti = $('#galleria-sortable .sortable-item').map(function() {
                            return $(this).data('id');
                        }).get();

                        // Prende gli ID delle nuove selezioni
                        const nuoviIds = attachments.map(a => a.id);

                        // Rimuove le immagini che NON sono più selezionate
                        idsCorrenti.forEach(id => {
                            if (!nuoviIds.includes(id)) {
                                $('#galleria-sortable .sortable-item[data-id="' + id + '"]').remove();
                            }
                        });

                        // Aggiunge solo le nuove immagini (quelle che non ci sono già)
                        attachments.each(function(attachment) {
                            const id = attachment.id;
                            const thumb = attachment.attributes.sizes?.thumbnail?.url || attachment.attributes.icon;
                            const caption = attachment.attributes.caption || '';

                            // Evita duplicati dopo rimozione
                            if ($('#galleria-sortable .sortable-item[data-id="' + id + '"]').length) return;

                            $('#galleria-sortable').append(`
                                <li class="sortable-item" data-id="${id}">
                                    <div class="img-wrapper">
                                        <img src="${thumb}" />
                                    </div>
                                    <textarea class="img-caption" placeholder="Descrizione...">${caption}</textarea>
                                    <button class="rimuovi-img button">Rimuovi</button>
                                </li>
                            `);
                        });

                        aggiornaJson();
                        evidenziaImmagineInEvidenza();
                    });

                    mediaFrame.on('open', function() {
                        // aggiunge la classe alla modale per stile custom
                        $('.media-modal').addClass('custom_modal_foto');

                        const selection = mediaFrame.state().get('selection');

                        $('#galleria-sortable .sortable-item').each(function() {
                            const id = $(this).data('id');
                            const attachment = wp.media.attachment(id);
                            attachment.fetch();
                            selection.add(attachment);
                        });
                    });

                    mediaFrame.on('close', function() {
                        $('.media-modal').removeClass('custom_modal_foto');

                        const attachments = mediaFrame.state().get('selection');

                        const nuoviIds = attachments.map(a => a.id);

                        // Se tutte le immagini sono state deselezionate, svuota la lista
                        if (nuoviIds.length === 0) {
                            $('#galleria-sortable').empty();
                        }

                        aggiornaJson();
                        evidenziaImmagineInEvidenza();
                    });

                    mediaFrame.open();
                });

                $('#foto-galleria-container').on('click', '.rimuovi-img', function() {
                    $(this).closest('li').remove();
                    aggiornaJson();
                    evidenziaImmagineInEvidenza();
                });

                $('#galleria-sortable').sortable({
                    update: function() {
                        aggiornaJson();
                        evidenziaImmagineInEvidenza();
                    }
                });

                $('#foto-galleria-container').on('input', '.img-caption', function() {
                    aggiornaJson();
                });

                function aggiornaJson() {
                    const data = [];
                    $('#galleria-sortable .sortable-item').each(function() {
                        const id = $(this).data('id');
                        const caption = $(this).find('.img-caption').val();
                        data.push({
                            id,
                            caption
                        });
                    });
                    $('#foto-galleria-data').val(JSON.stringify(data));
                    console.log('JSON aggiornato:', data);
                }

                function evidenziaImmagineInEvidenza() {
                    $('#galleria-sortable .sortable-item')
                        .removeClass('featured-img')
                        .find('.featured-badge').remove();

                    const primo = $('#galleria-sortable .sortable-item').first();
                    if (primo.length) {
                        primo.addClass('featured-img');
                        primo.find('.img-wrapper').prepend('<div class="featured-badge">Immagine in evidenza</div>');
                    }
                }

                aggiornaJson();
                evidenziaImmagineInEvidenza();

            });
        </script> -->

        <!-- <script>
            let mediaFrame;

            const galleriaContainer = document.getElementById('foto-galleria-container');
            const galleriaSortable = document.getElementById('galleria-sortable');
            const galleriaData = document.getElementById('foto-galleria-data');
            const aggiungiBtn = document.getElementById('foto-aggiungi-img');

            aggiungiBtn.addEventListener('click', (e) => {
                e.preventDefault();

                if (mediaFrame) {
                    mediaFrame.open();
                    return;
                }

                mediaFrame = wp.media({
                    title: 'Aggiungi immagini alla galleria',
                    multiple: true,
                    library: {
                        type: 'image'
                    },
                    button: {
                        text: 'Aggiungi immagini'
                    },
                });

                mediaFrame.on('select', () => {
                    const attachments = mediaFrame.state().get('selection');
                    const idsCorrenti = Array.from(
                        galleriaSortable.querySelectorAll('.sortable-item')
                    ).map((el) => parseInt(el.dataset.id));

                    const nuoviIds = attachments.map((a) => a.id);

                    // Rimuove elementi non più selezionati
                    idsCorrenti.forEach((id) => {
                        if (!nuoviIds.includes(id)) {
                            const el = galleriaSortable.querySelector(`[data-id="${id}"]`);
                            if (el) el.remove();
                        }
                    });

                    // Aggiunge nuove immagini
                    attachments.each((attachment) => {
                        const id = attachment.id;
                        const thumb = attachment.attributes.sizes?.thumbnail?.url || attachment.attributes.icon;
                        const caption = attachment.attributes.caption || '';

                        if (galleriaSortable.querySelector(`[data-id="${id}"]`)) return;

                        const li = document.createElement('li');
                        li.className = 'sortable-item';
                        li.dataset.id = id;

                        li.innerHTML = `
                            <div class="img-wrapper">
                                <img src="${thumb}" />
                            </div>
                            <textarea class="img-caption" placeholder="Descrizione...">${caption}</textarea>
                            <button class="rimuovi-img button">Rimuovi</button>
                        `;

                        galleriaSortable.appendChild(li);
                    });

                    aggiornaJson();
                    evidenziaImmagineInEvidenza();
                });

                mediaFrame.on('open', () => {
                    document.querySelector('.media-modal')?.classList.add('custom_modal_foto');

                    const selection = mediaFrame.state().get('selection');

                    galleriaSortable.querySelectorAll('.sortable-item').forEach((item) => {
                        const id = parseInt(item.dataset.id);
                        const attachment = wp.media.attachment(id);
                        attachment.fetch();
                        selection.add(attachment);
                    });
                });

                mediaFrame.on('close', () => {
                    document.querySelector('.media-modal')?.classList.remove('custom_modal_foto');

                    const attachments = mediaFrame.state().get('selection');
                    const nuoviIds = attachments.map((a) => a.id);

                    if (nuoviIds.length === 0) {
                        galleriaSortable.innerHTML = '';
                    }

                    aggiornaJson();
                    evidenziaImmagineInEvidenza();
                });

                mediaFrame.open();
            });

            // Rimuovi immagine
            galleriaContainer.addEventListener('click', (e) => {
                if (e.target.classList.contains('rimuovi-img')) {
                    e.target.closest('li').remove();
                    aggiornaJson();
                    evidenziaImmagineInEvidenza();
                }
            });

            // Aggiorna caption in tempo reale
            galleriaContainer.addEventListener('input', (e) => {
                if (e.target.classList.contains('img-caption')) {
                    aggiornaJson();
                }
            });

            // Inizializza sortable
            Sortable.create(galleriaSortable, {
                animation: 150,
                onEnd: () => {
                    aggiornaJson();
                    evidenziaImmagineInEvidenza();
                },
            });

            function aggiornaJson() {
                const data = Array.from(galleriaSortable.querySelectorAll('.sortable-item')).map((item) => ({
                    id: parseInt(item.dataset.id),
                    caption: item.querySelector('.img-caption')?.value || '',
                }));

                galleriaData.value = JSON.stringify(data);
                console.log('JSON aggiornato:', data);
            }

            function evidenziaImmagineInEvidenza() {
                galleriaSortable.querySelectorAll('.sortable-item').forEach((item) => {
                    item.classList.remove('featured-img');
                    item.querySelector('.featured-badge')?.remove();
                });

                const primo = galleriaSortable.querySelector('.sortable-item');
                if (primo) {
                    primo.classList.add('featured-img');
                    const wrapper = primo.querySelector('.img-wrapper');
                    const badge = document.createElement('div');
                    badge.className = 'featured-badge';
                    badge.textContent = 'Immagine in evidenza';
                    wrapper.prepend(badge);
                }
            }

            aggiornaJson();
            evidenziaImmagineInEvidenza();
        </script> -->
    <?php
}




function salva_galleria_foto($post_id)
{
    // Sicurezza serve a verificare che il token di sicureza sia stato generato
    if (!isset($_POST['foto_galleria_nonce']) || !wp_verify_nonce($_POST['foto_galleria_nonce'], 'foto_salva_galleria')) {
        return;
    }

    //Evita di salvare i dati durante il salvataggio automatico di WordPress, per non sovrascrivere contenuti parziali o temporanei.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Verifica se l’utente corrente ha i permessi per modificare il post.
    if (!current_user_can('edit_post', $post_id)) return;

    // Controlla se è stato inviato il campo foto_galleria_data riga 314
    if (isset($_POST['foto_galleria_data'])) {
        // json_decode(..., true): decodifica il JSON in un array PHP associativo.
        // stripslashes(...): rimuove eventuali backslash aggiunti da WordPress.
        $data = json_decode(stripslashes($_POST['foto_galleria_data']), true);
        // update_post_meta(...): salva l’array come meta dato del post con chiave _foto_galleria.
        update_post_meta($post_id, '_foto_galleria', $data);
    } else {
        // Se il campo foto_galleria_data non è presente nel form, elimina il metadato per evitare di lasciare vecchi dati inutili.
        delete_post_meta($post_id, '_foto_galleria');
    }
}
add_action('save_post', 'salva_galleria_foto');

// Galleria End





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














add_action('admin_menu', 'misha_add_metabox');
// or add_action( 'add_meta_boxes', 'misha_add_metabox' );
//  or add_action( 'add_meta_boxes_{post_type}', 'misha_add_metabox' );




// creiamo il metamox
function misha_add_metabox()
{
    add_meta_box(
        'misha_metabox', // metabox ID
        'Meta Box', // title
        'misha_metabox_callback', // callback function
        'page', // add meta box to custom post type (or post types in array)
        'normal', // position (normal, side, advanced)
        'default', // priority (default, low, high, core)
        // array(
        //     '__back_compat_meta_box' => true,
        // )

    );
}




// it is a callback function which actually displays the content of the meta box
//Renderizzazione lato admin wp
function misha_metabox_callback($post)
{

    $seo_title = get_post_meta($post->ID, 'seo_title', true);
    $seo_robots = get_post_meta($post->ID, 'seo_robots', true);

    // nonce, actually I think it is not necessary here
    wp_nonce_field('somerandomstr', '_mishanonce');

    echo '<table class="form-table">
		<tbody>
			<tr>
				<th><label for="seo_title">SEO title</label></th>
				<td><input type="text" id="seo_title" name="seo_title" value="' . esc_attr($seo_title) . '" class="regular-text"></td>
			</tr>
			<tr>
				<th><label for="seo_tobots">SEO robots</label></th>
				<td>
					<select id="seo_robots" name="seo_robots">
						<option value="">Select...</option>
						<option value="index,follow"' . selected('index,follow', $seo_robots, false) . '>Show for search engines</option>
						<option value="noindex,nofollow"' . selected('noindex,nofollow', $seo_robots, false) . '>Hide for search engines</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>';
}





add_action('save_post', 'misha_save_meta', 10, 2);
// or add_action( 'save_post_{post_type}', 'misha_save_meta', 10, 2 );


// salva i dati del meta box
function misha_save_meta($post_id, $post)
{

    // nonce check
    if (! isset($_POST['_mishanonce']) || ! wp_verify_nonce($_POST['_mishanonce'], 'somerandomstr')) {
        return $post_id;
    }

    // check current user permissions
    $post_type = get_post_type_object($post->post_type);

    if (! current_user_can($post_type->cap->edit_post, $post_id)) {
        return $post_id;
    }

    // Do not save the data if autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // define your own post type here
    if ('page' !== $post->post_type) {
        return $post_id;
    }

    if (isset($_POST['seo_title'])) {
        update_post_meta($post_id, 'seo_title', sanitize_text_field($_POST['seo_title']));
    } else {
        delete_post_meta($post_id, 'seo_title');
    }
    if (isset($_POST['seo_robots'])) {
        update_post_meta($post_id, 'seo_robots', sanitize_text_field($_POST['seo_robots']));
    } else {
        delete_post_meta($post_id, 'seo_robots');
    }

    return $post_id;
}
