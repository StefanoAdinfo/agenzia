<?php get_header(); ?>

<?php
global $wp_query;
$current_page = max(1, get_query_var('paged'));
$total_pages = $wp_query->max_num_pages;
?>

<div class="container my-5">
    <div class="row g-4">

        <?php if (have_posts()) : while (have_posts()) : the_post();
                $post_id = get_the_ID();
                $acf_video_link = get_field('video_link', $post_id);
                $acf_caption = get_field('caption', $post_id);

                // Estrai ID YouTube
                $youtube_id = '';
                if ($acf_video_link && preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w\-]+)/', $acf_video_link, $matches)) {
                    $youtube_id = $matches[1];
                }
        ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="thumbnail">
                        <?php if ($youtube_id): ?>
                            <div class="video-thumbnail" data-video-id="<?php echo esc_attr($youtube_id); ?>" data-bs-toggle="modal" data-bs-target="#videoModal">
                                <div class="position-relative">
                                    <img src="https://img.youtube.com/vi/<?php echo esc_attr($youtube_id); ?>/hqdefault.jpg" alt="Anteprima video" class="img-fluid rounded">
                                    <div class="position-absolute top-50 start-50 translate-middle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="white" class="bi bi-play-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.271 5.055A.5.5 0 0 0 5.5 5.5v5a.5.5 0 0 0 .771.424l4-2.5a.5.5 0 0 0 0-.848l-4-2.5z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/no-video.png'); ?>" alt="Nessun video disponibile" class="img-fluid rounded">
                        <?php endif; ?>

                        <div class="mt-2">
                            <p class="fs-6"><?php echo esc_html($acf_caption); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>

            <!-- Modale per tutti i video -->
            <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="p-4">
                            <div class="ratio ratio-16x9">
                                <iframe id="videoIframe" src="" title="YouTube video" allow="encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


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

            <?php wp_reset_postdata(); ?>

        <?php else : ?>
            <p>Nessun video trovato.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>


<script>
    const modal = document.getElementById('videoModal');
    const iframe = document.getElementById('videoIframe');
    const triggers = document.querySelectorAll('[data-video-id]');

    triggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const videoId = this.getAttribute('data-video-id');
            iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
        });
    });

    // Svuota l'iframe quando la modale viene chiusa , evitando il caricamento del video in background
    modal.addEventListener('hidden.bs.modal', function() {
        iframe.src = '';
    });
</script>