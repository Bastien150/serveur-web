let containers = document.querySelectorAll('.container');
let paginationContainer = document.querySelector('.pagination');

containers.forEach((container, index) => {
  let page = document.createElement('a');
  page.href = '';
  page.textContent = index + 1;
  if (index === 0) {
    page.classList.add('active');
  }
  paginationContainer.appendChild(page);
});


let squares = document.querySelectorAll('.square');
let paginationLinks = document.querySelectorAll('.pagination a');
let squaresPerPage = 6;

// Cacher tous les carrés sauf les 6 premiers
squares.forEach((square, index) => {
  if (index >= squaresPerPage) {
    square.style.display = 'none';
  }
});

// Ajouter un écouteur d'événement click à chaque lien de pagination
paginationLinks.forEach((link, index) => {
  link.addEventListener('click', (event) => {
    event.preventDefault();

    // Désactiver tous les liens de pagination
    paginationLinks.forEach(l => l.classList.remove('active'));
    // Activer le lien de pagination cliqué
    link.classList.add('active');

    // Cacher tous les carrés
    squares.forEach(square => square.style.display = 'none');

    // Afficher les carrés de la page sélectionnée
    let startIndex = index * squaresPerPage;
    let endIndex = startIndex + squaresPerPage;
    for (let i = startIndex; i < endIndex; i++) {
      if (squares[i]) {
        squares[i].style.display = 'block';
      }
    }
  });
});
