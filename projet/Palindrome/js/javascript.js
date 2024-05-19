appellefonctn()
function appellefonctn(){
  document.getElementById("textesaisi").addEventListener('input', verifierPalindrome);
}

function chainetransformer(chaine) {
    return chaine
      .toLowerCase()              //Majuscule -> Minuscule
      .replace(/[éèêë]/g, "e")    //remplace les accents du e
      .replace(/[àâ]/g, "a")      //remplace les accents du a
      .replace(/ç/g, "c")         //remplace la cedille
      .replace(/\s/g, "")         //supprime les espaces
      .replace(/[îï]/g, "i")     //remplace les accents du i
      .replace(/[ôöóòô]/g, "o")
      .replace(/[?’“”"«»,.;:!(){}[\]<>]/g, "");
    }

  // Fonction pour vérifier si la chaîne est un palindrome

  function estPalindrome(chaine) {
    let chaineNettoyee = chainetransformer(chaine);

    for (let i = 0; i < Math.floor(chaineNettoyee.length / 2); i++) {             //Boucle la moitier du nombre de lettre du mot
      if (chaineNettoyee[i] !== chaineNettoyee[chaineNettoyee.length - 1 - i]) {  //vérifie si la 1er et la deniere lettre sont 
        return false;                                                             //différentes et ainsi de suite
      }
    }
    return true; //sinon on retourne vrai
  }

// Fonction pour vérifier le palindrome lors de la saisie
  function verifierPalindrome() {
    //déclaration des variables
    let phrase = document.getElementById("textesaisi");
    let resultat = document.getElementById("resultat");
    let texteSaisi = phrase.value;

    //si input vide "veuillez entrer un texte", sinon si la fonction estpalindrome renvoie true "Palindrome", 
    //renvoie false "pas un Palindrome"
    if(phrase.value.trim() === ""){
        resultat.textContent = "Veuillez entrer un texte";
        resultat.style.color = "black";
    }else if (estPalindrome(texteSaisi) === true) {
      resultat.textContent = "Palindrome";
      resultat.style.color = "green";
    } else {
      resultat.textContent = "Pas un Palindrome";
      resultat.style.color = "red";
    }
  }


