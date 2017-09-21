'use strict';

/****************************************************************************************
***************************   METHODE REGEX *********************************************
*****************************************************************************************
function onInscriptionSubmit()
{
	var isValid = true;

    // à rajouter : plein de tests de cas d'erreur qui peuvent faire passer le booleen à false

    // est-ce que le nom contient au moins trois caractères ?
    if ($('#nom').val().length < 3)
    {
    	isValid = false;
        $('#nom').addClass("not-valid");
        $('#nom').after('<p class="msg-erreur">Le nom doit contenir au moins 3 caractères</p>');
    }




    // s'assurer que le mdp saisi contient au moins 8 caractères dont au moins un numéro, une majuscule, une minuscule, un spécial
    var regexMdp = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)([a-zA-Z0-9\W]{8,})$/
    if ( !regexMdp.test( $('#password').val() ) )
    {
    	isValid = false;
        $('#password').addClass("not-valid");
        $('#password').after('<p class="msg-erreur">Votre mot de passe doit contenir au moins 8 caractères dont un numéro, une majuscule, une minuscule, un caractère spécial</p>');
    }
    return isValid;
}

//////////////////
// CODE PRINCIPAL

$(function(){

	$('#formInscription').on("submit", onInscriptionSubmit);

});

******************************************************************************************/





/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////

function runFormValidation()
{
	// Vérifier si un form est présent dans la page
    var form = $('form[data-validation="true"]');

    if (form.length == 1)
    {
    	// Si oui créer un objet FormValidator associé
    	var formValidator = new FormValidator(form);
    	// et mettre en place l'écouteur au submit (appeler la méthode run)
    	formValidator.run();
    }
}

//Formulaire de commande quand il y en a un
function runCommande() {
	var orderForm = new OrderForm();
    orderForm.run();
}


/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

$(function(){
    console.clear();
	runFormValidation();
    $.datetimepicker.setLocale('fr');
    $('#datetimepicker').datetimepicker({
        format: 'd/m/Y H:i',
        minDate : 0,
        maxDate:'+1970/01/31',
        allowTimes:[
          '11:30','11:45','12:00','12:15','12:30','12:45',
          '13:00','13:15','13:30','13:45','14:00','14:15', '14:30',
          '18:30','18:45','19:00','19:15','19:30','19:45',
          '20:00','20:15','20:30','20:45','21:00','21:15','21:30','21:45',
          '22:00','22:15','22:30'
      ]
        });
    runCommande();
    //localStorage.clear();
    //window.localStorage.clear();
});
