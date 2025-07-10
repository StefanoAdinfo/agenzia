<?php get_header(); ?>

<h2>Archivio Rassegna Stampa</h2>

<?php

global $wp_query;
$current_page = max(1, get_query_var('paged'));
$total_pages = $wp_query->max_num_pages;

if (have_posts()) : ?>
    <div class="container bg-light p-4">
        <div class="row">
            <?php while (have_posts()) : the_post();
                $pdf_url = get_field('pdf');
            ?>
                <div class="col-12 col-md-6 col-lg-6 mb-3 mb-md-4">
                    <!--start it-card-->
                    <article class="it-card rounded-4 shadow-sm border ">
                        <!--card first child is the title (link)-->
                        <h3 class="it-card-title"><?php the_title(); ?></h3>
                        <footer class="it-card-related it-card-footer">
                            <a class="read-more" href="<?php echo esc_url($pdf_url); ?>" target="_blank" rel="noopener noreferrer">
                                <span class="text">Leggi di più</span>
                                <svg class="icon icon-primary">
                                    <use href="<?php echo get_template_directory_uri() . '/assets/sprites.svg#it-arrow-right'; ?>"></use>
                                </svg>
                            </a>
                        </footer>
                    </article>
                    <!--end it-card-->
                </div>
            <?php endwhile; ?>
        </div>
    </div>




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
<?php else: ?>
    <p>Nessuna news trovata.</p>
<?php endif; ?>

<?php get_footer(); ?>