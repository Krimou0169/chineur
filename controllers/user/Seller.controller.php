<?php
//EXAM 2022 "CHINEUR"
require_once 'controllers/MainController.controller.php';
require_once 'models/user/publication/PublicationManager.model.php';
require_once 'models/user/offer/OfferManager.model.php';

class SellerController extends MainController{
    private $publicationManager; 
    private $offerManager; 
    
    
    public function __construct(){
        $this->publicationManager = new PublicationManager();
        $this->publicationManager->loadingPublications(); //chargement des publications objets.
        $this->offerManager = new OfferManager();
        $this->offerManager->loadingOffers(); //chargement des offres objets.
    }
    
//enrichissement des annonces par leur publication    
   public function getOffersByIdPublication($idPublication) {
        $offerList= array();
        foreach ($this->offerManager->getOffersObjects() as $offer) {
            if ($offer->getPublication() == $idPublication ){                          
                $offerList[] = $offer;
            }
        }
        return $offerList;
    }
    public function enrichPublication() {
        
        foreach ($this->publicationManager->getPublicationsObjects() as $publication) {
            $offerList = $this->getOffersByIdPublication($publication->getId());
            $publication->setOfferList($offerList);
            
        }
    }
  public function getPublicationBySeller($seller)
    {
        $publicationList = array ();
        foreach ($this->publicationManager->getPublicationsObjects() as $publication) {
            if ($publication->getSeller() == $seller) {
                $publicationList[] = $publication;
            }
        }
        return $publicationList;
        
    }
    
//Récupération de toutes les annonces en cours//
 
    
    public function getCurrentOffersByLogin($login)
    {
        $currentOffers = array();
        foreach ($this->offerManager->getOffersObjects() as $offer) {
            if($offer->getSeller() == $login){
                $currentOffers[] = $offer;
                }
        }
        return $currentOffers;
    }
    
    public function acceptOffer($idOffer){
         $this->offerManager->updateOfferAccepted($idOffer);
        Toolbox::ajouterMessageAlerte("Offre acceptée !", Toolbox::COULEUR_VERTE);
        header('Location: ' . URL . "compte/annonces_en_cours");
    }
    public function refuseOffer($idOffer){
         $this->offerManager->updateOfferRefused($idOffer);
        Toolbox::ajouterMessageAlerte("Offre refusée !", Toolbox::COULEUR_VERTE);
        header('Location: ' . URL . "compte/annonces_en_cours");
    }

    public function displayCurrentOffers(){
        $currentOffers = $this->getCurrentOffersByLogin($_SESSION['profile']['login']);
        $this->enrichPublication();
        $publications = $this->getPublicationBySeller($_SESSION['profile']['login']);
        
        $data_page = [
            "page_description" => "publication",
            "page_title" => "publications",
            "view" => "views/user/seller/current_offers.view.php",
            "currentOffers" => $currentOffers,
            "publications" => $publications, 
            "menu" => "views/common/menu.php",
            "template" => "views/common/template.php"  
        ];
        //print_r($publications);
        $this->generatePage($data_page);
    }  
}      

