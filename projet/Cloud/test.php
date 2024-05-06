<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="#" id="addfolder">zuuuu</a>
</body>
<script>
const svgElement = document.getElementById("addfolder");

// Ajouter un écouteur d'événement de clic
svgElement.addEventListener("click", () => {
        // Créer la div
let divContainer = document.createElement("tr");

// Créer les boutons radio
let radioFile = document.createElement("input");
radioFile.type = "radio";
radioFile.name = "file-or-folder";
radioFile.value = "file";

let radioFolder = document.createElement("input");
radioFolder.type = "radio";
radioFolder.name = "file-or-folder";
radioFolder.value = "folder";

// Créer les champs d'entrée
let inputFile = document.createElement("input");
inputFile.type = "file"
inputFile.id = "addfile";

let inputFolder = document.createElement("input");
inputFolder.id = "addfolder";

// Ajouter les éléments à la div
divContainer.appendChild(radioFile);
divContainer.appendChild(inputFile);
divContainer.appendChild(document.createElement("br"));
divContainer.appendChild(radioFolder);
divContainer.appendChild(inputFolder);

// Insérer la div dans le DOM
svgElement.parentNode.replaceChild(divContainer, svgElement);
})
</script>
</html>