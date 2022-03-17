<h1>Publier une annonce</h1>        
<form method="POST" action="validation_addPublication" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Titre :</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description :</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
            <div class="mb-3">
                <label for="minimum_price" class="form-label">Prix minimum :</label>
                <input type="number" class="form-control" id="minimum_price" name="minimum_price">
            </div>
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <label class="input-group-text" for="image">Upload</label>
            </div>
            <button type="submit" class="btn btn-primary">Publier</button>
        </form>