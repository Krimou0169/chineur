<?php

/* 
 *divers fonctions réutilisables plusieurs fois et partrout ailleurs.
 */

class Toolbox {
    
    public const COULEUR_ROUGE = ("alert-danger");
    public const COULEUR_ORANGE = ("alert-warning");
    public const COULEUR_VERTE = ("alert-success");
    
   public static function ajouterMessageAlerte($message, $type){
       //rôle : ajoute un message d'alert dans le tableau $_SESSION['alert']
       //paramètres: $message, $type
       //retour :néant
       
       $_SESSION['alert'][] = [
            "message" => $message,
            "type" => $type
        ];
   }
   
   
   public static function sendEmail($destinataire, $sujet, $message){
       //rôle : fonction permettant d'envoyer des mails aux utilisateurs.
       //paramètres: destinataire, un sujet et le message
       //retour :néant
       
       $headers = "From: kchliah@mywebecom.ovh"; //expéditeur.
       if(mail($destinataire, $sujet, $message,$headers)){ //fonction mail() de php
           //si le mail a bien été envoyé, on ajoute le message de succès 
           self::ajouterMessageAlerte("Mail envoyé !", self::COULEUR_VERTE);
       } else {
           //sinon le message d'erreur
           self::ajouterMessageAlerte("Mail non envoyé !", self::COULEUR_ROUGE);
       }
   }  
}