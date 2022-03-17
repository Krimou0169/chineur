<h1 class="text-center mb-5">Mes offres en cours</h1>
<div>
    <?php foreach ($publications as $publication): ?>
    <div class="border-top border-primary mb-5">
        <div class="bg-light">
        <h3>Objet : <?= $publication->getTitle()?></h3>
        <p>Mon Prix : <?= $publication->getMinimalPrice()?> €</p>
    </div>
    <table class="table text-center">
    <tr class="table-light">
        <th>acheteur</th>
        <th>Message</th>
        <th>Prix proposé(€)</th>
        <th  colspan="2">Action</th>
    </tr>
    <?php foreach ($publication->getOfferList() as $offer) :?>
            <?php if($offer->getStatus() == 0):?>
        <tr>
            <td class="align-middle"><?= $offer->getBuyer()?></td>
            <td class="align-middle"><?= $offer->getText()?></td>
            <td class="align-middle"><?= $offer->getPriceProposal() ?></td>
            <td class="align-middle"><a href="<?= URL ?>compte/annonces_en_cours/accepted/<?= $offer->getId(); ?>" class="btn btn-warning" id="accepted">Accepter</a></td>
            <td class="align-middle">
                <form method="POST" action="<?= URL ?>compte/annonces_en_cours/refused/<?= $offer->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment refuser cette offre ?')">
                    <button class="btn btn-danger" type="submit">Refuser</button>
                </form>
            </td>
        </tr>
        <?php endif;?>
    <?php endforeach; ?>
</table>
        </div>
    <?php endforeach;?> 
        
</div>


