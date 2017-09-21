<?php

class ReservationModel
{
    public function reservation($idClient, $datePicked, $nbCouverts)
    {
        $db = new Database();
        $req = "INSERT INTO reservations (idClient, dateReservation, dateCreneau, nombreClients)
                VALUES (:idClient, now(), :dateCreneau, :nombreClients)";
        $res = $db->executeSql($req, array(
            ':idClient' => $idClient ,
            ':dateCreneau' => $datePicked,
            ':nombreClients' => $nbCouverts
        ));
    }
}
