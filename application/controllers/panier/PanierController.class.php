<?php

class PanierController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        /* Avec un var_dump($formFields['panier']); , On va récupérer ce genre de trucs :
        [
        	[ 'id' => 2, 'qte' => 3],
            [ 'id' => 5, 'qte' => 2],
            [ 'id' => 7, 'qte' => 1]
        ]
        */

    	$produitModel = new ProduitModel;
        $tousLesPlatsQuiSontSelect = [];
        if (isset($formFields["Panier"])) {
            foreach ($formFields["Panier"] as $detailPanier) {

                // Récupérer depuis la BDD les infos d'un produit à partir de son id
                $infosPlat = $produitModel->getById($detailPanier['id']);


                // On ajoute au tableau une nouvelle entrée : la quantité (qu'on avait envoyé à notre webservice)
                $infosPlat['qte'] = $detailPanier['qte'];
                // Puis on ajoute le sous total (multiplier quantité * prix unitaire)
                $infosPlat['sous_total'] = $infosPlat['qte'] * $infosPlat['prixUnitaire'];
                // On a enfin un tableau avec toutes les infos d'un produit
                // On l'ajoute dans un tableau parent qui contiendra les infos de TOUS les produits
                array_push( $tousLesPlatsQuiSontSelect, $infosPlat );
            }



        }
        
        return [
           "panier" => $tousLesPlatsQuiSontSelect,
           "_raw_template" => true
       ];
     }
 }
