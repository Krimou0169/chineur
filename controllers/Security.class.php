<?php

/* 
 *fichier de la classe Security
 */

class Security {
    public static function secureHTML($chaineDeCaractere) {
        //rôle : Reserved characters in HTML are replaced with character entities
        //param: $chaineDeCaractere
        //retour: néant
        
        return htmlentities($chaineDeCaractere);
    }
    
    public static function isConnected() {
        //rôle : vérifie si un user est connecté
        //param: néant
        //retour: $_SESSION['profile']
        return(!empty($_SESSION['profile']));
    }
}

