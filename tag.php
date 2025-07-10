<?php get_header(); ?>

<section class="container py-5">
    <h2 class="mb-4">Archivio tag: <?php single_tag_title(); ?></h2>

    <?php
    global $wp_query;
    $current_page = max(1, get_query_var('paged'));
    $total_pages = $wp_query->max_num_pages;

    if (have_posts()) : ?>
        <div class="row">
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-12 col-md-6 col-lg-6 mb-3 mb-md-4">
                    <!--start it-card-->
                    <article class="it-card rounded-4 shadow-sm border h-100">
                        <h3 class="it-card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>

                        <div class="it-card-body">
                            <p class="it-card-text">
                                <?php echo wp_trim_words(get_the_excerpt(), 30, '…'); ?>
                            </p>
                        </div>

                        <footer class="it-card-related it-card-footer d-flex justify-content-between align-items-center">
                            <div class="it-card-taxonomy">
                                <?php
                                $tags = get_the_terms(get_the_ID(), 'post_tag');
                                if (!empty($tags) && !is_wp_error($tags)) :
                                    $tag = $tags[0];
                                ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="it-card-category it-card-link link-secondary">
                                        <span class="visually-hidden">Tag correlato: </span><?php echo esc_html($tag->name); ?>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <time class="it-card-date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                                <?php echo get_the_date('j F Y'); ?>
                            </time>
                        </footer>
                    </article>
                    <!--end it-card-->
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Paginazione -->
        <?php if ($total_pages > 1): ?>
            <div class="d-flex justify-content-center mt-4">
                <nav class="pagination-wrapper" aria-label="Navigazione pagine">
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
            </div>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">Non è stato trovato alcun articolo con il tag: <?php single_tag_title(); ?></div>
    <?php endif; ?>
</section>

<?php get_footer(); ?>