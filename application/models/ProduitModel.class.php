<?php

class ProduitModel
{

	// Méthode qui interroge la base de données et renvoie les infos de tous les plats
    public function getAll()
    {
    	// récupérer l'objet permettant de communiquer avec la BDD
        $db = new Database();

        // Passer la requête
        $req = "SELECT * FROM produits";

        // Récupérer tous les résultats (fetchAll) et les renvoyer
        $plats = $db->query($req);
        return $plats;
    }



    public function getById( $idProduit )
    {
        $db = new Database();
        $req = "SELECT *
                FROM produits
                WHERE idProduit = :idProduit";

        $infosDuProd = $db->queryOne($req , [":idProduit" => $idProduit]);

        return $infosDuProd;
    }


    public function addProduitByAdmin($prixUnitaire, $nomProduit, $id_categorie, $imageProduit, $descriptionProduits)
    {
        $db = new Database();
        $req = "INSERT INTO produits (prixUnitaire, nomProduit, idCategorie, imageProduit, descriptionProduits)
                VALUES (:prixUnitaire, :nomProduit, :id_categorie, :imageProduit, :descriptionProduits)";
            var_dump($req);
        $res = $db->executeSql($req, array(
            ':prixUnitaire' => $prixUnitaire ,
            ':nomProduit' => $nomProduit,
            ':id_categorie' => $id_categorie,
            ':imageProduit' => $imageProduit,
            ':descriptionProduits' => $descriptionProduits
        ));
        var_dump($res);
    }
}
