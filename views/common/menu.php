<!-- menu -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                  <div class="container-fluid">
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">                        
                        <?php if(!Security::isConnected()) : ?>
                        <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="<?= URL ?>accueil">Accueil</a>
                        </li>
                        <li class="nav-item"> 
                          <a class="nav-link" href="<?= URL ?>creer_compte" >Créer compte</a>
                        </li> 
                        <li class="nav-item">
                          <a class="nav-link" href="<?= URL ?>accueil" >Se connecter</a>
                        </li>       
                        <?php else : ?>
                        <li class="nav-item pe-3">
                                <a class="nav-link" aria-current="page" href="<?= URL ?>compte/accueil_utilisateur">Accueil</a>
                        </li>
                        <li class="nav-item pe-3">
                                <a class="nav-link" aria-current="page" href="<?= URL ?>compte/profil">Profil</a>
                        </li>
                        <li class="nav-item pe-3">
                                <a class="nav-link" aria-current="page" href="<?= URL ?>compte/creer_publication">Publier une annonce</a>
                        </li>
                        <li class="nav-item pe-3">
                                <a class="nav-link" aria-current="page" href="<?= URL ?>compte/publications">Toutes les annonces</a>
                        </li>
                        <li class="nav-item pe-3">
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Vendeur
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="annonces_en_cours">Annonces en cours</a></li>
                                        <li><a class="dropdown-item" href="#">Annonces Terminées</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Voir toutes mes annonces</a></li>
                                    </ul>
                                </div>
                        </li>
                        <li class="nav-item pe-3">
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Acheteur
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="">Annonces en cours</a></li>
                                        <li><a class="dropdown-item" href="#">Offres acceptées</a></li>
                                        <li><a class="dropdown-item" href="#">Offres refusées</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Voir toutes mes annonces</a></li>
                                    </ul>
                                </div>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href="<?= URL ?>compte/deconnexion">Se déconnecter</a>
                        </li>
                        
                      </ul>
                        <form class="d-flex ms-3"  method="POST" action="validation_search">
                            <input class="form-control me-sm-2" type="text" placeholder="Rechercher un objet" name="text">
                            <button class="btn btn-secondary my-2 my-sm-0 text-uppercase" type="submit">ok</button>
                        </form>
                        
                        <?php endif; ?>
                    </div>
                  </div>
                </nav>