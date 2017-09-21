'use strict'
var Panier = function() {
	this.storageKey = "Panier"; // nom de l'emplacement du localStorage dans lequel on stocke notre panier
	this.contenu = null;
	this.load();
};

/*
	Charge dans la propriété contenu les informations stockées dans le localStorage
*/
Panier.prototype.load = function() {
	this.contenu = loadDataFromDomStorage( this.storageKey );
    // si on n'a aucun contenu dans le panier on veut au moins que la propriété soit un tableau vide
    if ( this.contenu == null ) {
    	this.contenu = [];
    }
}

Panier.prototype.save = function(){
    saveDataToDomStorage( this.storageKey, this.contenu );
}

/*
	Ajoute au panier le produit dont on passe l'id en paramètre
*/
Panier.prototype.ajouter = function(idProduit)
{
	// ETAPE 1 : Déterminer si oui ou non l'objet donc on a passé l'id est présent dans le panier
    // (Parcourir les contenus pour voir si l'un d'entre eux a une propriété id égale à l'idProduit passé en paramètre)
	var pos = null;
	for(var i=0; i< this.contenu.length; i++)
	{
		if (this.contenu[i].id == idProduit) {
			pos = i;
		}
	}

    //Pour tous les ÉLÉMENTS contenu dans le tableau...
    // Si l'article n'existe pas : Ajouter un élément dans le tableau contenu (id : idProduit passé en paramètre, quantite : 1)
    if ( pos == null ) {
		this.contenu.push( {
            "id" : idProduit,
            "qte" : 1
        } );
	}
	// Si le produit est enregistré: incrémenter la propriété quantite
    else {
		this.contenu[ pos ].qte++;
    }

    // Sauver le panier dans le localStorage
	this.save();
	console.log(this.contenu);
}
