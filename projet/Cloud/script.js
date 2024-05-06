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

// Ajouter un dossier /fichier
const svgElement = document.getElementById("addfolder");

// Ajouter un écouteur d'événement de clic
svgElement.addEventListener("click", () => {
  // Créer un nouvel élément <input>

  let divContainer = document.createElement("div");

  let content1 = document.createElement("div");
  content1.classList.add('divadd')
  let content2 = document.createElement("div");
  content2.classList.add('divadd')

  // Créer les boutons radio
  let radioFile = document.createElement("input");
  radioFile.type = "radio";
  radioFile.name = "file-or-folder";
  radioFile.value = "file";
  radioFile.checked = true;

  let radioFolder = document.createElement("input");
  radioFolder.type = "radio";
  radioFolder.name = "file-or-folder";
  radioFolder.value = "folder";

  //création des label
  let labelInputFile = document.createElement("label");
  labelInputFile.htmlFor = "addfile";
  labelInputFile.textContent = "Ajouter un fichier";

  let labelInputFolder = document.createElement("label");
  labelInputFolder.htmlFor = "addfolder";
  labelInputFolder.textContent = "Ajouter un dossier";

  // Créer les champs d'entrée
  let inputFile = document.createElement("input");
  inputFile.type = "file";
  inputFile.id = "addfile";
  inputFile.name = "addfile";

  let inputFolder = document.createElement("input");
  inputFolder.id = "addfolder";
  inputFolder.name = "addfolder";
  inputFolder.classList.add("inputaddfolder");



  content1.appendChild(radioFile);
  content1.appendChild(labelInputFile);
  content1.appendChild(inputFile);
  // Ajouter les éléments à la div
  content2.appendChild(radioFolder);
  content2.appendChild(labelInputFolder);
  content2.appendChild(inputFolder);

  divContainer.appendChild(content2);
  divContainer.appendChild(content1);

  // Insérer la div dans le DOM
  svgElement.parentNode.replaceChild(divContainer, svgElement);

  // Ajouter un écouteur d'événement de pression de touche "Entrée"
  inputElement.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
      // Créer un nouvel élément <a>
      let path = document.querySelector('input[name="filename"]');
      let filePath;

      if (path.value === "") {
        filePath = "./cloud/";
      } else {
        filePath = "./cloud/" + path.value;
      }
      createFolderInPHP(inputElement.value, filePath);
      const linkElement = document.createElement("a");
      linkElement.textContent = inputElement.value;

      // Insérer l'élément <a> dans le DOM
      inputElement.parentNode.replaceChild(linkElement, inputElement);
    }
  });
});

// Fonction pour créer un dossier en utilisant la fonction PHP
async function createFolderInPHP(folderName, folderPath) {
  try {
    // Construire l'URL de la requête PHP
    const url = `test.php?folderName=${encodeURIComponent(
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


/* ecouteur d'evenement */
