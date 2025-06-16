<?php get_header(); ?>

<main id="primary" class="site-main">

    <h1>Risultati per: <?php echo get_search_query(); ?></h1>

    <?php if (have_posts()) : ?>
        <ul>
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <p><?php the_excerpt(); ?></p>
                </li>
            <?php endwhile; ?>
        </ul>

        <?php the_posts_pagination(); ?>

    <?php else : ?>
        <p>Nessun risultato trovato.</p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>s