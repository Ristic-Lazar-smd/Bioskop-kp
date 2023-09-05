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
      // Postavite filmID ovde kako biste ga prosledili funkciji
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

async function loadAvailableSeatsForFilm() {
  try {
    const response = await fetch(`api_seats.php`);

    if (!response.ok) {
      throw new Error("Unable to load available seats.");
    }

    const contentType = response.headers.get("content-type");
    if (contentType && contentType.indexOf("application/json") !== -1) {
      const seatsData = await response.json();

      if (seatsData.error) {
        console.log(seatsData.error);
      } else {
        console.log(seatsData);

        const seatsContainer = document.getElementById("seat-grid");
        seatsContainer.innerHTML = "";

        if (Array.isArray(seatsData) && seatsData.length > 0) {
          seatsData.forEach(async (seat) => {
            const seatDiv = document.createElement("div");
            seatDiv.classList.add("seat");
            seatDiv.setAttribute("data-seat-id", seat.sedisteID);

            // Dodajte logiku za proveru rezervacija za sedište
            const isReserved = await isSeatReserved(seat.sedisteID);

            if (isReserved) {
              seatDiv.classList.add("reserved");
            } else {
              seatDiv.classList.add("available");
            }

            seatDiv.addEventListener("click", () => {
              const seatID = seat.sedisteID;
              reserveSeat(seatID); // Funkcija za rezervaciju sedišta
            });

            seatsContainer.appendChild(seatDiv);
          });
        } else {
          console.log("Nema dostupnih sedišta.");
        }

        const seatsHeading = document.querySelector(".seats-heading");
        seatsHeading.style.display = "block";
      }
    } else {
      console.error("Response is not valid JSON.");
    }
  } catch (error) {
    console.error(error);
  }
}

async function isSeatReserved(seatID) {
  try {
    const response = await fetch(
      `api_reserved_seat.php?filmID=${filmID}&sedisteID=${seatID}`
    );

    if (!response.ok) {
      throw new Error("Unable to check seat reservation.");
    }

    const contentType = response.headers.get("content-type");
    if (contentType && contentType.indexOf("application/json") !== -1) {
      const data = await response.json();
      return data.reserved;
    } else {
      console.error("Response is not valid JSON.");
      return false;
    }
  } catch (error) {
    console.error(error);
    return false;
  }
}
