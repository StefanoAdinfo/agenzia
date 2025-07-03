<?php
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
        // Carica Sortable.js dal tema (o plugin)
        wp_enqueue_script(
            'sortablejs',
            get_template_directory_uri() . '/assets/js/Sortable.min.js',
            [],
            '1.15.2',
            true // Carica nel footer
        );

        // Carica lo script custom che usa sortable nel footer 
        wp_enqueue_script(
            'custom_gallery',
            get_template_directory_uri() . '/assets/js/custom_gallery.js',
            [],
            '1.0',
            true
        );

        // Script css per la galleria in admin
        wp_enqueue_style(
            'custom_gallery',
            get_template_directory_uri() . '/assets/css/custom_gallery.css',
            [],
            '2.11.4'  // Versione   
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

        <!-- <style>
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
        </style> -->

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
