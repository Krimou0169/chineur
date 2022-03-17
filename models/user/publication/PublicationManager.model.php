<?php

/* 
 * classe enfant PublicationManager étendue à la classe parent MainManager
 * Dans cette class on instanciera aussi la class Publication afin d'avoir accès aux getters et aux setters
 */

require_once("models/MainManager.model.php");
require_once "models/user/publication/Publication.class.php";

class PublicationManager extends MainManager{
    
    private $publications; //tableau d'objets publications chargés.
    
    //*******************Gestion des objets uters***********************************************/
    
    public function addPublicationToObjectsArray($publication)
    {
        //Rôle : ajout d'une publication dans le tableau d'objets publications[]
        //param: $publication
        //retour: néant
        $this->publications[] = $publication;
    }
    public function getPublicationsObjects()
    {
        //Rôle: récupérer la liste d'objets publications
        //param: néant
        //retour : tableau d'objets publications
        return $this->publications;
    }
    
    public function getPublicationById($id)
    {
        foreach ($this->publications as $publication) {
            if ($publication->getId() === $id) {
                return $publication;
            }
        }
        throw new Exception("L'annonce n'existe pas !");
    }
    
    
    public function loadingPublications(){
        //Rôle: chargement de toutes les publications de la bdd et création d'objets publications
        //param: néant
        //retour : tableau d'objets publications
        $sql = 'SELECT * FROM publications';
        $req = $this->getBdd()->prepare($sql);
        $req->execute();
        $allPublications = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        
        //création d'objets publications
        foreach ($allPublications as $publication) {
            $line = new Publication($publication['id'], $publication['seller'], $publication['title'], $publication['description'], $publication['image'], $publication['minimal_price']);
            $this->addPublicationToObjectsArray($line);
        }
    }
    
    /**************CREATE******************************************/
    public function addPublicationToDb($seller, $title, $description, $image, $minimalPrice){
        //Rôle: ajout d'une publication dans la bdd et ajout en tant qu'objet dans le tableau d'objet $publications
        //param : les champs de la table publications
        // retour : creerPublication 
        $req = "INSERT INTO publications (seller, title, description, image, minimal_price)"
                . " VALUES(:seller, :title, :description, :image ,:minimal_price)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":seller", $seller, PDO::PARAM_STR);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);           
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);            
        $stmt->bindValue(":minimal_price", $minimalPrice, PDO::PARAM_INT);            
        $createPublication = $stmt->execute();
        $stmt->closeCursor();
        
        //ajout de la la ligne publication dans le tableau d'objets publications
        if ($createPublication > 0){ //Si la ligne à été ajoutée dans la bdd
            $line = new Publication ($this->getBdd()->lastInsertId(), $seller, $title, $description, $image, $minimalPrice); //on insctancie la class Publication pour créer un objet
            $this->addPublicationToObjectsArray($line); //on l'ajoute dans le tableau d'objets publications  
        }        
        return $createPublication;        
    } 
  
    
    /**************UPDATE******************************************/
    /**************DELETE******************************************/
    
    
    //*****Recherch***//
    public function getPublicationsBySearch($textSearched) {
        //Rôle: recherche le texte dans le titre et la description de chaque objet
        //paramètres: textSearched
        //retour: un tableau de publication contenant le mot à chercher
        $sql = "SELECT *  FROM publications WHERE title LIKE '%$textSearched%' OR description LIKE '%$textSearched%'"; //création de la requête
        $stmt = $this->getBdd()->prepare($sql);//connexion à la bdd ET préparation de la req
        $stmt->execute();//exécution de la requête
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); //fermeture du statement
        return $results; //retourne le resultat
    }
       
}

