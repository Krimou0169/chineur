<?php
//EXAM 2022 "CHINEUR"
require_once 'controllers/MainController.controller.php';
require_once 'models/user/user/UserManager.model.php';

class UserController extends MainController{
    private $userManager; 
    
    
    public function __construct(){
        $this->userManager = new UserManager();
        $this->userManager->loadingUsers(); //chargement des users.
    }
    
//************************Récupérer tableau d'objets users*********************************//
   public function getUsersObjects() {
        $userObjects = $this->userManager;
        return $userObjects;
    }
    
//*************************Méthodes pour la connection d'un utilisateur*********************//    
public function validationCreateUser($login, $email, $password) {
        //Rôle : ajout d'un nouveau user dans la bdd
        //param: login, mp, email
        //retour: néant
        if($this->userManager->isLoginAvailable($login)){
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $key = rand(0,9999);
            if($this->userManager->addUserToDb($login, $email, $passwordHash, $key)){
                $this->sendEmailValidation($login, $email, $key); //fonction permettant d'envoyer un mail de validation sur la boîte mail du user.
                Toolbox::ajouterMessageAlerte("Votre compte a bien été créé ! Veuillez valider votre e-mail en cliquant sur le lien qui vous a été envoyé.", Toolbox::COULEUR_VERTE);
                header('Location: '.URL."accueil");
            } else {
                Toolbox::ajouterMessageAlerte("Erreur de création de compte, veuillez recommencer !", Toolbox::COULEUR_ROUGE);
                header('Location: '.URL."creer_compte");
            }   
        } else {
            Toolbox::ajouterMessageAlerte("Ce login est déjà utilisé !", Toolbox::COULEUR_ROUGE);
            header('Location: '.URL."creer_compte");
        }        
        
    }    
    public function sendEmailValidation($login, $email, $key) {
        //Rôle : Envoie un mail de validation
        //param : login, email, key
        //retour: néant
        $urlVerification = URL."validation_mail/".$login."/".$key; //le lien de validation afin de valider le mail de l'utilisateur.
        $sujet = "Validation de votre adresse e-mail pour le site \"chineur\""; //l'objet du mail
        $message = "Bonjour, pour valider votre compte veuillez cliquer sur le lien suivant : ".$urlVerification; // contenu du mail
        Toolbox::sendEmail($email, $sujet, $message);       
    }
    public function sendAgainValidationEmail($login) {
            $user = $this->userManager->getUserInformations($login);
            $this->sendEmailValidation($login, $user['email'], $user['user_key']);
            header('Location: '.URL."accueil");
    }
    public function validationEmailAccount($login, $clef) {
        if($this->userManager->dbEmailValidation($login, $clef)){
            Toolbox::ajouterMessageAlerte("Le compte a bien été activé !", Toolbox::COULEUR_VERTE);
            header('location: '.URL.'accueil');
        }else{
            Toolbox::ajouterMessageAlerte("Le compte n'a pas été activé !", Toolbox::COULEUR_ROUGE); 
            header('location: '.URL.'creer_compte');
        }
    }   
//*************************Méthodes pour la connexion d'un utilisateur*********************//
    //Validation du login et mp 
    public function validationLogin($login, $password) {
        //Vérification de la concordance login/mp
        if($this->userManager->isCombinationValid($login, $password)){//Si le login et mp sont valides
            //ET si l'email est actif
            if($this->userManager->isActiveEmail($login)){
                //on lance le message de succès
                Toolbox::ajouterMessageAlerte("Bonjour <span class='text-capitalize'>".$login. "</span> !" , Toolbox::COULEUR_VERTE);
                //on crée  un champ (tableau) profil dans $_SESSION
                $_SESSION['profile'] = [ 
                    "login" => $login, //on lui stocke le login
                ];
                //On redirige le navigateur vers la page de profil de l'utilisateur
                header("location: ".URL."compte/accueil_utilisateur");
            } else {
                //Sinon on lance un message d'alerte danger
                $message = "Votre compte n'a pas été activé par mail ! ";
                $message .= "<a href='renvoyerMailValidation/".$login."'>Renvoyer un mail de validation.</a>";
                Toolbox::ajouterMessageAlerte($message, Toolbox::COULEUR_ROUGE);
                
                //redirection vers la page de connexion
                header('Location: '.URL."accueil"); //redirection du navigateur
            }
        //Si le login et mp ne sont pas valides
        } else {
            //on envoie un message d'alert danger
            Toolbox::ajouterMessageAlerte("Désolé, nous ne reconnaissons pas ces identifiants.", Toolbox::COULEUR_ROUGE);
            //redirection vers la page de connexion
            header('Location: '.URL."accueil"); //redirection du navigateur
        }
    }  
    
    
    
    public function isConnected() {
        return(!empty($_SESSION['profile']));
        
    }
    
//***************************Méthodes deconnexion utilisateur********************************//    
    public function deconnexion(){
        Toolbox::ajouterMessageAlerte("Vous êtes à présent déconnecté !", Toolbox::COULEUR_VERTE);
        unset($_SESSION['profile']);
        header("Location: ".URL."accueil");
    }
 
    
       

//****************************Méthodes DIVERSES************************************//
   
//****************************Méthodes affichage pages ************************************//

    public function userHome(){
        $informationsUserlogOn = $this->userManager->getUserInformations($_SESSION['profile']['login']);
        $data_page = [
            "page_description" => "Page d'accueil d'un utilisateur",
            "page_title" => "Accueil utilisateur",
            "view" => "views/user/userHome.view.php",
            "informationsUserlogOn" => $informationsUserlogOn,
            "menu" => "views/common/menu.php",
            "template" => "views/common/template.php"  
        ];
        $this->generatePage($data_page);
    }  
    public function displayReinitPassword() {
        $data_page = [
            "page_description" => "Page de réinitialisation de mopt de passe",
            "page_title" => "Demande de réinitialisation de mot de passe",
            "view" => "views/user/reinit_password.view.php",
            "menu" => "views/common/menu.php",
            "template" => "views/common/template.php"  
        ];
        $this->generatePage($data_page);
    }
    public function profile(){
        $datas = $this->userManager->getUserInformations($_SESSION['profile']['login']);
        $data_page = [
            "page_description" => "Page de profil d'un utilisateur",
            "page_title" => "Page profil",
            "view" => "views/user/profile.view.php",
            "user" => $datas,
            "menu" => "views/common/menu.php",
            "template" => "views/common/template.php"  
        ];
        $this->generatePage($data_page);
    }
    
}      

