<?php get_header(); ?>


<?php
global $wp_query;
$current_page = max(1, get_query_var('paged'));
$total_pages = $wp_query->max_num_pages;
?>
<h2>Archivio Foto</h2>
<div class="container">
    <div class="row">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                // serve a recuperare il metadato salvato nella funzione salva_galleria_foto
                // get_the_ID() : Ottiene l’ID del post corrente nel Loop di WordPress.
                $galleria = get_post_meta(get_the_ID(), '_foto_galleria', true);
                if (!empty($galleria)) {
                    $img = $galleria[0]; // prima immagine in evidenza
                    $img_id = is_array($img) ? $img['id'] : $img;
                    // se non esiste la caption usa quella dell' immagine 
                    $caption = is_array($img) && isset($img['caption']) ? $img['caption'] : '';
                    $permalink = get_permalink();
                ?>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <figure class="figure">
                            <div class="ratio-container">
                                <h3><?php the_title(); ?></h3>
                                <a href="<?php echo esc_url($permalink); ?>">
                                    <?php echo wp_get_attachment_image($img_id, 'large', false, ['class' => 'img-fluid rounded shadow']); ?>
                                </a>
                            </div>
                            <!-- <?php if ($caption): ?>
                                <figcaption class="figure-caption mt-2"><?php echo esc_html($caption); ?></figcaption>
                            <?php endif; ?> -->
                        </figure>
                    </div>
                <?php } ?>
            <?php endwhile; ?>

            <!-- Paginazione -->
            <div class="d-flex justify-content-center mt-4">
                <!-- Paginazione Bootstrap Italia -->
                <?php if ($total_pages > 1): ?>
                    <nav class="pagination-wrapper" aria-label="Esempio di navigazione simple mode">
                        <ul class="pagination" aria-label="Pagina <?php echo $current_page; ?> di <?php echo $total_pages; ?>">
                            <li class="page-item <?php if ($current_page === 1) echo 'disabled'; ?>">
                                <a class="page-link" href="<?php echo get_pagenum_link($current_page - 1); ?>">
                                    <!-- <svg class="icon icon-primary">
                                <use href="/bootstrap-italia/dist/svg/sprites.svg#it-chevron-left"></use>
                            </svg> -->
                                    <span>Pagina precedente</span>
                                </a>
                            </li>
                            <li class="page-item"><span class="page-link" aria-current="page"><?php echo $current_page; ?></span></li>
                            <li class="page-item"><span class="page-link">/</span></li>
                            <li class="page-item"><span class="page-link"><?php echo $total_pages; ?></span></li>
                            <li class="page-item <?php if ($current_page >= $total_pages) echo 'disabled'; ?>">
                                <a class="page-link" href="<?php echo get_pagenum_link($current_page + 1); ?>">
                                    <span>Pagina successiva</span>
                                    <!-- <svg class="icon icon-primary">
                                <use href="/bootstrap-italia/dist/svg/sprites.svg#it-chevron-right"></use>
                            </svg> -->
                                </a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>

        <?php else : ?>
            <p>Nessuna foto trovata.</p>
        <?php endif; ?>
    </div>


</div>

<style>
    .ratio-container {
        aspect-ratio: 16/9;
    }

    .ratio-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
</style>

<?php get_footer(); ?>