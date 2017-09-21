<?php


/* Les classes présentes dans ce répertoire applications/forms représentent chacun des formulaires complexes de votre appli
   Elles héritent de la classe Form (source dans library/Form.class.php )
   Elles servent à centraliser les saisies de tous les champs, les messages d'erreur générés par une saisie s'il y en a
   Intérêt : c'est cet objet que vous envoyez intégralement de votre controleur vers votre vue, plutôt que d'envoyer toutes les infos séparément
   */

class InscriptionForm extends Form
{
    public function build()
    {
    	// on enregistre tous les champs du formulaire (avec les name tels qu'ils sont définis dans le html)
    	$this->addFormField("nom");
        $this->addFormField("prenom");
        $this->addFormField("email");
        $this->addFormField("password");
        $this->addFormField("phone");
        $this->addFormField("adresse");
        $this->addFormField("cp");
        $this->addFormField("ville");
    }
}
