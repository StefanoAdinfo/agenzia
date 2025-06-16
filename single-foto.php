<?php get_header(); ?>

<div class="container bg-white py-5">
    <h2 class="mb-4">Galleria</h2>

    <?php
    $galleria = get_post_meta(get_the_ID(), '_foto_galleria', true);
    if (!empty($galleria)) : ?>
        <div class="masonry-gallery responsive-columns">
            <?php foreach ($galleria as $img) :
                $img_id = is_array($img) ? $img['id'] : $img;
                //  wp_get_attachment_caption($img_id)
                $caption = is_array($img) && isset($img['caption']) ? $img['caption'] : '';
                $src_thumb = wp_get_attachment_image_src($img_id, 'large')[0];
            ?>
                <div class="mb-4">
                    <a href="<?php echo esc_url($src_thumb); ?>"
                        data-lightbox="example-set"
                        <?php if ($caption): ?>
                        data-title="<?php echo esc_attr($caption); ?>"
                        <?php endif; ?>>
                        <img class="img-fluid rounded mb-2" src="<?php echo esc_url($src_thumb); ?>"
                            alt="<?php echo esc_attr($caption); ?>" />
                    </a>
                    <?php if ($caption): ?>
                        <p class="small text-muted tight-caption text-center"><?php echo esc_html($caption); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <style>
            .tight-caption {
                line-height: 1.3;
                font-size: 0.875rem;
            }

            .responsive-columns {
                column-count: 1;
                column-gap: 1.5rem;
            }

            .responsive-columns>div {
                break-inside: avoid;
            }

            @media (min-width: 768px) {
                .responsive-columns {
                    column-count: 2;
                }
            }

            @media (min-width: 992px) {
                .responsive-columns {
                    column-count: 3;
                }
            }

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

    <?php else : ?>
        <p class="text-center">Nessuna immagine trovata nella galleria.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>