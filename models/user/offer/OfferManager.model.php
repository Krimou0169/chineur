<?php

/* 
 * classe enfant OfferManager étendue à la classe parent MainManager
 * Dans cette class on instanciera aussi la class Offer afin d'avoir accès aux getters et aux setters
 */

require_once("models/MainManager.model.php");
require_once "models/user/offer/Offer.class.php";

class OfferManager extends MainManager{
    
    private $offers; //tableau d'objets offers chargés.
    
    //*******************Gestion des objets uters***********************************************/
    
    public function addOfferToObjectsArray($offer)
    {
        //Rôle : ajout d'une offre dans le tableau d'objets offers[]
        //param: $offer
        //retour: néant
        $this->offers[] = $offer;
    }
    public function getOffersObjects()
    {
        //Rôle: récupérer la liste d'objets offers
        //param: néant
        //retour : tableau d'objets offers
        return $this->offers;
    }
    
    
    public function loadingOffers(){
        //Rôle: chargement de toutes les offers de la bdd et création d'objets offers
        //param: néant
        //retour : tableau d'objets offers
        $sql = 'SELECT * FROM offers';
        $req = $this->getBdd()->prepare($sql);
        $req->execute();
        $allOffers = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        
        //création d'objets offers
        foreach ($allOffers as $offer) {
            $line = new Offer($offer['id'], $offer['buyer'], $offer['text'], $offer['price_proposal'], $offer['status'], $offer['final_choice'],$offer['publication'], $offer['seller']);
            $this->addOfferToObjectsArray($line);
        }
    }
    public function getOfferById($id)
    {
        foreach ($this->offer as $offer) {
            if ($offer->getId() === $id) {
                return $offer;
            }
        }
        throw new Exception("L'utilisateur n'existe pas !");
    }
        
    
    /**************CREATE******************************************/
    public function addOfferToDb($buyer, $text, $priceProposal, $publication, $seller){
        //Rôle: ajout d'une offer dans la bdd et ajout en tant qu'objet dans le tableau d'objet $offers
        //param : les champs de la table offers
        // retour : creerOffer 
        $req = "INSERT INTO offers (buyer, text, price_proposal, status, publication)"
                . " VALUES(:buyer, :text, :price_proposal , 0, 0, :publication, :seller)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":buyer", $buyer, PDO::PARAM_STR);
        $stmt->bindValue(":text", $text, PDO::PARAM_STR);
        $stmt->bindValue(":price_proposal", $priceProposal, PDO::PARAM_INT);                      
        $stmt->bindValue(":publication", $publication, PDO::PARAM_STR);                       
        $stmt->bindValue(":seller", $publication, PDO::PARAM_STR);                       
        $createOffer = $stmt->execute();
        $stmt->closeCursor();
        
        //ajout de la la ligne offer dans le tableau d'objets offers
        if ($createOffer > 0){ //Si la ligne à été ajoutée dans la bdd
            $line = new Offer ($this->getBdd()->lastInsertId(), $buyer, $text, $priceProposal, $publication, $seller); //on insctancie la class Offer pour créer un objet
            $this->addOfferToObjectsArray($line); //on l'ajoute dans le tableau d'objets offers  
        }        
        return $createOffer;        
    } 
  
    
    /**************UPDATE******************************************/
    /**************DELETE******************************************/
    public function updateOfferAccepted($id){
        $req1 = "UPDATE offers set status = 1 , final_choice = 'A'  WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req1);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;  
    }
    public function updateOfferRefused($id){
        $req2 = "UPDATE offers set status = 1, final_choice = 'R' WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req2);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }
       
}

