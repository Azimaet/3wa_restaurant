'use strict'

var OrderForm = function() {
    this.panier = new Panier();
    this.ajaxMajPanier();
};

// Méthode qui permet de faire l'initialisation (mettre en place les écouteurs sur éléments d'interaction)
OrderForm.prototype.run = function() {

	// Ecoute des boutons ajouter
    $('.ajoutpanier').on('click', this.ajouterProduit.bind(this)); // avec le bind, this gardera la signification "instance" dans la méthode ajouterProduit
    $('.panierView').on('click', '#validationCmd' ,this.validerCommande.bind(this)); // le deuxieme parametre à droite du clic pour être plus précis
};

OrderForm.prototype.ajouterProduit = function(evt) {

 // lorsque le this garde la signification "instance", il nous reste toujours cette propriété de l'évènement pour viser l'élément du DOM qui vient de réagir
    var idProduit = $(evt.currentTarget).data("index"); // this.dataset.index
    var prixProduit = $(evt.currentTarget).data("prix");
    // Ajouter le produit au panier (appel à la méthode ajouter de this.panier)
    this.panier.ajouter(idProduit, prixProduit);

    // MAJ l'affichage de l'encart panier
    this.ajaxMajPanier();
};

OrderForm.prototype.ajaxMajPanier = function (){

    $.post(
        getRequestUrl()+"/panier",
        {
            Panier: this.panier.contenu
        },
        this.showPanier
    );
}

OrderForm.prototype.showPanier = function(panierView) {

    $(".panierView").html(panierView);
}

OrderForm.prototype.validerCommande = function(){
    $.post(
        getRequestUrl()+"/valider",
        {
            Panier: this.panier.contenu
        },
        this.confirmerCommande
    );
}
OrderForm.prototype.confirmerCommande = function(idCommande) {
    console.log(idCommande);

    // Vider le panier
    this.panier.contenu = [];
    this.panier.save();

    //window.location.href= getRequestUrl() + '/commandeconfirmation?id='+idCommande;
}
