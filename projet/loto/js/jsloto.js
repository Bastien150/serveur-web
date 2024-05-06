"use strict";

document.querySelector("#jouer").addEventListener("click", jouer);
/**
 * affiche le tirage aleatoire et verifie si des chiffres sont en commun avec le tirage si oui il les affiche
 */
function jouer() {
  //Déclaration des variables
  let tirage = recupereInput();
  let tiragealea = nombreAlea(tirage);

  //lance toute les fonctions
  affichage(verif(tiragealea, tirage));
  affichercommun(tiragealea, tirage);
  afficheralea(tiragealea);
}

/**
 * Affiche un message en fonction des nb en commun
 * @param {nombre} compteur
 */
function affichage(compteur) {
  let comm = document.querySelector("#commentaire");
  comm.style.display = "";
  if (compteur >= 1) {
    comm.innerText = "Vous avez eu " + compteur + " boule en commun";
  } else {
    comm.innerText = "Perdu. Dommage, réessayez ?";
  }
}

/**
 * recupere les nb du joueur qui ont etait sécurisé avant pour limiter les fonction appelé
 * @returns
 */
function recupereInput() {
  //Déclaration des variables
  let spans = document.querySelectorAll(".boulej");
  let contenuTableau = [];

  for (const element of spans) {
    let chiffre = parseInt(element.textContent, 10);
    contenuTableau.push(chiffre);
  }
  return contenuTableau;
}

document.querySelector("#valider").addEventListener("click", valider);
/**
 * verouille les btn et prend les nb select pour les faire verif avec la fonction secu dans la fonction bouton
 * @returns
 */
function valider() {
  //Déclaration des variables
  let inputs = document.querySelectorAll(".cell");
  let joueur = [];
  let display = document.getElementById("disp");
  let comm = document.querySelector("#commentaire");

  comm.style.display = "none";
  display.style.display = "";
  document.querySelector("#gagner").disabled = true;
  document.querySelector("#jouer").disabled = true;

  for (let cellule of inputs) {
    if (cellule.parentElement.classList.contains("clicked")) {
      let valeur = cellule.getAttribute("data-value") * 1;
      joueur.push(valeur);
    }
  }
  bouton(joueur);
  return joueur;
}

/**
 * appelle la fonction secu et si la secu est passé enlever disable aux deux btn
 * @param {Tableau} joueur Tableau chiffre choisi par joueur
 */
function bouton(joueur) {
  //Déclaration des variables
  let valider = secu(joueur);
  let resultatContainer = document.querySelector("#tirage");

  if (valider) {
    affichertiragej(joueur);
    document.querySelector("#gagner").disabled = false;
    document.querySelector("#jouer").disabled = false;
  } else {
    resultatContainer.innerHTML = "";
    document.querySelector("#gagner").disabled = true;
    document.querySelector("#jouer").disabled = true;
  }
}
/**
 * Affiche les nb du joueur dans les boules de loto
 * @param {Tableau} joueur Tableau chiffre choisi par joueur
 */
function affichertiragej(joueur) {
  //Déclaration des variables
  let resultatContainer = document.querySelector("#tirage");
  let stock = document.createElement("div");
  let titreboule = document.createElement("h3");

  //ajout des class, id ..
  resultatContainer.innerHTML = "";
  titreboule.className = "whole";
  titreboule.textContent = "Vos numéros : ";
  stock.className = "stock";
  resultatContainer.appendChild(titreboule);

  for (let i = 0; i < 5; i++) {
    //Déclaration des variables
    let conteneur = document.createElement("div");
    let img = document.createElement("img");
    let cercle = document.createElement("div");
    let spanChiffre = document.createElement("span");

    //ajout des class, id ..
    cercle.className = "cercle";
    img.src = "./img/boulealea.png";
    img.alt = "Cercle Image";
    conteneur.className = "conteneur";
    spanChiffre.innerText = joueur[i];
    spanChiffre.id = "tirage" + (i + 1);
    spanChiffre.className = "boulej";

    //Les afficher
    cercle.appendChild(img);
    cercle.appendChild(spanChiffre);
    conteneur.appendChild(cercle);
    stock.appendChild(conteneur);
  }
  //Déclaration des variables
  let conteneurCompl = document.createElement("div");
  let spanChiffreCompl = document.createElement("span");
  let cercleCompl = document.createElement("div");
  let imgCompl = document.createElement("img");

  //ajout des class, id ..
  imgCompl.src = "./img/boulecomp.png";
  conteneurCompl.className = "conteneur";
  cercleCompl.className = "cercle";
  spanChiffreCompl.className = "boulej";
  spanChiffreCompl.id = "tirage6";
  spanChiffreCompl.innerText = joueur[5];

  //Les afficher
  cercleCompl.appendChild(imgCompl);
  cercleCompl.appendChild(spanChiffreCompl);
  conteneurCompl.appendChild(cercleCompl);
  stock.appendChild(conteneurCompl);
  resultatContainer.appendChild(stock);
}

/**
 * Fonction pour ne pas avoir d'erreur de declaration cellule et complementaire
 * Ajouter la class .clicked si nb est cliquée par l'user
 * .clickedcompl pour le nb complémentaire
 */
function CreationEvent() {
  let cellules = document.querySelectorAll(".cell");
  for (let element of cellules) {
    let cellule = element;
    cellule.addEventListener("click", function () {
      cellule.parentElement.classList.toggle("clicked");
    });
  }

  let complementaire = document.querySelectorAll(".cellcomp");
  for (let element of complementaire) {
    let cellcomp = element;
    cellcomp.addEventListener("click", function () {
      cellcomp.parentElement.classList.toggle("clickedcompl");
    });
  }
}
CreationEvent();

/**
 * recupere le ou les nb complementaire du joueur
 * @returns
 */
function recupcompl() {
  let complementaire = document.querySelectorAll(".cellcomp");
  let valeursComp = [];

  for (let celluleComp of complementaire) {
    if (celluleComp.parentElement.classList.contains("clickedcompl")) {
      valeursComp.push(celluleComp.getAttribute("data-value") * 1);
    }
  }
  return valeursComp;
}

/**
 * verif si 5 nb initiaux sont select si oui ajoute le nb comp et verif si 1 nb compl est select
 * @param {Tableau} tirage Tableau chiffre choisi par joueur
 * @returns true si toutes les secu sont passés
 */
function secu(tirage) {
  //Déclaration des variables
  let comm = document.querySelector("#commentaire");
  let compl;

  if (tirage.length === 5) {
    compl = recupcompl();

    if (compl.length === 1) {
      //Passe la secu
      tirage.push(...compl);
      comm.style.color = "";
      comm.innerText = "";
      return true;
    } else if (compl.length < 1) {
      //Affiche Erreur
      comm.style.display = "";
      comm.style.color = "#bb2b2b";
      comm.innerText = "Erreur : Selectionner un nombre complémentaire";
      document.querySelector("#tiragealea").innerText = "";
      return false;
    } else {
      //Affiche Erreur
      comm.style.display = "";
      comm.style.color = "#bb2b2b";
      comm.innerText =
        "Erreur : Il y a " +
        (compl.length - 1) +
        " boule(s) complémentaires en trop.";
      document.querySelector("#tiragealea").innerText = "";
      return false;
    }
  } else if (tirage.length < 5) {
    //Affiche Erreur
    comm.style.display = "";
    comm.style.color = "#bb2b2b";
    comm.innerText =
      "Erreur : Il manque " + (5 - tirage.length) + " boule(s) à choisir";
    document.querySelector("#tiragealea").innerText = "";
    return false;
  } else {
    //Affiche Erreur
    comm.style.display = "";
    comm.style.color = "#bb2b2b";
    comm.innerText =
      "Erreur : Il y a " +
      (tirage.length - 5) +
      " boule(s) selectionné en trop.";
    document.querySelector("#tiragealea").innerText = "";
    return false;
  }
}

/**
 * Tire 5 nb aléatoire (entre 1 et 49) puis une derniere (entre 1 et 10) et lance la fonction verifalea
 * @param {Tableauinp} numbers
 * @returns
 */
function nombreAlea(numbers) {
  let tiragealea = [];

  //tire les 5b aleatoires (1 à 49) puis la complémentaire (1 à 9)
  for (let i = 0; i < 5; i++) {
    let numAlea = Math.floor(Math.random() * 49) + 1;
    tiragealea.push(numAlea);
  }
  tiragealea.push(Math.floor(Math.random() * 9) + 1);

  // Appel de la fonction verifalea avec le tirage en paramètre
  let estdiff = verifalea(tiragealea);

  //afficher dans les boules les nbalea si tout les nb sont différents
  if (estdiff) {
    return tiragealea;
  } else {
    return nombreAlea(numbers);
  }
}

/**
 * Affiche le Tirage aleatoire dans les boules
 * @param {Tableau} tiragealea Tableau du tirage aleatoire
 */
function afficheralea(tiragealea) {
  //déclaration des variables
  let resultatContainer = document.querySelector("#tiragealea");
  let titreboule = document.createElement("h3");
  let stock = document.createElement("div");

  //Ajout class, id ..
  resultatContainer.innerHTML = "";
  titreboule.className = "whole";
  titreboule.textContent = "Tirage : ";
  stock.className = "stock";
  resultatContainer.appendChild(titreboule);

  for (let i = 0; i < 5; i++) {
    //déclaration des variables
    let conteneur = document.createElement("div");
    let cercle = document.createElement("div");
    let img = document.createElement("img");
    let spanChiffre = document.createElement("span");

    //Ajout class, id ..
    conteneur.className = "conteneur";
    cercle.className = "cercle";
    img.src = "./img/boulej.png";
    img.alt = "Cercle Image";
    spanChiffre.className = "boule";
    spanChiffre.id = "alea" + (i + 1);
    spanChiffre.innerText = tiragealea[i];

    //Les afficher
    cercle.appendChild(img);
    cercle.appendChild(spanChiffre);
    conteneur.appendChild(cercle);
    stock.appendChild(conteneur);
  }

  // Ajouter la boule complémentaire
  let conteneurCompl = document.createElement("div");
  let imgCompl = document.createElement("img");
  let cercleCompl = document.createElement("div");
  let spanChiffreCompl = document.createElement("span");

  //Ajout class, id ..
  cercleCompl.className = "cercle";
  conteneurCompl.className = "conteneur";
  imgCompl.src = "./img/boulecomp.png";
  imgCompl.alt = "Boule complémentaire Image";
  spanChiffreCompl.className = "boule";
  spanChiffreCompl.id = "alea6";
  spanChiffreCompl.innerText = tiragealea[5];

  //Les afficher
  cercleCompl.appendChild(imgCompl);
  cercleCompl.appendChild(spanChiffreCompl);
  conteneurCompl.appendChild(cercleCompl);
  stock.appendChild(conteneurCompl);
  resultatContainer.appendChild(stock);
}

/**
 * Vérifier sur les nb du tirage aleatoire sont en double mais uniquement les initiaux
 * @param {TableauAlea} tiragealea
 * @returns
 */
function verifalea(tiragealea) {
  for (let i = 0; i < 5; i++) {
    for (let j = i + 1; j < 5; j++) {
      if (tiragealea[i] === tiragealea[j]) {
        // false si nb en double
        return false;
      }
    }
  }
  // true si tous les nb diff
  return true;
}

/**
 * Verifie si un ou plusieurs nombre est en commun avec le tirage
 * @param {TableauAléa} tirage nbalea
 * @param {Tableauinp} numbers nb choisis par le joueur
 */
function verif(tirage, numbers) {
  let compteur = 0;

  for (let i = 0; i <= 4; i++) {
    for (let j = 0; j <= 4; j++) {
      if (numbers[i] === tirage[j]) {
        compteur++;
      }
    }
  }

  if (numbers[5] === tirage[5]) {
    compteur++;
  }
  return compteur;
}

/**
 * Fonction qui change du tirage joueur si les chiffres si en commun avec tirage alea
 * @param {Tableaualea} tirage Tirage aleatoire
 * @param {Tableau} numbers Tirage du joueur
 * @returns
 */
function affichercommun(tirage, numbers) {
  let tj = document.querySelectorAll(".boulej");
  //boucle en fonction du nombre d'element dans le tableau du tj
  for (const element of tj) {
    element.style.color = "black";
  }
  //mettre en rouge les nb en commun avec le tirage aleatoire
  for (let i = 0; i <= 4; i++) {
    for (let j = 0; j <= 4; j++) {
      if (numbers[i] === tirage[j]) {
        document.querySelector("#tirage" + (i + 1)).style.color = "red";
      }
    }
  }
  if (numbers[5] === tirage[5]) {
    document.querySelector("#tirage6").style.color = "red";
  }
}

document.querySelector("#gagner").addEventListener("click", gagner);
/**
 * Fonction qui lance la fonction verif tant que tout les chiffre ne sont pas égaux
 */
function gagner() {
  //déclaration des variables
  let compteur;
  let nbalea;
  let nbtirage = 0;
  let comm = document.querySelector("#commentaire");
  let tiragej = recupereInput();

  //Boucle pour avoir le tirage aleatoire egal a celui choisit par le joueur
  do {
    nbalea = nombreAlea(tiragej);
    nbtirage++;
    compteur = verif(nbalea, tiragej);
  } while (compteur != 6 && compteur < 6);
  afficheralea(nbalea);
  affichercommun(nbalea, tiragej);
  comm.style.display = "";
  //espacement tout les trois caractères en partant de la gauche
  nbtirage = nbtirage.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  comm.innerText =
    "Avoir " + compteur + " boule en commun  en " + nbtirage + " tirages";
}
