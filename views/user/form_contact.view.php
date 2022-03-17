            <div class="modal-content">
                <div class="modal-header ">
                    <h2><strong><?=$publication->getTitle()?></strong></h2>
                    <a href="<?= URL ?>compte/recherche" class="btn-close" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <div class="card-text">
                        <img src="<?=$publication->getImage()?>" class="d-block w-100" />
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
                                <input type="hidden" class="form-control" id="publication" name="publication" value="<?=$publication->getId()?>">
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="buyer" name="buyer" value="<?=$_SESSION['profile']['login']?>">
                            </div>
                            <div class="modal-footer">
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Envoyer mon offre</button>
                                     <a href="<?= URL ?>compte/recherche" class="btn btn-secondary" aria-label="Close">Revenir sur la page de recherche</a>
                                </div>
                            </div>
                        </form>
                    </div>
                 </div>    
            </div>   
