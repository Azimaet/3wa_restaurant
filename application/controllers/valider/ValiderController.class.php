<?php

class ValiderController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        //on appelle une Usersession car il va falloir manipuler une session user
         $userSession = new UserSession();
         //Si l'user est loggé alors il esty renvoyé vers le formulaire de réservation
        if (!$userSession->isAuthenticated()) {
            $http->redirectTo("/login");
        }

    }

    public function httpPostMethod(Http $http, array $formFields)
    {

        $userSession = new UserSession();

        if (!$userSession->isAuthenticated()) {
            $http->redirectTo("/login");
        }

        $id_user = $userSession->getIdUser();

        /*$dateNow = date("Y-m-d H:i:s");
        $dateLivraison = $dateNow + 2800;*/
        $patate = new ValiderModel();
        $id_commande = $patate-> validerCommande($id_user);


        foreach ($formFields['Panier'] as $detailCommande) {
            // Boucle pour recup id et quantité, pour chaque iteration on apelle la fonct
            //iopn creartedetailscmd.
            $patate->createDetailsCmd($id_commande, $detailCommande['id'], $detailCommande['qte']);
        }

        echo $id_commande;
        exit;
    }
}
