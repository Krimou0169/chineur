/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*Gestion JS page profil user PERSO*/
var parameterBtn = document.querySelector("#parameterBtn"); //on récupère le btn
var profilBtn = document.querySelector("#profilBtn");
var passwordBtn = document.querySelector("#passwordBtn");
var deleteAccountBtn = document.querySelector("#deleteAccountBtn");

parameterBtn.addEventListener("click", function(){ //dès qu'on clique, on lance une fonction
    document.querySelector("#parameterDiv").classList.toggle("div_invisible"); //qui est d'afficher la div1 en supprimant la classe p_invisible
});
profilBtn.addEventListener("click", function(){ //dès qu'on clique, on lance une fonction
    document.querySelector("#profilDiv").classList.toggle("div_invisible"); //qui est d'afficher la div1 en supprimant la classe p_invisible
});
passwordBtn.addEventListener("click", function(){ //dès qu'on clique, on lance une fonction
    document.querySelector("#passwordDiv").classList.toggle("div_invisible"); //qui est d'afficher la div1 en supprimant la classe p_invisible
});
deleteAccountBtn.addEventListener("click", function(){ //dès qu'on clique, on lance une fonction
    document.querySelector("#deleteAccountDiv").classList.toggle("div_invisible"); //qui est d'afficher la div1 en supprimant la classe p_invisible
});