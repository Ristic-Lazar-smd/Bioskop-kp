document.addEventListener("DOMContentLoaded", () => {
  let filmID;
  let seatReserved = false;
  let selectedSeatID;
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

      filmButton.dataset.filmId = film.filmID;

      filmButton.addEventListener("click", async (event) => {
        filmID = event.target.dataset.filmId;
        await loadAvailableSeatsForFilm(filmID);
      });

      filmsContainer.appendChild(filmButton);
    });
  }

  loadAvailableFilms();

  function showModal() {
    const modal = document.getElementById("myModal");
    modal.style.display = "block";
  }

  function closeModal() {
    const modal = document.getElementById("myModal");
    modal.style.display = "none";
  }

  const seatsHeading = document.querySelector(".seats-heading");
  seatsHeading.style.display = "none";

  const buyButton = document.getElementById("buyButton");
  buyButton.addEventListener("click", () => {
    if (seatReserved) {
      closeModal();
    }
  });

  const closeModalButton = document.getElementById("closeModal");
  closeModalButton.addEventListener("click", () => {
    closeModal();
    if (selectedSeatID) {
      updateSeatColor(selectedSeatID, "green");
    }
    clearSeatTemporaryReserved(selectedSeatID);
  });

  async function loadAvailableSeatsForFilm(filmID) {
    try {
      const response = await fetch(`api_seats.php?filmID=${filmID}`);

      if (!response.ok) {
        throw new Error("Unable to load available seats.");
      }

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

            const reservedSeats = await getReservedSeatsForFilm(filmID);
            const isSeatReserved = reservedSeats.includes(seat.sedisteID);

            if (isSeatReserved) {
              seatDiv.classList.add("reserved");
            } else {
              seatDiv.classList.add("available");
              seatDiv.addEventListener("click", () => {
                const seatID = seat.sedisteID;
                selectSeat(seatID);
              });
            }

            seatsContainer.appendChild(seatDiv);
          });
        } else {
          console.log("Nema dostupnih sedišta.");
        }
        seatsHeading.style.display = "block";
      }
    } catch (error) {
      console.error(error);
    }
  }
  function updateSeatColor(seatID, color) {
    const seat = document.querySelector(`.seat[data-seat-id="${seatID}"]`);
    if (seat) {
      seat.style.backgroundColor = color;
    }
  }

  function selectSeat(seatID) {
    if (selectedSeatID === seatID) {
      selectedSeatID = undefined;
    } else {
      selectedSeatID = seatID;
    }
    if (!isSeatTemporaryReserved(seatID)) {
      setSeatTemporaryReserved(seatID);
      updateSeatColor(seatID, "orange");
      showModal();
    }
  }

  async function getReservedSeatsForFilm(filmID) {
    try {
      const response = await fetch(`api_reserved_seat.php?filmID=${filmID}`);

      if (!response.ok) {
        throw new Error("Unable to get reserved seats.");
      }

      const data = await response.json();
      return data.reservedSeats;
    } catch (error) {
      console.error(error);
      return [];
    }
  }

  async function purchaseTicket(filmID, seatID) {
    try {
      console.log("Kupovina za filmID:", filmID, "i sedisteID:", seatID);
      const response = await fetch(
        `api_purchase_ticket.php?filmID=${filmID}&sedisteID=${seatID}`
      );

      if (!response.ok) {
        throw new Error("Unable to purchase ticket.");
      }

      const data = await response.json();
      if (data.success) {
        clearSeatTemporaryReserved(seatID);
        updateSeatColor(seatID, "red");

        closeModal();
        console.log("Uspešno ste kupili kartu.");
      } else {
        console.log("Kupovina nije uspela.");
      }
    } catch (error) {
      console.error(error);
    }
  }

  const purchaseButton = document.getElementById("buyButton");
  purchaseButton.addEventListener("click", () => {
    if (selectedSeatID) {
      purchaseTicket(filmID, selectedSeatID);
    } else {
      console.error("SedisteID nije odabrano.");
    }
  });

  const temporaryReservedSeats = new Set();

  function isSeatTemporaryReserved(seatID) {
    return temporaryReservedSeats.has(seatID);
  }

  function setSeatTemporaryReserved(seatID) {
    temporaryReservedSeats.add(seatID);
  }

  function clearSeatTemporaryReserved(seatID) {
    temporaryReservedSeats.delete(seatID);
  }
});
