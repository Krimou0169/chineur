    <header class="d-flex flex-wrap justify-content-center py-3 mb-5 border-bottom navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container container-fluid">
            <?php if(!Security::isConnected()) : ?>
            <a href="<?= URL ?>accueil" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img src="<?= URL ?>public/assets/images/logockawhite.png" alt="logo du site" width="80" />
                <span class="ms-5 fs-4 text-light">chineur</span>
            </a>
            <?php else : ?>
            <a href="<?= URL ?>compte/accueil_utilisateur" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img src="<?= URL ?>public/assets/images/logockawhite.png" alt="logo du site" width="80" />
                <span class="ms-5 fs-4 text-light">chineur</span>
            </a>
            <?php endif;?>
            <?php
            require_once($menu);
            ?>
        </div>
    </header>
    



