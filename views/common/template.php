<!DOCTYPE html>
<!-- Application exam 2022 "CHINEUR"-->
<?php
//Modèle de structure utilisé par toutes les pages. Tous les meta (le contenu, description, titre .. référencement) sont mis dans des variables.
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $page_description; //La description de chaque page dans une variable?>">
        <title><?= $page_title; //Le titre de chaque page dans une variable?></title>
        <!-- css du framework bootswatch -->
        <link rel="stylesheet" href="https://bootswatch.com/5/minty/bootstrap.min.css">
        <!-- css personnalisé -->
        <link href="<?= URL ?>public/css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php require_once("views/common/header.php"); ?>
        <!-- principal -->
        <main>
            <div class="container"> 
                <?php 
                //message d'alert
                    if(!empty($_SESSION['alert'])){
                        foreach ($_SESSION['alert'] as $alert) {
                            echo "<div class='alert " . $alert['type'] . "'role='alert'> 
                                ".$alert['message']."</div>";

                        }
                        //on nettoie le session alerte
                        unset($_SESSION['alert']);    
                    }        
                ?>
                <?= $page_content; //Contenu de la page ?>
            </div>            
        </main>
        <?php include ("views/common/footer.php"); ?>
        <!-- js du framework bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- js personnalisé -->
    <script src="<?= URL ?>public/javascript/ajax.js" type="text/javascript"></script>
    <script src="<?= URL ?>public/javascript/main.js" type="text/javascript"></script>
    <script src="<?= URL ?>public/javascript/mainProfile.js" type="text/javascript"></script>
    </body>
</html>

