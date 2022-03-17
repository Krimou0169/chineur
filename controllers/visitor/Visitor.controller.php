<?php
/* 
 * Fichier class VisitorController. Fonctions répondant aux demandes d'un visitor (pas de connexion)
 */
require './controllers/MainController.controller.php';
require_once './models/visitor/VisitorManager.model.php';

class VisitorController extends MainController{
    private $visitorManager; 
    
    public function __construct(){ //constructeur de l'objet VisiteurManager stocké dans l'attribut $visitorManager
        $this->visitorManager = new VisitorManager();             
    }
    
    public function displayHome(){
        //rôle : générer la page d'accueil visiteur (visiteur de l'application)avec ses variables
        //param: néant
        //retour: néant   
        $data_page = [
            "page_description" => "Page d'accueil d'un utilisateur non connecté (visiteur de l'application)",
            "page_title" => "Chineur Accueil",
            "view" => "views/visitor/visitorHome.view.php",
            "menu" => "views/common/menu.php",
            "template" => "views/common/template.php"            
        ];
        $this->generatePage($data_page);
    }
    public function displayUserCreationForm(){
        $data_page = [
            "page_description" => "Page de création d'un utilisateur",
            "page_title" => "Formulaire création compte",
            "view" => "views/visitor/form_creation_user.view.php",
            "menu" => "views/common/menu.php",
            "template" => "views/common/template.php"  
        ];       
        $this->generatePage($data_page);    
    }
    public function errorPage($message){ //héritage: appelle la fonction de la classe mère main
        parent::errorPage($message);     
    }     
    
}
