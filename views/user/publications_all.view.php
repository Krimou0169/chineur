<main>
    <!-- en-tête du main -->
    <h2 class="fw-light">Toutes les annonces </h2>
    <!-- Les annonces -->
    <div class="album py-5 bg-light">
        <div class="container card-deck">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 card-deck">
                <?php foreach ($publications as $publication) :?>
                <div class="col">
                    <div class="card  shadow-sm text-center border-success card-deck">
                        <div class=" card-header border-success">
                            <h2><strong><?=$publication->getTitle()?></strong></h2>
                        </div>
                        <div class="card-body border-success">
                            <div class="card-body">
                                <img src="public/assets/images/user/<?=$publication->getImage()?>" class="d-block w-100" alt="image objet user"/>
                            </div>
                            <div class="card-text">
                                <span><b>Description :</b></span>
                                <p><?=$publication->getDescription()?></p>
                            </div>
                            <div class="card-text">
                                <span><b>Prix à partir de :</b></span>
                                <p ><?=$publication->getMinimalPrice()?></p>
                            </div>  
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center border-success item-center">
                            <div class="btn-group ">
                                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#publication<?=$publication->getId()?>">Proposer une offre</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <!--********* Modal *********-->
    <!-- Proposer une offre -->
    <?php foreach ($publications as $publication) :?>
    <div class="modal fade" id="publication<?=$publication->getId()?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h2><span class="text-capitalize"><?=$publication->getTitle()?></span></h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-text">
                        <img src="public/assets/images/user/<?=$publication->getImage()?>" class="d-block w-100" />
                    </div>
                    <div class="card-text">
                        <form method="POST" action="validation_addOffer">
                            <div class="mb-3">
                                <label for="text" class="form-label">Message :</label>
                                <input type="text" class="form-control" id="text" name="text">
                            </div>
                            <div class="mb-3">
                                <label for="price_proposal" class="form-label">Proposition de prix :</label>
                                <input type="number" class="form-control" id="price_proposal" name="price_proposal">
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="price_proposal" name="publication" value="<?=$publication->getId()?>">
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="price_proposal" name="buyer" value="<?=$_SESSION['profile']['login']?>">
                            </div>
                            <div class="modal-footer">
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                 </div>    
            </div>   
        </div>
    </div>    
    <?php endforeach; ?>
  
</main>
