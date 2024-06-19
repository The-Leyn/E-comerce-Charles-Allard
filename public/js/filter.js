// Sélectionnez le formulaire
const filterForm = document.getElementById("filterForm");

// Ajoutez un gestionnaire d'événements pour l'événement "change" des cases à cocher
filterForm.addEventListener("change", function (event) {
  event.preventDefault(); // Empêche le rechargement de la page

    console.log('Changement formulaire');

//   Récupérer les valeurs des cases cochées
  let filters = {};
  document.querySelectorAll('#filterForm input[type="checkbox"]').forEach((checkbox) => {
    filters[checkbox.id] = checkbox.checked;
  });
  console.log(filters);




  // Envoyez les données au serveur avec Fetch
  fetch("product?ajax=1", {
    method: "POST",
    headers: {
        "X-Requested-With" : "XMLHttpRequest",
    //   "Content-Type": "application/json",
    },
    body: JSON.stringify(filters),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erreur lors de la requête AJAX : " + response.status);
      }
      return response.json();
    })
    .then((data) => {
      // Traitez la réponse JSON ici
    //   console.log(data);
      document.querySelector('.container-product').innerHTML = data;
    })
    .catch((error) => {
      console.error(error);
    });
});
