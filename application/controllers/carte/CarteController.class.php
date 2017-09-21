<?php

class CarteController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
         $userSession = new UserSession();
         if (!$userSession->isAuthenticated()) {
             $http->redirectTo("/login");
         }

         $platModel = new ProduitModel();
         $plats = $platModel->getAll();
         //var_dump($plats);

        // dans cette architecture, on envoie les infos à la vue avec un return
        // les clés du tableau correspondent au nom des variables qui seront dispo dans la vue
        return
        ['plats' => $plats ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
    }
}
