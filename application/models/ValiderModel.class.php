<?php

class ValiderModel
{

    	public function validerCommande($idClient)
        {
            $db = new Database();

            $req = "INSERT INTO commandes (idClient, dateCommande, dateLivraison, prixTotal)
                     VALUES (:idClient, NOW(), NOW(), :prixTotal)";
            $id_cmd = $db->executeSql($req, array(
                ':idClient' => $idClient,
                ':prixTotal' => 0
            ));
            return $id_cmd;
        }


        public function createDetailsCmd($idCommande, $idProduit, $quantiteProduits)
        {
            $db = new Database();

            $req = "INSERT INTO detailsCmd ( idCommande, idProduit, quantiteProduits)
                    VALUES (:idCommande, :idProduit, :quantiteProduits)";

            $detailsCmd = $db->executeSql($req, array(
                ':idCommande' => $idCommande,
                ':idProduit' => $idProduit,
                ':quantiteProduits' => $quantiteProduits
            ));

        }
}
