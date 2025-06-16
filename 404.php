<?php get_header(); ?>

<main id="main" class="container my-5">

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 text-center">
            <div class="it-page-section">
                <h1 class="it-page-title mb-3">Oops! Pagina non trovata.</h1>
                <p class="lead">La pagina che stai cercando non esiste o è stata rimossa.</p>
                <p class="mb-4">Controlla l'indirizzo o torna alla homepage.</p>

                <a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>">
                    Torna alla home
                </a>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>