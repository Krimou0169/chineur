<?php
/* controller parent. Pilotage des actions émises par un utilisateur.
 */

require_once("controllers/Toolbox.class.php");  //fichier de différentes fonctions utilisables partout ailleurs.

abstract class MainController{ //
  
   
    protected function generatePage($data){
        //rôle : générer une page (l'afficher) en  créant des variables via la propriété extract.
        //param: $data
        //retour: néant
        extract($data); //on crée les variables du tableau $data grâce à extract      
        ob_start(); //système de buffer : Demarre le système de mémoire tampon
        require_once($view);
        $page_content = ob_get_clean(); //Qu'on déverse dans cette variable
        require_once($template);        
    }          
    
    protected function errorPage($message){
        //rôle : génère la page d'erreur avec le message d'ereur approprié.
        //param: $message
        //retour: néant
        $data_page = [
            "page_description" => "Page permettant de gérer les erreurs",
            "page_title" => "Page d'erreur",
            "message" => $message,
            "menu" => "views/common/menu.php",
            "view" => "views/error.view.php",
            "template" => "views/common/template.php"
        ];
        $this->generatePage($data_page);     
    }    
    
}
