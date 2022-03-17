<?php

/* 
 * classe enfant UserManager étendue à la classe parent MainManager
 * Dans cette class on instanciera aussi la class User afin d'avoir accès aux getters et aux setters
 */

require_once("models/MainManager.model.php");
require_once "models/user/user/User.class.php";

class UserManager extends MainManager{
    
    private $users; //tableau d'objets users chargés.
    
    //*******************Gestion des objets uters***********************************************/
    
    public function addUserToObjectsArray($user)
    {
        //Rôle : ajout d'un user dans le tableau d'objets users[]
        //param: $user
        //retour: néant
        $this->users[] = $user;
    }
    public function getUsersObjects()
    {
        //Rôle: récupérer la liste d'objets users
        //param: néant
        //retour : tableau d'objets users
        return $this->users;
    }
    
    //Fonction de récupération des users de la bdd et création d'une ligne d'objet user dans le tableau $users
    public function loadingUsers(){
        $sql = 'SELECT * FROM users';
        $req = $this->getBdd()->prepare($sql);
        $req->execute();
        $allUsers = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        
        //création d'objets users
        foreach ($allUsers as $user) {
            $ligne = new User($user['login'], $user['email'], $user['password'], $user['is_valid'], $user['user_key']);
            $this->addUserToObjectsArray($ligne);
        }
    }
    //****************************Gestion de la création d'un compte****************************************/
    
   
    
    public function isLoginAvailable($login) {
        //Rôle: récupération des infos de l'adresse mail communiquée
        //param : login (mail)
        // retour : un user vide
        $user = $this->getUserInformations($login);
        return empty($user);
        
    }
    
     //*******************Gestion de la connection d'un utilisateur***********************************************/
    public function getPasswordUser($login){
        //Rôle : récupération du mp de l'utilisateur dont le login est précisé
        //param: login
        //retour : le mp
        $req = "SELECT password FROM users WHERE login = :login"; 
        $stmt = $this->getBdd()->prepare($req); 
        $stmt->bindValue(":login", $login, PDO::PARAM_STR); 
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        $stmt->closeCursor(); 
        return $result['password'];
    }

    public function isCombinationValid($login,$password) {
        //Rôle : vérifie si le mp et le login correspondent
        //param: login, password(saisi)
        //retour : True or False
        
        //récupération du password crypté de la bdd de l'utilisateur en cours et on le stocke dans $passwordHashBd
        $passwordHashDb = $this->getPasswordUser($login); 
        //vérification de la coresspondance entre le password soumis par un form et le mp crypté. Si ok retourne VRAI sinon retourne FAUX.
        return password_verify($password, $passwordHashDb); 
    } 
    public function isActiveEmail($login) {
        //Rôle : vérifie si l'email a été activé
        //param: login
        //retour : True or False
        $req = "SELECT is_valid FROM users WHERE login = :login"; //:login syntaxe apropriée à PDO. Bind value pour sécuriser l'info transmise à la fonction.
        $stmt = $this->getBdd()->prepare($req); //préparation de la req en PDO
        $stmt->bindValue(":login", $login, PDO::PARAM_STR); //élément de type string
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC); //FETCH_ASSOC pour récupérer seulement une valeur password
        $stmt->closeCursor(); //on ferme cette requête pour laisser place à d'autres.
        return ((int)$resultat['is_valid'])===1; //retourne le resultat du test : true ou false
    }
    
    
    /**************CREATE******************************************/
    public function addUserToDb($login, $email, $passwordHash, $userKey){
        //Rôle: ajout d'un user dans la bdd et ajout en tant qu'objet dans le tableau d'objet $users
        //param : les champs de la table users
        // retour : creerUser 
        $req = "INSERT INTO users (login, email, password, is_valid, user_key)"
                . " VALUES(:login, :email, :password, 0 ,:key_user)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $passwordHash, PDO::PARAM_STR);           
        $stmt->bindValue(":key_user", $userKey, PDO::PARAM_INT);            
        $creerUser = $stmt->execute();
        $stmt->closeCursor();
        
        //ajout de la la ligne user dans le tableau d'objets users
        if ($creerUser > 0){ //Si la ligne à été ajoutée dans la bdd
            $line = new User ($this->getBdd()->lastInsertId(), $login, $email, $passwordHash, $isValid, $userKey); //on insctancie la class User pour créer un objet
            $this->addUserToObjectsArray($line); //on l'ajoute dans le tableau d'objets users  
        }        
        return $creerUser;        
    } 
    
    public function dbEmailValidation($login, $key) {
        //Rôle: modifie la valeur de "is_valid" en mettant 1 pour un user(avec sa clé) donné
        //param : $login, $key
        // retour : $isUpdated 
        $req = "UPDATE users set is_valid = 1 WHERE login = :login and user_key = :user_key";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":user_key", $key, PDO::PARAM_STR);
        $stmt->execute();
        $isUpdated = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isUpdated;
    }   
    
    /**************UPDATE******************************************/
        //modification de mot de passe(réinitialisation, dans profil..)
    /**************DELETE******************************************/
    public function getUserInformations($login) {
        //Rôle: récupération des inforation d'un user
        //param : login
        // retour : tableau d'informations du user
        $req = "SELECT * FROM users WHERE login = :login"; 
        $stmt = $this->getBdd()->prepare($req); 
        $stmt->bindValue(":login", $login, PDO::PARAM_STR); 
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        $stmt->closeCursor(); 
        return $result;
    }
}

