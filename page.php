<?php
get_header();
?>

<main id="main" class="container py-5">
    <h1 class="mb-4"><?php the_title(); ?></h1>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <?php
                while (have_posts()) :
                    the_post();
                ?>
                    <div class="col-12 col-lg-4">
                        <?php the_content(); ?>
                    </div>
                <?php
                endwhile;
                ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>