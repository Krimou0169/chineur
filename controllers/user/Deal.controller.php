<?php
//EXAM 2022 "CHINEUR"
require_once 'controllers/MainController.controller.php';
require_once 'models/user/publication/PublicationManager.model.php';
require_once 'models/user/offer/OfferManager.model.php';

class DealController extends MainController{
    private $publicationManager; 
    private $offerManager; 
    
    
    public function __construct(){
        $this->publicationManager = new PublicationManager();
        $this->publicationManager->loadingPublications(); //chargement des publications objets.
        $this->offerManager = new OfferManager();
        $this->offerManager->loadingOffers(); //chargement des offres objets.
    }
  
//****************************Méthodes d'ajout publication************************************//
    public function validationAddPublication($seller, $title, $description, $minimumPrice)
    {
        $file = $_FILES['image'];
        $directory = "public/assets/images/user/";
        $nameImageAdded= $this->addImage($file, $directory);
        $this->publicationManager->addPublicationToDb($seller, $title, $description, $nameImageAdded, $minimumPrice);
        Toolbox::ajouterMessageAlerte("Ajout réalisé avec succès !", Toolbox::COULEUR_VERTE);
        header('Location: ' . URL . "compte/accueil_utilisateur");
    }
     private function addImage($file, $directory){   
        //vérification de l'existance du répertoire
        if (!file_exists($directory)) mkdir($directory, 0777);
        //stocakage de l'etension de l'image
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $target_file = $directory. uniqid()."_".$file['name'];
        $nameImageAdded = uniqid(). "_" . $file['name'];

        //vérification des données du fichier chargé
        if (!isset($file['name']) || empty($file['name']))
            throw new Exception("Vous devez indiquer une image");
        if (!getimagesize($file["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("L'extension du fichier n'est pas reconnu");
        if ($file['size'] > 50000000)
            throw new Exception("Le fichier est trop gros");

        //le chargement de l'image s'est bien passé
        if (!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("l'ajout de l'image n'a pas fonctionné");
        else return ($nameImageAdded);
    }    
//****************************Méthodes d'ajout offre************************************//       
    public function validationAddOffer($buyer, $text, $priceProposal, $idPublication) {
        //Rôle : ajout d'une proposition d'offre dans la bdd
        //param: $text, $proposalPrice
        //retour: néant
        if($this->offerManager->addOfferToDb($buyer, $text, $priceProposal, $idPublication)){
                Toolbox::ajouterMessageAlerte("Votre annonce à bien été enregistrée !", Toolbox::COULEUR_VERTE);
                header('Location: '.URL."compte/accueil_utilisateur");  
        } else {
            Toolbox::ajouterMessageAlerte("Erreur", Toolbox::COULEUR_ROUGE);
            header('Location: '.URL."compte/creer_publications");
        }        
        
    }


//******************************RECHERCHE**************************************************//
    
    public function search($textSearched){
        //Rôle : récupération du texte saisi par un utilisateur dans la barre recherche de l'accueil  et recherche avec les données de la bdd
        //Paramètres: texte à chercher ($matchText)
        
        //Si la recherche est réussie (match)
        
        if($this->publicationManager->getPublicationsBySearch($textSearched)){
            //Un message de succès est envoyé
            Toolbox::ajouterMessageAlerte('Recherche de "' .$textSearched. '" OK !', Toolbox::COULEUR_VERTE);
            
            $publications = $this->publicationManager->getPublicationsBySearch($textSearched);
            $data_page = [
                "page_description" => "Page de recherche d'objet",
                "page_title" => "Recherche objet",
                "publications" => $publications,
                "view" => "views/user/form_search.view.php",
                "menu" => "views/common/menu.php",
                "template" => "views/common/template.php"  
            ];
            $this->generatePage($data_page);
        } else {
            //SINON un message d'alert est envoyé 
            Toolbox::ajouterMessageAlerte("Aucune annonce correspondant à votre recherche n'a été trouvée. Veuillez taper un autre mot.", Toolbox::COULEUR_ROUGE);
            //ET le navigateur est redirigé vers le formulaire de recherche dans accueil
            header('Location: '.URL."compte/recherche");
        } 
    } 
//****************************Méthodes affichage pages ************************************//

    public function displayPublications(){
        $publications= $this->publicationManager->getPublicationsObjects();
        $data_page = [
            "page_description" => "publication",
            "page_title" => "publications",
            "view" => "views/user/publications_all.view.php",
            "publications" => $publications,
            "menu" => "views/common/menu.php",
            "template" => "views/common/template.php"  
        ];
        $this->generatePage($data_page);
    }  
    public function displayCreatePublicationForm(){
        $data_page = [
            "page_description" => "Ajout d'une publication",
            "page_title" => "Formulaire d'ajout d'annonce",
            "view" => "views/user/form_create_publication.view.php",
            "menu" => "views/common/menu.php",
            "template" => "views/common/template.php"  
        ];
        $this->generatePage($data_page);
    }  
    public function displayCreateOfferForm(){
        $data_page = [
            "page_description" => "Proposition d'offre",
            "page_title" => "Formulaire de proposition d'offre",
            "view" => "views/user/form_create_offer.view.php",
            "menu" => "views/common/menu.php",
            "template" => "views/common/template.php"  
        ];
        $this->generatePage($data_page);
    }  
    public function displaySearchForm(){
        $publications = $this->publicationManager;
        $textSearched = "velo";
        $tit = $this->publicationManager->getPublicationsBySearch($textSearched);
        $data_page = [
            "page_description" => "Page de recherche d'objet",
            "page_title" => "Recherche objet",
            "publications" => $publications,
            "tit" => $tit,
            "view" => "views/user/form_search.view.php",
            "menu" => "views/common/menu.php",
            "template" => "views/common/template.php"  
        ];
        //print_r($publications);
        print_r($tit);
        $this->generatePage($data_page);
    }  
    public function displayContactForm($id){
        $publication = $this->publicationManager->getPublicationById($id);
        $data_page = [
            "page_description" => "Page de proposition d'offre",
            "page_title" => "Proposer une offre",
            "publication" => $publication,
            "view" => "views/user/form_contact.view.php",
            "menu" => "views/common/menu.php",
            "template" => "views/common/template.php"  
        ];
        $this->generatePage($data_page);
    }  
    
}      

