<h1>Formulaire de recherche</h1>
<!-- formulaire de recherche par mot clé -->
<form class="mt-2 row g-2" method="POST" action="validation_search">
      <div class="col-auto input-group ">
          <label for="text" class="form-label me-2">Mot clé (dans descrption ou titre):</label>
          <input type="text" class="form-control" id="text" placeholder="Entrer un mot clé" name="text">
      </div>
      <div class="input-group col-auto">
          <label class="form-label me-2">Fourchette de  prix :</label>
          <span class="input-group-text">€</span>
          <span class="input-group-text">prix min</span>
          <input type="number" class="form-control" name="min_price" min="0">
          <span class="input-group-text me-2">.00</span>
          <span class="input-group-text">€</span>
          <span class="input-group-text">prix max</span>
          <input type="number" class="form-control" name="max_price">
          <span class="input-group-text">.00</span>
        </div>
        <div class="input-group">
            <label for="date" class="form-label  me-2">Date de publication :</label>
          <input type="date" class="form-control" id="date" name="date">
      </div>
    <div>
          <button type="submit" class="btn btn-secondary mb-3">Rechercher</button>
      </div>
</form>
<div>
    <table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Prix (€)</th>
        <th>Proposer offre</th>
    </tr>
    <?php foreach ($publications as $publication) :?>
        <tr>
            <td class="align-middle"><img src='public/assets/images/<?= $publication['image'] ?>' width="100px"> </td>
            <td class="align-middle"><?= $publication['title'] ?></td>
            <td class="align-middle"><?= $publication['description'] ?></td>
            <td class="align-middle"><?= $publication['minimal_price'] ?></td>
            <td class="align-middle"><a href="<?= URL ?>compte/recherche/contact/<?= $publication['id'] ?>" class="btn btn-warning">Proposer une offre</a></td>
        </tr>
    <?php endforeach; ?>
</table>
</div>


