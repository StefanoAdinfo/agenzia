<?php get_header(); ?>

<div class="container">

    <div>
        <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $posts_per_page = get_query_var('posts_per_page') ? get_query_var('posts_per_page') : get_option('posts_per_page');
        $total_posts = wp_count_posts()->publish;
        $total_pages = ceil($total_posts / $posts_per_page);
        ?>
        <h2 class="mb-3">
            Risultati per: "<?php echo esc_html(get_search_query()); ?>"
        </h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <?php if ($wp_query->max_num_pages != 0) : ?>
                <small>Pagina <?php echo $paged; ?> di <?php echo $wp_query->max_num_pages; ?></small>
            <?php endif; ?>

            <!-- PAGINAZIONE -->
            <!-- <?php if ($wp_query->max_num_pages > 1) : ?>

                <nav class="pagination-wrapper" aria-label="Esempio di navigazione simple mode">
                    <ul class="pagination" aria-label="Navigazione paginazione">
                        <li class="page-item <?php if ($paged <= 1) echo 'disabled'; ?>">
                            <a class="page-link" href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>" aria-label="Pagina precedente" aria-hidden="true">
                                <svg class="icon icon-sm icon-primary me-1">
                                    <use href="<?php echo get_template_directory_uri(); ?>/assets/sprites.svg#it-chevron-left"></use>
                                </svg>
                            </a>
                        </li>


                        <li class="page-item"><span class="page-link" aria-current="page"><?php echo $paged; ?></span></li>
                        <li class="page-item"><span class="page-link">/</span></li>
                        <li class="page-item"><span class="page-link"><?php echo $wp_query->max_num_pages; ?></span></li>



                        <li class="page-item <?php if ($paged >= $wp_query->max_num_pages) echo 'disabled'; ?>">
                            <a class="page-link" href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>" aria-label="Pagina successiva">
                                <svg class="icon icon-sm icon-primary ms-1">
                                    <use href="<?php echo get_template_directory_uri(); ?>/assets/sprites.svg#it-chevron-right"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?> -->

            <div class="select-wrapper">

                <label for="defaultSelect">Filtra</label>
                <select id="defaultSelect">
                    <option selected="" value="">Scegli un'opzione</option>
                    <option value="news">News</option>
                    <option value="rassegna-stampa">Rassegna Stampa</option>
                    <option value="video">Video</option>
                    <option value="foto">Foto</option>
                    <option value="servizi">Servizi</option>
                </select>
            </div>

        </div>
    </div>

    <div class="row">
        <?php if (have_posts()) :
            while (have_posts()) : the_post();
                $categories = get_the_category();
                $datapost = get_the_date('j F Y'); ?>
                <div class="col-12 col-md-6 col-lg-6 mb-3 mb-md-4">
                    <div class="card-wrapper">
                        <!--start it-card-->
                        <article class="it-card rounded-4 shadow-sm border">
                            <h3 class="it-card-title ">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <!--card body content-->
                            <div class="it-card-body">
                                <p class="it-card-text"> <?php the_excerpt(); ?></p>
                            </div>
                            <!--finally the card footer metadata-->

                            <footer class="it-card-related it-card-footer">
                                <div class="it-card-taxonomy">
                                    <?php
                                    if (!empty($categories)) {
                                        foreach ($categories as $index => $cat) {
                                            if ($index > 0) echo ' - ';
                                            echo '<a class="it-card-category it-card-link link-secondary" href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a>';
                                        }
                                    }
                                    ?>
                                </div>
                                <time class="it-card-date" datetime="<?php echo esc_html($datapost); ?>"><?php echo esc_html($datapost); ?></time>
                            </footer>
                        </article>
                        <!--end it-card-->
                    </div>
                </div>
            <?php endwhile;
        else : ?>
            <div class="col-12">
                <div class="alert alert-warning d-flex align-items-center mt-4" role="alert">
                    <svg class="icon me-2" aria-hidden="true">
                        <use href="<?php echo get_template_directory_uri(); ?>/path/to/bootstrap-italia/svg/sprites.svg#it-info-circle"></use>
                    </svg>
                    <div>
                        <h4 class="alert-heading">Nessun risultato trovato</h4>
                        <p>La ricerca per <strong>"<?php echo esc_html(get_search_query()); ?>"</strong> non ha prodotto risultati.</p>
                        <hr>
                        <p class="mb-0">Verifica di aver scritto correttamente oppure prova con parole chiave diverse.</p>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <!-- PAGINAZIONE -->
        <?php if ($wp_query->max_num_pages > 1) : ?>

            <nav class="pagination-wrapper" aria-label="Esempio di navigazione simple mode">
                <ul class="pagination" aria-label="Navigazione paginazione">
                    <li class="page-item <?php if ($paged <= 1) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>" aria-label="Pagina precedente" aria-hidden="true">
                            <svg class="icon icon-sm icon-primary me-1">
                                <use href="<?php echo get_template_directory_uri(); ?>/assets/sprites.svg#it-chevron-left"></use>
                            </svg>
                        </a>
                    </li>


                    <li class="page-item"><span class="page-link" aria-current="page"><?php echo $paged; ?></span></li>
                    <li class="page-item"><span class="page-link">/</span></li>
                    <li class="page-item"><span class="page-link"><?php echo $wp_query->max_num_pages; ?></span></li>



                    <li class="page-item <?php if ($paged >= $wp_query->max_num_pages) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>" aria-label="Pagina successiva">
                            <svg class="icon icon-sm icon-primary ms-1">
                                <use href="<?php echo get_template_directory_uri(); ?>/assets/sprites.svg#it-chevron-right"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>

        <?php endif; ?>
    </div>

</div>




<?php get_footer(); ?>