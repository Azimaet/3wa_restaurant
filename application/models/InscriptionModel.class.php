<?php


class InscriptionModel
{
	// vérifie si l'email passé en paramètre est déjà utilisé par un compte en base
    //Dans la fonction seule, $email représente juste l'argument, il sera remplacé par
    //$this->isEmailAvailable($data["email"]) des qu'on l'appelle grâce a inscription(data) juste en dessous

	public function isEmailAvailable($email)
    {
        // récupérer l'objet permettant de communiquer avec la BDD
        $db = new Database();

        // Passer la requête, on regarde dans les emails en BDD et l'email que notre user a saisi
        $req = "SELECT *
                FROM clients
                WHERE emailClient = :email";

        //on execute notre requete (on appelle notre fonction spécialement créée dans le framework)
        $res = $db->queryOne($req, array(":email" => $email ));
        return empty($resultat); // empty renvoie true si le resultat est vide
    }


	public function inscription($data)
    {
    	// Vérifie d'abord s'il existe un compte déjà enregistré avec l'email que l'user vient de saisir
        $isEmailAvailable = $this->isEmailAvailable($data["email"]);
        // L'email n'est pas dispo : on déclenche une erreur
        if (!$isEmailAvailable)
        { //Si l'email n'est pas dispo, on créer une fonction ERREUR qui fait tout péter à l'aide de la fonction throw
            throw new DomainException("Création de compte impossible : il existe déjà un utilisateur avec cette adresse");
        }
        // L'email est dispo : on crée un compte utilisateur
        else
        {
        	$db = new Database();
            $req = "INSERT INTO clients (nomClient, prenomClient, emailClient, password, telephone, adresse, codePostal, ville)
                     VALUES (:nom, :prenom, :email, :password, :phone, :adresse, :cp, :ville)";
            $res = $db->executeSql($req, array(
                ':nom' => $data['nom'],
                ':prenom' => $data['prenom'],
                ':email' => $data['email'],
                ':password' => $data['password'],
                ':phone' => $data['phone'],
                ':adresse' => $data['adresse'],
                ':cp' => $data['cp'],
                ':ville' => $data['ville']
            ));
        }
    }
}
