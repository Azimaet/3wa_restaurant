<?php

class LoginController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

         $login = new LoginForm();
         return [ '_form' => $login, 'message' => new FlashBag()];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        /*
         * Méthode appelée en cas de requête HTTP POST
         *
         * L'argument $http est un objet permettant de faire des redirections etc.
         * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
         */
         $userModel = new UserModel();
         /* Selon les infos envoyées via le formulaire, cette instruction peut fonctionner parfaitement (email inconnu en base)
       ou peut générer une erreur fatale (email déjà connu, c'est nous qui avons déclenché cette erreur avec un throw)
       On va donc "tester" ce code, c'est à dire qu'avant de l'éxécuter définitivement on regarde s'il génère des erreurs */
       try {
           $userModel->verifyLogin($formFields['email'], $formFields['password']);
        }
    /* Si le code testé génère des erreurs fatales, au lieu d'aller jusqu'à l'erreur fatale on va exécuter les instructions
       dans le bloc catch suivant*/
       catch(DomainException $e) //$e = DomainException, on l'attribut comme ça
        {
            // return [  ici c'est la méthode un peu basique, on rentre tout ce qu'on veut renvoyer ici en dur
            //          // "msgErreur" => $e->getMessage()
                     // "nom" => $formFields["nom"],
                     // "prenom" => $formFields["prenom"],
            //       ]
            $login = new LoginForm();
            //On va avoir besoin de lui passer toutes les value de la saisie précédente
            $login->bind($formFields);
            //On rapporte les infos qui étaient dans le contrôle à l'objet form qui va les envoyer dans la vue

           /* Si on a des infos à faire passer du contrôleur vers la vue, on a besoin du return
            on est dans un cas d'erreur ici, où il faut qu'on puisse revenir dans la page où on était, en lui mettant
            le message d'erreur, et le ramener sur le ême formulaire sans avoir à tout retaper.
            IL y a eu un aller retour au serveur, donc recharge de page, donc infos perdues normalement
            ON regarde là comment une fois rechargée, l'user récupère ses saisies pré-remplies.

           InscriptionForm, on lui dit que c'est un formulaire qui gère des champs nominés.
            */
            $login->setErrorMessage($e->getMessage());
            //ENvoie des infos liées au formulaire (saisies précédentes) à la vue
            return [ '_form' => $login, 'message' => new FlashBag()]; //_form c'est comme si on envoyait tout à la vue un part un

        }


        //En cas de réussite, càd on 'nest pas rentré dans le bloc catch qui interromp l'execution après le return)
         $messageBon = new FlashBag();

        $messageBon->add('Vous êtes connectés.');

        $http->redirectTo('/');


    }
}
