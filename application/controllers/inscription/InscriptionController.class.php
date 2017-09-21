<?php

class InscriptionController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
         $form = new InscriptionForm();
         // Envoi des infos liées au formulaire (saisies précédentes) à la vue
         return [ '_form' => $form ];
    }


    public function httpPostMethod(Http $http, array $formFields)
    {
    	$userModel = new UserModel();
        var_dump($formFields);
        /* Selon les infos envoyées via le formulaire, cette instruction peut fonctionner parfaitement (email inconnu en base)
           ou peut générer une erreur fatale (email déjà connu, c'est nous qui avons déclenché cette erreur avec un throw)
           On va donc "tester" ce code, c'est à dire qu'avant de l'éxécuter définitivement on regarde s'il génère des erreurs */

           // A l'interieur du try on met un code potentiellement problematique
        try {
    	    $userModel->inscription($formFields);

        }
        /* Si le code testé génère des erreurs fatales, au lieu d'aller jusqu'à l'erreur fatale on va exécuter les instructions
           dans le bloc catch suivant */
        catch(DomainException $e) {

            /*return [
                   	"msg_erreur" = $e->getMessage();
                       "nom" => $formFields["nom"],
                       "prenom" => $formFields["prenom"],
                       ...
                       ..
                       ...
                       ...
                   ]*/

                   /*
                   En cas d'erreur, on veut retourner vers la même vue avec le formulaire mais on doit lui envoyer
                   	- un message d'erreur à afficher au-dessus du formulaire
                       - une valeur pour chacun des champs pour que l'utilisateur retrouve sa saisie précédente au lieu de devoir tout retaper
                   Plutôt que d'envoyer une quinzaine de variables, on va créer un objet représentant le formulaire en utilisant une classe
                   fournie par le framework
                   cf http://localhost/ShareCode/InscriptionForm
                   */

                   $form = new InscriptionForm();
                   // lui passer toutes les values de la saisie précédente
                   $form->bind($formFields);
                   // lui passer le message d'erreur
                   $form->setErrorMessage($e->getMessage());
                   // Envoi des infos liées au formulaire (saisies précédentes) à la vue
                   return [ '_form' => $form ];
        }
        $messageOk = new FlashBag();

        $messageOk->add("Le compte est créé avec succès!");

        $http->redirectTo("");
    }
}
