<?php

/* 
 * Connexion à la base de données phpmyadmin (PDO)
 */

abstract class ModelPdo{ //abstract pour être utilisée par notre classe via l'extension (héritage)
    private static $pdo; //Déclaration de la variable statique (attribut). On stocke ici la connexion. 
    
    private static function setBdd(){ //connexion à la bdd en private
        
        self::$pdo = new PDO("mysql:host=localhost;dbname=projets_exam_kchliah", "kchliah","2+Qs93s6r?Y");//$dsn, $username, $pswd
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Pour gérer les erreurs
    }

    //Pour accéder à la fonction private à partir de la class parent mainManager
    protected function getBdd() {
        if (self::$pdo === null) { //si la connexion est null
            self::setBdd(); //on se connecte
        }
        return self::$pdo; //on retourne la connexion
    }
  
}

