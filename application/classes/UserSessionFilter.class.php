<?php




/* on va créer un filtre qui va être déclenché avant chaque controleur
   son rôle : créer une instance de UserSession et l'envoyer vers la vue
   (où l'on pourra vérifier si un utilisateur est connecté ou non
*/

// application/classes/UserSessionFilter.class.php

class UserSessionFilter implements InterceptingFilter
{
	public function run(Http $http, array $queryFields, array $formFields)
	{
    	// envoyer une instance de UserSession vers la vue
        return [
        	"userSession" => new UserSession()
        ];
    }

}
