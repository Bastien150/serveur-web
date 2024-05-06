// la fonction calcul prend le poid et la taille et calcul l'IMC
function calcul() {
    //création et affectation des variables
    let taille = document.getElementById("nbtaille").value;
    oimc= document.querySelector("#imc")
    let poids = document.getElementById("nbpoid").value;
    let resultat = Math.floor(poids / (taille ** 2)*100)/100; 
    document.querySelector("#resultat").value = resultat;

// liste de si et sinon-si qui determine le commentaire et sa couleur de fond
    let imc; //variable du champs commentaire 
    if (resultat < 16.5) {
        imc = "Vous êtes en famine"; 
        oimc.style.backgroundColor = "blue" 
    } else if (resultat >= 16.5 && resultat < 18.5) {
        imc = "Vous êtes en maigreur";
        oimc.style.backgroundColor = "lightskyblue"
    }else if (resultat > 18.5 && resultat < 25) {
        imc = "Vous êtes en corpulence normal";
        oimc.style.backgroundColor = "blanchedalmond"
    }else if (resultat > 25 && resultat < 30) {
        imc = "Vous êtes en surpoids";
        oimc.style.backgroundColor = "yellow"
    }else if (resultat >= 30 && resultat < 35) {
        imc = "Vous êtes en obésité modérée";
        oimc.style.backgroundColor = "lightsalmon"
    }else if (resultat >= 35 && resultat < 40) {
        imc = "Vous êtes en obésité sévère";
        oimc.style.backgroundColor = "orange"
    }else if (resultat > 40) {
        imc = "Vous êtes en obésité morbide ou massive";
        oimc.style.backgroundColor = "red"
    }
    document.querySelector("#imc").value = imc; //renvoie le commentaire en fonction de l'imc
}

function verifieage() {
    //création et affectation des variables
    let oimc = document.querySelector("#imc");
    let age = parseFloat(document.getElementById("nbage").value);
    let taille = parseFloat(document.getElementById("nbtaille").value);
    let poids = parseFloat(document.getElementById("nbpoid").value);
    let resultat = "";
    document.querySelector("#resultat").value = resultat;

    //lance la fonction calcul si l'utilisateur a plus de 14 ans et a un poid et une taille existante et possible
    //si ce n'est pas le cas message "erreur de saisis" avec un fond rouge
    if (age <= 14) {
        afficherImage();
        oimc.value = "Vous êtes trop jeunes veuiller regarder le graphique";
        oimc.style.backgroundColor ="red";
        return;
    } else if (taille <= 0.54 || taille > 2.72) {
        oimc.style.backgroundColor = "red";
    } else if (poids <= 5.9 || poids >= 442) {
        oimc.value = "Erreur de saisie";
        oimc.style.backgroundColor = "red";
    } else {
        calcul();
        return;
    }
}

function afficherImage() {
    let genreSelect = document.getElementById("genreSelect");
    let imageContainer = document.getElementById("imageContainer");
    let selectedGenre = genreSelect.value;
    let imagePath;

    // Choisir l'image en fonction du genre sélectionné
    if (selectedGenre === "homme") {
        imagePath = "img/image_homme.gif";
    } else if (selectedGenre === "femme") {
        imagePath = "img/image_femme.gif";
    }

    // Afficher l'image
    imageContainer.innerHTML = "<img src='" + imagePath + "' alt='Image genre'>";
}