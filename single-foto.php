<?php get_header(); ?>

<div class="container bg-white py-5">
    <h2 class="mb-4"><?php the_title(); ?></h2>

    <?php
    $galleria = get_post_meta(get_the_ID(), '_foto_galleria', true);
    if (!empty($galleria)) : ?>
        <div class="it-grid-list-wrapper it-image-label-grid">
            <div class="grid-row">
                <?php foreach ($galleria as $img) :
                    $img_id = is_array($img) ? $img['id'] : $img;
                    $caption = is_array($img) && isset($img['caption']) ? $img['caption'] : '';
                    $src_thumb = wp_get_attachment_image_src($img_id, 'large')[0];
                ?>
                    <div class="col-6 col-lg-4">
                        <div class="it-grid-item-wrapper">
                            <a href="<?php echo esc_url($src_thumb); ?>" data-lightbox="example-set"
                                <?php if ($caption): ?>
                                data-title="<?php echo esc_attr($caption); ?>"
                                <?php endif; ?>>
                                <figure class="figure img-full w-100">
                                    <img src="<?php echo esc_url($src_thumb); ?>"
                                        alt="<?php echo esc_attr($caption); ?>" class="figure-img img-fluid rounded">

                                    <?php if ($caption): ?>
                                        <figcaption class="figure-caption it-griditem-text-wrapper">
                                            <?php echo esc_html($caption); ?>
                                        </figcaption>
                                    <?php endif; ?>
                                </figure>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else : ?>
        <p class="text-center">Nessuna immagine trovata nella galleria.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>


<style>
    .lightbox .lb-image {
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }

    .lb-dataContainer {
        background: #fff;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .lb-nav a.lb-prev {
        opacity: 1;
    }

    .lb-nav a.lb-next {
        opacity: 1;
    }

    .lb-data .lb-details {
        width: 100%;
    }

    .lb-details .lb-number {
        text-align: center;
    }

    .lightbox .lb-close {
        display: none;
    }

    .lightbox .lb-details {
        padding-bottom: 1em;
    }

    .lb-number {
        padding-top: 1em;
    }
</style>