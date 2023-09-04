let filmID; // Dodali smo globalnu promenljivu za filmID

// Učitavanje dostupnih filmova iz baze podataka
async function loadAvailableFilms() {
  try {
    const response = await fetch("api.php");

    if (!response.ok) {
      throw new Error("Unable to load available films.");
    }

    const films = await response.json();

    if (films && films.length > 0) {
      displayFilms(films);
    } else {
      console.log("Nema dostupnih filmova.");
    }
  } catch (error) {
    console.error(error);
  }
}

function displayFilms(films) {
  const filmsContainer = document.getElementById("films-container");

  films.forEach((film) => {
    const filmButton = document.createElement("button");
    filmButton.classList.add("film-button");
    filmButton.textContent = film.nazivFilma;

    // Dodajte atribut data-film-id za svako dugme sa ID filma
    filmButton.dataset.filmId = film.filmID;

    filmButton.addEventListener("click", () => {
      filmID = film.filmID;
      loadAvailableSeatsForFilm(filmID);
    });

    filmsContainer.appendChild(filmButton);
  });
}

// Pozovite funkciju za učitavanje filmova kada se stranica učita
loadAvailableFilms();

const modal = document.getElementById("myModal");
const closeModal = document.getElementById("closeModal");

// Funkcija za otvaranje moda
function openModal() {
  modal.style.display = "block";
}

// Funkcija za zatvaranje moda
function closeModalFunction() {
  modal.style.display = "none";
}

// Dodajte događaje za otvaranje modala
const filmsContainer = document.getElementById("films-container");

// Dodajte događaj za zatvaranje moda kada se klikne na dugme za zatvaranje
closeModal.addEventListener("click", closeModalFunction);

// Zatvorite modal ako korisnik klikne bilo gde izvan moda
window.addEventListener("click", function (event) {
  if (event.target == modal) {
    closeModalFunction();
  }
});

// Sakrijemo h3 za sedišta početno
const seatsHeading = document.querySelector(".seats-heading");
seatsHeading.style.display = "none";
