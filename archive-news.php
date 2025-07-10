<?php get_header(); ?>

<h2>Archivio News</h2>

<?php

global $wp_query;
$current_page = max(1, get_query_var('paged'));
$total_pages = $wp_query->max_num_pages;

if (have_posts()) : ?>
    <div class="container bg-light p-4">
        <div class="row g-4">
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-12 col-lg-4">
                    <div class="card-wrapper">
                        <div class="it-card rounded shadow-sm border">
                            <div class="it-card-body">
                                <h3 class="it-card-title h5">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="it-card-text font-serif"><?php the_excerpt(); ?></p>
                            </div>
                        </div>
                    </div>
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
                            <svg class="icon icon-sm icon-primary me-1">
                                <use href="<?php echo get_template_directory_uri(); ?>/assets/sprites.svg#it-chevron-left"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="page-item"><span class="page-link" aria-current="page"><?php echo $current_page; ?></span></li>
                    <li class="page-item"><span class="page-link">/</span></li>
                    <li class="page-item"><span class="page-link"><?php echo $total_pages; ?></span></li>
                    <li class="page-item <?php if ($current_page >= $total_pages) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php echo get_pagenum_link($current_page + 1); ?>">
                            <svg class="icon icon-sm icon-primary ms-1">
                                <use href="<?php echo get_template_directory_uri(); ?>/assets/sprites.svg#it-chevron-right"></use>
                            </svg>
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