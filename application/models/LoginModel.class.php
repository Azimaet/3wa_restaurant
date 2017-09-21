<?php


class LoginModel {

    if (!empty($_POST)) {

            public function getAll()
            {
            	// récupérer l'objet permettant de communiquer avec la BDD
                $db = new Database();

                // Passer la requête

                $req =
                    'SELECT *
                     FROM clients
                     WHERE email = :email '

                $req->execute([
                    ":email" => $_POST["email"]
                ]);

                // Récupérer tous les résultats (fetchAll) et les renvoyer
                $accounts = $db->query($req);
                return $accounts;

                //Si cette concordance est établie...
                if ($accounts == true) {

                    //... alors on verifie que le password rentré par l'user correspond bien avec l'email
                    // (password crypté dans la BDD avec password normal rentré par le user)
                    if (password_verify($_POST['pass'] , $accounts['mdp'])){
                        $_SESSION['id'] = $accounts['auteurId'];
                        $_SESSION['prenom'] = $accounts['prenom'].' '.$accounts['nom'];
                    }
            //... sinon le password est faux!
                }
            }


      }
  }
