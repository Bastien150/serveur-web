// Sélectionne tous les boutons avec la classe "rename"
let renameButtons = document.querySelectorAll(".rename");

// Rename fichier / dossier
renameButtons.forEach((button) => {
  button.addEventListener("click", function (event) {
    event.preventDefault();

    // Récupère l'ID du bouton cliqué
    let id = this.id;
    id = id.slice(7);

    // Sélectionne la balise <a> correspondante
    let link = document.getElementById(id);
    let lastname = document.getElementById(id).textContent;

    // Crée un nouvel élément <input>
    let input = document.createElement("input");
    input.classList.add("inputaddfolder");

    // Définit la valeur de l'input avec l'ID récupéré
    input.value = id;

    // Remplace la balise <a> par la balise <input>
    link.parentNode.replaceChild(input, link);

    // Ajoute un écouteur d'événement "keyup" à l'input
    input.addEventListener("keyup", function (event) {
      // Si la touche Entrée est enfoncée
      if (event.key === "Enter") {
        // Récupère la valeur de l'input
        let newId = this.value;
        link.textContent = newId;
        // Stocke la nouvelle valeur dans la session
        sessionStorage.setItem("rename", `vlink-${newId}`);

        // Remplace l'input par la balise <a>
        this.parentNode.replaceChild(link, this);

        let path = document.querySelector('input[name="filename"]');
        let folderPath;
        if (path.value === "") {
          folderPath = "./cloud/";
        } else {
          folderPath = "./cloud/" + path.value;
        }

        renamefinal(folderPath, lastname, newId);
      }
    });
  });
});
// Fonction pour rename un dossier en utilisant la fonction PHP
async function renamefinal(folderPath, Name, NewName) {
  try {
    // Construire l'URL de la requête PHP
    const url = `renamefile.php?folderPath=${encodeURIComponent(
      folderPath
    )}&Name=${encodeURIComponent(Name)}&NewName=${encodeURIComponent(NewName)}`;

    // Envoyer la requête HTTP à la fonction PHP
    const response = await fetch(url);

    if (response.ok) {
      // Récupérer le message de réponse
      const message = await response.text();
    }
  } catch (error) {}
  window.location.reload();
}


/* Delete fichier / dossier */

let deleteButtons = document.querySelectorAll(".deleute");

deleteButtons.forEach((button) => {
  button.addEventListener("click", () => {
    let namee = button.id;
    document.querySelector('input[name="fileNamedele"]').value = namee.slice(7);
    document.getElementById("del-file-select").textContent = namee.slice(7);

    let path = document.querySelector('input[name="filename"]');
    let filePath;

    if (path.value === "") {
      filePath = "./cloud/";
    } else {
      filePath = "./cloud/" + path.value;
    }
    document.querySelector('input[name="filePathdele"]').value = filePath;
  });
});




/* ouvrir un a la fois form upload file */
const accordions = document.querySelectorAll('#accordions details');

accordions.forEach(accordion => {
  accordion.addEventListener('toggle', () => {
    if (accordion.open) {
      accordions.forEach(otherAccordion => {
        if (otherAccordion !== accordion && otherAccordion.open) {
          otherAccordion.open = false;
        }
      });
    }
  });
});


let forms = document.querySelectorAll('.upload');
// crée un ficher ou un dossier 
forms.forEach(form => {
  let btnadd = document.getElementById('send-add-file')
  btnadd.addEventListener("click", function (event) {
    if(form.open){
      //chemin
      let path = document.querySelector('input[name="filename"]');
      let inputfile = document.getElementById(form.name);

      let filePath;
      if (path.value === "") {
        filePath = "./cloud/";
      } else {
        filePath = "./cloud/" + path.value;
      }

      if(inputfile.id == "upfolder"){
        //envoie pas le formulaire et crée le new dossier  
        event.preventDefault()
        createFolderInPHP(inputfile.value, filePath)
      }
  }
  })
  let inpfolder = document.getElementById('upfolder')
  inpfolder.addEventListener("keyup", function (event) {
    // Si la touche Entrée est enfoncée
    if (event.key === "Enter") {
      if(form.open){
        //chemin
        let path = document.querySelector('input[name="filename"]');
        let inputfile = document.getElementById(form.name);
  
        let filePath;
        if (path.value === "") {
          filePath = "./cloud/";
        } else {
          filePath = "./cloud/" + path.value;
        }
  
        if(inputfile.id == "upfolder"){
          //envoie pas le formulaire et crée le new dossier  
          event.preventDefault()
          createFolderInPHP(inputfile.value, filePath)
        }
    }
    }
  });
});



// Fonction pour créer un dossier en utilisant la fonction PHP
async function createFolderInPHP(folderName, folderPath) {
  try {
    // Construire l'URL de la requête PHP
    const url = `uploadfolder.php?folderName=${encodeURIComponent(
      folderName
    )}&folderPath=${encodeURIComponent(folderPath)}`;

    // Envoyer la requête HTTP à la fonction PHP
    const response = await fetch(url);

    if (response.ok) {
      // Récupérer le message de réponse
      const message = await response.text();
      console.log(message);
    } else {
      // Afficher une erreur si la requête a échoué
      console.error(
        `Erreur lors de la création du dossier : ${await response.text()}`
      );
    }
  } catch (error) {
    // Gérer les erreurs de la requête
    console.error("Erreur lors de la création du dossier :", error);
  }
  window.location.reload();
}

// Fonction pour enregistrer un fichier quelque soit l'extention en utilisant la fonction PHP
async function uploadFileFinal(filename, filePath) {
  try {
    // Construire les données à envoyer à la fonction PHP
    const formData = new FormData();
    formData.append('filename', filename);
    formData.append('filePath', filePath);

    // Envoyer la requête HTTP à la fonction PHP
    const response = await fetch('uploadfile.php', {
      method: 'POST',
      body: formData
    });

    if (response.ok) {
      // Récupérer le message de réponse
      const message = await response.text();
      console.log(message);
    } else {
      // Afficher une erreur si la requête a échoué
      console.error(`Erreur lors de l'enregistrement : ${await response.text()}`);
    }
  } catch (error) {
    // Gérer les erreurs de la requête
    console.error("Erreur lors de l'enregistrement :", error);
  }
}
