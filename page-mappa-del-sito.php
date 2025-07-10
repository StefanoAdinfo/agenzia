<?php get_header(); ?>


<div class="container">

    <h1>Mappa del sito</h1>

    <div class="link-list-wrapper">
        <h4 class="link-list-heading">Home</h4>
        <ul class="link-list space-y-1">
            <span class="divider" role="separator"></span>
            <li><a class="list-item" href="<?php echo site_url('/'); ?>" data-focus-mouse="false"><span>Home</span></a></li>
            <li><a class="list-item" href="<?php echo site_url('/agenzia'); ?>" data-focus-mouse="false"><span>Chi siamo</span></a></li>
            <li><a class="list-item" href="<?php echo site_url('/elenco-servizi'); ?>" data-focus-mouse="false"><span>Servizi</span></a></li>
            <li><a class="list-item" href="<?php echo site_url('/short-list'); ?>" data-focus-mouse="false"><span>Lavoro</span></a></li>
            <li><a class="list-item" href="<?php echo site_url('/news'); ?>" data-focus-mouse="false"><span>News</span></a></li>
            <li><a class="list-item" href="<?php echo site_url('/ufficio-stampa'); ?>" data-focus-mouse="false"><span>Stampa</span></a></li>
            <li><a class="list-item" href="<?php echo site_url('/amm-ne-trasparente'); ?>" data-focus-mouse="false"><span>Amm.ne Trasparente</span></a></li>
            <li><a class="list-item" href="<?php echo site_url('/contatti'); ?>" data-focus-mouse="false"><span>Contatti</span></a></li>
            </li>
        </ul>
        <h4 class="link-list-heading">Chi Siamo</h4>
        <ul class="link-list space-y-1">
            <span class="divider" role="separator"></span>
            <li>
                <a class="list-item" href="<?php echo site_url('/agenzia/agenzia'); ?>" data-focus-mouse="false">
                    <span>L'Agenzia</span>
                </a>
            </li>
            <li>
                <a class="list-item" href="<?php echo site_url('/agenzia/i-comuni'); ?>" data-focus-mouse="false">
                    <span>I Comuni</span>
                </a>
            </li>
        </ul>
        <h4 class="link-list-heading">Lavoro</h4>
        <ul class="link-list space-y-1">
            <span class="divider" role="separator"></span>
            <li>
                <a class="list-item" href="<?php echo site_url('/short-list'); ?>" data-focus-mouse="false">
                    <span>Short List</span>
                </a>
            </li>
        </ul>
        <h4 class="link-list-heading">Stampa</h4>
        <ul class="link-list space-y-1">
            <span class="divider" role="separator"></span>
            <li><a class="list-item" href="<?php echo site_url('/ufficio-stampa'); ?>" data-focus-mouse="false"><span>Ufficio Stampa</span></a></li>
            <li><a class="list-item" href="<?php echo site_url('/comunicati'); ?>" data-focus-mouse="false"><span>Comunicati Stampa</span></a></li>
            <li><a class="list-item" href="<?php echo site_url('/rassegna-stampa'); ?>" data-focus-mouse="false"><span>Rassegna Stampa</span></a></li>
            <li><a class="list-item" href="<?php echo site_url('/foto'); ?>" data-focus-mouse="false"><span>Foto</span></a></li>
            <li><a class="list-item" href="<?php echo site_url('/video'); ?>" data-focus-mouse="false"><span>Video</span></a></li>
            <li><a class="list-item" href="<?php echo site_url('/contatti-stampa'); ?>" data-focus-mouse="false"><span>Contatti</span></a></li>
        </ul>
    </div>
</div>





<?php get_footer(); ?>