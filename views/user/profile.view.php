<h1>Profil de  <?= $_SESSION['profile']['login'] ?></h1>
<!-- menu bouton -->
<div class="btn-toolbar mt-4 mb-4" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group me-5" role="group" aria-label="First group">
        <button type="button" class="btn btn-outline-primary" id="parameterBtn">Paramètre</button>
    </div>
    <div class="btn-group me-5" role="group" aria-label="Second group">
        <button type="button" class="btn btn-outline-primary" id="profilBtn" >Profil</button>
    </div>
    <div class="btn-group me-5" role="group" aria-label="Third group">
        <button type="button" class="btn btn-outline-primary" id="passwordBtn">Mot de passe</button>
    </div>
    <div class="btn-group" role="group" aria-label="Third group">
        <button type="button" class="btn btn-outline-primary" id="deleteAccountBtn">Suppression compte</button>
    </div>
</div>
<!-- Votre compte -->
<div id="parameterDiv" class="div_invisible ">
    <div class="mb-5">
        <h3>Votre Compte</h3>
        <form method="POST" action="validation_updateEmail">
            <div class="d-flex">
                <p>Votre adresse actuelle : </p>
                <p> <b> <?= $user['email'] ?></b></p>
            </div>
            <div class="mb-3">
                <label for="newEmail" class="form-label">Entrer votre nouvelle adresse :</label>
                <input type="email" class="form-control" id="newEmail" aria-describedby="emailHelp" name="newEmail">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form> 
    </div>
    
</div>
<!--  Profil (nom,  profil(organisateur ou artiste) -->
<div id="profilDiv" class="div_invisible ">
    <div class="mb-5">
        <h3>Votre Profil</h3>
        <form method="POST" action="validation_updateProfile">
            <div class="row g-2 align-items-center">
                <div class="col-auto me-5">
                    <label for="loginNew" class="col-form-label">Saisir votre nouveau nom</label>
                    <input type="password" id="nameNew" class="form-control" aria-describedby="loginbNew" name="loginNew" placeholder="<?=$user['login']?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Modifier</button>
        </form> 
    </div>
    
</div>
<!-- Modification de mot de passe-->
<div id="passwordDiv" class="div_invisible ">
    <div class="mb-5">
        <h3>Mot de passe</h3>
        <form method="POST" action="validation_updatePassword">
            <div class="row g-2 align-items-center">
                <div class="col-auto me-5">
                    <label for="passwordOld" class="col-form-label">Entrer votre ancien mot de passe </label>
                    <input type="password" id="passwordOld" class="form-control" aria-describedby="passwordHelpInline" name="passwordOld">
                </div>
                <div class="col-auto">
                    <label for="passwordNew" class="col-form-label">Nouveau mot de passe</label>
                    <input type="password" id="passwordNew" class="form-control" aria-describedby="passwordHelpInline" name="passwordNew">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Modifier</button>
        </form>
    </div>
</div>
<!-- Suppression compte => supression profil-->
<div id="deleteAccountDiv" class="div_invisible">
    <div>
        <h3>Supression de votre compte</h3>
        <form method="POST" action="validation_deleteAccount" onSubmit="return confirm('Voulez-vous vraiment supprimer votre compte utilisateur ? Cela engendrera la supression de toutes vos informations !')">
            <button class="btn btn-danger mt-4" type="submit">Supprimer mon compte</button>
        </form>
    </div>
</div>
          