<?php get_header(); ?>

<main class="it-page-section py-5">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="row">
                    <div class="col-md-6"> <!-- Titolo -->
                        <h1 class="it-heading-xl pb-3 mb-4"><?php the_title(); ?></h1>
                    </div>
                    <div class="col-md-6 text-md-end mb-4">
                        <div class="d-flex justify-content-md-end gap-3">
                            <a href="#" class="text-decoration-none d-flex align-items-center gap-2 link-hover-underline">

                                <div> <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5 12C19.5 16.1421 16.1421 19.5 12 19.5C7.85786 19.5 4.5 16.1421 4.5 12C4.5 7.85786 7.85786 4.5 12 4.5C16.1421 4.5 19.5 7.85786 19.5 12ZM21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12ZM11.25 13.5V8.25H12.75V13.5H11.25ZM11.25 15.75V14.25H12.75V15.75H11.25Z" fill="#0066CC"></path>
                                        </g>
                                    </svg>
                                </div>
                                <span>
                                    Condividi
                                </span>
                            </a>
                            <a href="#" class="text-decoration-none d-flex align-items-center gap-2 link-hover-underline">
                                <div> <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5 12C19.5 16.1421 16.1421 19.5 12 19.5C7.85786 19.5 4.5 16.1421 4.5 12C4.5 7.85786 7.85786 4.5 12 4.5C16.1421 4.5 19.5 7.85786 19.5 12ZM21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12ZM11.25 13.5V8.25H12.75V13.5H11.25ZM11.25 15.75V14.25H12.75V15.75H11.25Z" fill="#0066CC"></path>
                                        </g>
                                    </svg>
                                </div>
                                <span>
                                    Vedi azioni
                                </span>
                            </a>
                        </div>

                        <div class="mt-3">
                            <p>Argomenti</p>
                            <?php the_tags('<span class="chip chip-simple chip-primary me-2">', '</span><span class="chip chip-simple chip-primary me-2">', '</span>'); ?>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <div class="mb-2">Data: </div>
                    <div class="fw-bold"><?php echo get_the_date(); ?></div>
                </div>



                <div class="row  border-top border-secondary">

                    <div class="col-md-3 border-md-end border-secondary">
                        <div class="accordion border-0 position-sticky pt-5" id="accordionExample">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button indice-title bg-transparent border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        INDICE DELLA PAGINA
                                    </button>
                                </h2>
                                <div class="indice-bar">
                                    <div class="indice-bar-fill"></div>
                                </div>

                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class="indice-list">
                                            <li class="indice-item ">
                                                <a href="#descrizione" class="link-hover-underline text-decoration-none">Descrizione</a>
                                            </li>
                                            <li class="indice-item">
                                                <a href="#a-cura-di" class="link-hover-underline text-decoration-none">A cura di</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-9 pt-4" id="single-content">
                        <?php if (has_post_thumbnail()) : ?>
                            <figure class="mb-4">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid w-100']); ?>
                            </figure>
                        <?php endif; ?>

                        <div id="descrizione">
                            <?php the_content(); ?>
                        </div>


                        <div id="a-cura-di" class="py-5">
                            <h2 class="mb-4 h2 ">A cura di <?php the_author(); ?></h2>

                            <div class="card-wrapper single-card-wrapper ">
                                <div class="card border border-primary rounded-4  ">
                                    <div class="card-body">
                                        <div class="d-flex flex-row justify-content-between align-items-start flex-wrap gap-3">
                                            <div class="card-text font-serif">
                                                <h4 class="text-primary  mb-4">Agenzia Nolana</h4>
                                                <p class="mb-3">Via Trivice d’Ossa, 28<br>80030 Camposano (Na)<br>Campania Italia</p>
                                                <p class="mb-1"><strong>PEC:</strong> agenziaareanolana@pec.it</p>
                                                <p class="mb-1"><strong>Telefono:</strong> 0818239106</p>
                                                <p class="mb-1"><strong>Fax:</strong> 08119143109</p>
                                                <p class="mb-0"><strong>Email:</strong> segreteria@agenziaareanolana.it</p>
                                            </div>
                                            <div>
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo Agenzia Nolana" class="img-fluid" style="max-height: 80px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Sezione "Esplora Novità" -->
                <div class="it-grid-list-wrapper mt-5">
                    <h2 class="it-heading-medium  mb-4
                    ">Esplora Novità</h2>
                    <div class="row g-5">
                        <!-- <div class="col-12 col-lg-4">
                            <div class="card-wrapper single-card-wrapper ">
                                <div class="card border border-secondary rounded-4  ">
                                    <div class="card-body">
                                        <h3><a href="/servizi/" class="link-hover-no-underline text-primary">Servizi</a></h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card-wrapper single-card-wrapper ">
                                <div class="card border border-secondary rounded-4  ">
                                    <div class="card-body">
                                        <h3><a href="/servizi/" class="link-hover-no-underline text-primary">News</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card-wrapper single-card-wrapper ">
                                <div class="card border border-secondary rounded-4  ">
                                    <div class="card-body">
                                        <h3><a href="/servizi/" class="link-hover-no-underline text-primary">Contatti</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <?php
                        $args = [
                            'post_type'      => 'news',
                            'posts_per_page' => 3,
                            'post__not_in'   => [get_the_ID()], // Esclude il post corrente
                        ];
                        $related_query = new WP_Query($args);
                        if ($related_query->have_posts()) :
                            while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                <div class="col-12 col-lg-4">
                                    <div class="card-wrapper ">
                                        <div class="card border border-secondary rounded-4 ">
                                            <div class="card-body ">
                                                <div class="head-tags d-flex justify-content-between align-items-start flex-wrap mb-4">
                                                    <div class="tags d-flex flex-wrap gap-2">
                                                        <?php $tags = get_the_tags(); ?>
                                                        <?php if ($tags) : ?>
                                                            <?php foreach ($tags as $tag) : ?>
                                                                <span class="badge bg-secondary"><?php echo esc_html($tag->name); ?></span>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>

                                                    <?php if (get_the_date()) : ?>
                                                        <div class="data text-end text-secondary small">
                                                            <?php echo esc_html(get_the_date()); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                                <h3 class="h5 text-primary">
                                                    <?php the_title(); ?>
                                                </h3>

                                                <?php if (the_excerpt()) : ?>
                                                    <p class="card-text font-serif mb-0"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                                <?php endif; ?>
                                                <a class="read-more" href="<?php the_permalink(); ?>">
                                                    <span class="text">Leggi di più</span>
                                                    <!-- <svg class="icon icon-primary">
                                                            <use href="/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>
                                                        </svg> -->
                                                </a>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        else : ?>
                            <p>Nessuna novità disponibile.</p>
                        <?php endif; ?>


                    </div>
                </div>

        <?php endwhile;
        endif; ?>
    </div>
</main>

<?php get_footer(); ?>