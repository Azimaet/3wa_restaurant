<?PHP

class ReservationForm extends Form
{
    public function build()
    {
    	// on enregistre tous les champs du formulaire (avec les name tels qu'ils sont définis dans le html)
        $this->addFormField("datePicked");
        $this->addFormField("nbCouverts");
    }
}
