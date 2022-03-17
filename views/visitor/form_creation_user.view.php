<main>
    <h1>Créer un compte</h1>
    <div class="p_form mt-4">
        <form method="POST" action="validation_createUser">
            <div class="mb-3">
                <label for="login" class="form-label">Nom</label>
                <input type="text" class="form-control" id="login" name="login" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse mail</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" >
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>    
    </div>    
</main>


