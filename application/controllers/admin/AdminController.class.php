<?php

class AdminController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        var_dump($_FILES);

        return ["form" => new AdminForm];
    }


    public function httpPostMethod(Http $http, array $formFields)
    {

        $photo = $http->moveUploadedFile('imageProduit', '/images/imagesPlats');
    	var_dump($photo);
        var_dump($formFields);
        $produitModel = new ProduitModel();

        $produitModel->addProduitByAdmin(0, $formFields['nomProduit'], 1, $photo, $formFields['descriptionProduits']);
                return ["form" => new AdminForm];
    }
}
