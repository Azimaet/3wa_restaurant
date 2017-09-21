<?php
/* Une classe pour manipuler la session utilisateur */

class UserSession
{

	/*
    Constructeur __construct()
    Fait un session start si toutefois on ne l'a pas fait précédemment
    (cf classe FlashBag du framework où le constructeur fait qqch de semblable)
    */
    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
    }


    /*
    Méthode create
    Crée l'entrée dans le tableau $_SESSION qui nous indiquera qu'un utilisateur a réussi à se connecter
    et stocke quelques données de cet utilisateur
    Entrées : les infos à stocker (au minimum id et prénom)
    */

    public function create($id, $prenom)
    {
        $_SESSION['user'] = [
            'id' => $id,
            'prenom' => $prenom
        ];
    }

    /*
    Méthode isAuthenticated
    Vérifie si oui ou non un utilisateur est connecté (= s'il y a l'info en session)
    Sortie : un booléen
    */
    public function isAuthenticated()
    {
        return array_key_exists("user", $_SESSION);
    }

    /*
    Methode destroy
    Supprime l'info en session qui indique qu'un utilisateur est connecté
    */

    public function destroy()
    {
        unset($_SESSION["user"]);
    }
    /*
    Méthodes "accesseurs" lecture vers les infos de l'utilisateur en session (ex: getPrenom )
    */
    public function getPrenom()
    {
        return $_SESSION["user"]["prenom"];
    }

    public function getIdUser()
    {
        return $_SESSION["user"]["id"];
    }
}
