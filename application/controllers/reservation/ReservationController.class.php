<?php


class ReservationController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        //on appelle une Usersession car il va falloir manipuler une session user
         $userSession = new UserSession();
         //Si l'user est loggé alors il esty renvoyé vers le formulaire de réservation
        if (!$userSession->isAuthenticated()) {
            $http->redirectTo("/login");
        }

        $form = new ReservationForm();
        return [ '_form' => $form ];

    }


    public function httpPostMethod(Http $http, array $formFields)
    {
        $userSession = new UserSession();

        if (!$userSession->isAuthenticated()) {
            $http->redirectTo("/login");
        }

        $patate = new ReservationModel();
        $d = $formFields["datePicked"];
        $df = substr($d,6,4) . '-' . substr($d,3,2) . '-' . substr($d,0,2) . ' ' . substr($d,11,5) . ':00';
        $patate->reservation($userSession->getIdUser(), $df, $formFields["nbCouverts"]);
        $form = new ReservationForm();
        return [ '_form' => $form ];

    }
}
