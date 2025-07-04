<?php get_header(); ?>

<h2>Hello Word</h2>
<div class="d-flex gap-2 justify-content-around align-items-center">
    <a href="<?php echo get_post_type_archive_link('news'); ?>">Vai alle news</a>
    <a href="<?php echo get_post_type_archive_link('video'); ?>">Vai alle video</a>
    <a href="<?php echo get_post_type_archive_link('foto'); ?>">Vai alla galleria foto</a>
    <a href="<?php echo get_post_type_archive_link('servizi'); ?>">Vai ai servizi</a>
    <a href="<?php echo get_post_type_archive_link('rassegna-stampa'); ?>">Vai a rassegna stampa</a>
    <a href="<?php echo site_url('/shortlist'); ?>">Vai alla shirtlist</a>
    <div class="d-flex gap-2">
        <div class="search-button rounded-circle d-flex align-items-center justify-content-center ">
            <a href="<?php echo site_url('/ricerca'); ?>" class="search-icon">
                <button
                    class="btn rounded-circle ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                        <g fill="#0066cc" fill-rule="nonzero">
                            <g transform="scale(5.12,5.12)">
                                <path
                                    d="M21,3c-9.37891,0 -17,7.62109 -17,17c0,9.37891 7.62109,17 17,17c3.71094,0 7.14063,-1.19531 9.9375,-3.21875l13.15625,13.125l2.8125,-2.8125l-13,-13.03125c2.55469,-2.97656 4.09375,-6.83984 4.09375,-11.0625c0,-9.37891 -7.62109,-17 -17,-17zM21,5c8.29688,0 15,6.70313 15,15c0,8.29688 -6.70312,15 -15,15c-8.29687,0 -15,-6.70312 -15,-15c0,-8.29687 6.70313,-15 15,-15z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </button>
            </a>
        </div>

        <!-- <a href="<?php echo site_url('/?s='); ?>" class="search-icon">Search.php🔍</a> -->
    </div>
</div>




<!-- <?php get_search_form(); ?> -->




<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div><?php the_excerpt(); ?></div>
        </article>
    <?php endwhile; ?>
<?php else: ?>
    <p>Nessun contenuto trovato.</p>
<?php endif; ?>

<?php get_footer(); ?>