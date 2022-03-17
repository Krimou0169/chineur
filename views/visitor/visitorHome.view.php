        <form method="POST" action="validation_login" class="mt-4">
            <fieldset>
                <legend>Pour commencer à chiner ou vendre un produit, veuillez vous connecter !</legend>
                <div class="form-group">
                    <label for="login" class="form-label mt-4">Login</label>
                    <input type="text" class="form-control" id="login" placeholder="Entrer votre login" name="login">
                    <small id="login" class="form-text text-muted">login unique.</small>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label mt-4">Mot de passe</label>
                    <input type="password" class="form-control" id="password" placeholder="Entrer votre mot de passe" name="password">
                    <a href="<?= URL ?>reinit_password" class="btn btn-link">Mot de passe oublié ?</a>
                </div>
                
                <button type="submit" class="btn btn-primary mt-4">Se connecter</button>
            </fieldset>
        </form>
