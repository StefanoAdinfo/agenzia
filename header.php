<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php wp_title('|', true, 'right');
            bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="bg-primary mb-5">
        <div class=" container d-flex gap-2 justify-content-around align-items-center ">


            <a class="text-white" href="<?php echo site_url('/'); ?>">Home</a>
            <a class="text-white" href="<?php echo get_post_type_archive_link('news'); ?>">Vai alle news</a>
            <a class="text-white" href="<?php echo get_post_type_archive_link('video'); ?>">Vai alle video</a>
            <a class="text-white" href="<?php echo get_post_type_archive_link('foto'); ?>">Vai alla galleria foto</a>
            <a class="text-white" href="<?php echo get_post_type_archive_link('servizi'); ?>">Vai ai servizi</a>
            <a class="text-white" href="<?php echo get_post_type_archive_link('rassegna-stampa'); ?>">Vai a rassegna stampa</a>
            <a class="text-white" href="<?php echo site_url('/shortlist'); ?>">Vai alla shirtlist</a>
            <a class="text-white" href="<?php echo site_url('/agenzia'); ?>">Agenzia</a>


            <form class="d-flex align-items-center mb-4 mt-2" action="<?php echo site_url('/'); ?>" method="get">
                <div class="me-2 flex-grow-1">
                    <input type="text" name="s" class="form-control bg-transparent text-white border-white" id="searchInput" placeholder="Cerca..." value="" />
                </div>

                <button class="btn btn-white d-flex align-items-center justify-content-center rounded-circle p-0" type="submit" style="width: 50px; height: 50px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                        <g fill="#0066CC" fill-rule="nonzero">
                            <g transform="scale(5.12,5.12)">
                                <path
                                    d="M21,3c-9.37891,0 -17,7.62109 -17,17c0,9.37891 7.62109,17 17,17c3.71094,0 7.14063,-1.19531 9.9375,-3.21875l13.15625,13.125l2.8125,-2.8125l-13,-13.03125c2.55469,-2.97656 4.09375,-6.83984 4.09375,-11.0625c0,-9.37891 -7.62109,-17 -17,-17zM21,5c8.29688,0 15,6.70313 15,15c0,8.29688 -6.70312,15 -15,15c-8.29687,0 -15,-6.70312 -15,-15c0,-8.29687 6.70313,-15 15,-15z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </button>
            </form>
        </div>

    </header>
    <main>


        <style>
            #searchInput::placeholder {
                color: white !important;
            }

            #searchInput::-ms-input-placeholder {
                /* For IE/Edge support */
                color: white !important;
            }
        </style>