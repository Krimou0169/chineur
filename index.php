<?php
//fichier de routage, redirection des liens.

// Initialisation : gestion du debug
ini_set("display_errors", true);
error_reporting(E_ALL);

//Création d'une constante URL pour que toutes les demandes de fichiers, pages...pointent sur la racine du site (index.php). 
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS'])? "https" : "http"). "://".$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"])); //chemin complet 

//on démarre la session pour pouvoir gérer le profil utilisateurs (login..)
session_start(); 


//Fichier contrôleur: Pilotage de tout le site (effectue les actions des utilisateurs - logique du site)
require_once 'controllers/Toolbox.class.php';
require_once 'controllers/Security.class.php';
require_once 'controllers/visitor/Visitor.controller.php';
require_once 'controllers/user/User.controller.php';
require_once 'controllers/user/Deal.controller.php';
require_once 'controllers/user/Seller.controller.php';

//intancie les classes afin d'accéder aux méthodes (fonctions)
$visitorController = new VisitorController(); 
$userController = new UserController(); 
$dealController = new DealController(); 
$sellerController = new sellerController(); 


//Ici, on gère les URLs demandées 
try {
    if (empty($_GET['page'])) { //est-ce $_GET['page'] est renseigné ? (index.php?page= )
    $page = "accueil";     //Si c'est vide on affiche la page d'accueil.
    } else { //SINON
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL)); //on "explose" l'url séparée par le caractère spécifique /. Toutes ces informations seront mis sous forme de tableau dans la variable $url. Filter_var et FILTER_SANITIZE_URL c'est pour sécuriser l'url en évitant l'intégration de caractères spéciaux.
        $page = $url[0]; //On affiche la page dont le nom est à l'indice 0 du tableau $url.Ce nom sera stocké dans la variable $page.
    }
//Initialisation des variables
    switch ($page) {
        case "accueil": //lien accueil         
            $visitorController->displayHome();
            break;               
        case "validation_login": //lien de la méthode POST du formulaire de connexion
            if(isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['password']) && !empty($_POST['password'])){
                $login = Security::secureHTML($_POST['login']);
                $password = Security::secureHTML($_POST['password']);
                $userController->validationLogin($login, $password);
            } else {
                Toolbox::ajouterMessageAlerte("Nom d'utilisateur ou mot de passe non renseigné !", Toolbox::COULEUR_ROUGE);
                header('Location: '.URL."accueil"); //rediretion du navigateur
            }
            break;
        case "creer_compte":
            $visitorController->displayUserCreationForm();
            break;
        case "validation_createUser":
            if(isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
                $login = Security::secureHTML($_POST['login']);
                $email = Security::secureHTML($_POST['email']);
                $password = Security::secureHTML($_POST['password']);
                $userController->validationCreateUser($login, $email,$password);
            }else {
                Toolbox::ajouterMessageAlerte("Remplir les champs !", Toolbox::COULEUR_ROUGE);
                header('Location: '.URL."creer_compte"); //redirection du navigateur
            }
            break;
        case "renvoyerMailValidation" : $userController->sendAgainValidationEmail($url[1]);
            break;                
        case "validation_mail" : $userController->validationEmailAccount($url[1], $url[2]);
            break;           
        case "reinit_password" : $userController->displayReinitPassword();
            break;           
        case "compte" :
            if(!Security::isConnected()){
                Toolbox::ajouterMessageAlerte("Veuillez vous connecter !", Toolbox::COULEUR_ROUGE);
                header('Location: '.URL."accueil");
            } else {
                switch($url[1]){
                    case "accueil_utilisateur":
                        $userController->userHome();                        
                        break;
                    case "creer_publication":
                        $dealController->displayCreatePublicationForm();                        
                        break;
                    case "validation_addPublication":
                        if(isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['minimum_price']) && !empty($_POST['minimum_price'])){
                            $title = Security::secureHTML($_POST['title']);
                            $description= Security::secureHTML($_POST['description']);
                            $minimumPrice = Security::secureHTML($_POST['minimum_price']);
                            $dealController->validationAddPublication($_SESSION['profile']['login'], $title, $description, $minimumPrice);
                                }else {
                                    Toolbox::ajouterMessageAlerte("Remplir les champs !", Toolbox::COULEUR_ROUGE);
                                    header('Location: '.URL."creer_publication"); //redirection du navigateur
                        }
                        break;
                    case "publications":
                        $dealController->displayPublications();                        
                        break;
                    case "validation_addOffer":
                        if(isset($_POST['text']) && !empty($_POST['text']) && isset($_POST['price_proposal']) && !empty($_POST['price_proposal'])){
                            $text = Security::secureHTML($_POST['text']);
                            $priceProposal= Security::secureHTML($_POST['price_proposal']);
                            $buyer = Security::secureHTML($_POST['buyer']);
                            $idPublication = $_POST['publication'];
                            $dealController->validationAddOffer($buyer, $text, $priceProposal, $idPublication);
                                }else {
                                    Toolbox::ajouterMessageAlerte("Remplir les champs !", Toolbox::COULEUR_ROUGE);
                                    header('Location: '.URL."creer_compte"); //redirection du navigateur
                        }
                        break;
                    case "recherche":
                        if(empty($url[2])){
                            $dealController->displaySearchForm();
                        }else if($url[2] == "contact"){
                            $dealController->displayContactForm($url[3]);
                        }
                        break;
                    case "validation_search":
                        if(!empty($_POST['text'])){
                            $textSearched = Security::secureHTML($_POST['text']);
                            $dealController->search($textSearched);
                        }else {
                            Toolbox::ajouterMessageAlerte("Remplir le champ de recherche !", Toolbox::COULEUR_ROUGE);
                            header('Location: '.URL."compte/recherche"); //rediretion du navigateur vers la page de recherche
                        }  
                        break;    
                   case "profil": 
                        $userController->profile();
                        break;
                   case "annonces_en_cours":
                        if(empty($url[2])){
                        $sellerController->displayCurrentOffers();
                        }else if ($url[2] == "accepted" ){
                            $sellerController->acceptOffer($url[3]);
                        } else if($url[2] == "refused"){
                            $sellerController->refuseOffer($url[3]);
                        }
                        break;
                    case "deconnexion": 
                        $userController->deconnexion();
                        break;
                    default : throw new Exception("La page n'existe pas !");
                }            
            }
            break;        
        //A défaut, on affiche une page erreur. 
        default: 
            throw new Exception("La page n'existe pas !"); //le routeur envoie la page d'erreur en captant l'exception.
            
    }    
} catch (Exception $e) {
    $visitorController->errorPage($e->getMessage());
}

