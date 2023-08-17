const seats = document.querySelectorAll(".seat");

seats.forEach((seat) => {
  seat.addEventListener("click", async () => {
    const filmID = 1; // ID filma koji se rezerviše
    const sedisteID = seat.dataset.sedisteId; // Pretpostavljam da imate neki atribut za ID sedišta
    try {
      const response = await reserveSeat(filmID, sedisteID);
      console.log(response);
      // Ažurirajte prikaz sedišta nakon rezervacije
      // Na primer, promenite boju sedišta na crvenu
      seat.classList.remove("available");
      seat.classList.add("reserved");
    } catch (error) {
      console.error(error);
    }
  });
});

const reservedSeats = document.querySelectorAll(".seat.reserved");

reservedSeats.forEach((seat) => {
  seat.addEventListener("click", async () => {
    const filmID = 1; // ID filma čija se rezervacija oslobađa
    const sedisteID = seat.dataset.sedisteId;
    try {
      const response = await releaseSeat(filmID, sedisteID);
      console.log(response);
      seat.classList.remove("reserved");
      seat.classList.add("available");
    } catch (error) {
      console.error(error);
    }
  });
});

// Ovo je primer funkcije za prikazivanje sedišta, treba prilagoditi vašoj strukturi
function showSeats(seats) {
  const seatContainer = document.getElementById("seat-container");

  seats.forEach((seat) => {
    const seatItem = document.createElement("div");
    seatItem.classList.add("seat");
    seatItem.textContent = seat.brojSedista;
    seatItem.dataset.sedisteId = seat.sedisteID;

    if (seat.statusSedista === 0) {
      seatItem.classList.add("available");
    } else if (seat.statusSedista === 1) {
      seatItem.classList.add("reserved");
    }

    seatContainer.appendChild(seatItem);
  });
}

// Poziv funkcije za prikazivanje sedišta
fetch("api.php", {
  method: "POST",
  body: JSON.stringify({ action: "getSeats" }), // Dodajte ovu akciju u PHP API
  headers: {
    "Content-Type": "application/json",
  },
})
  .then((response) => response.json())
  .then((data) => {
    showSeats(data);
  })
  .catch((error) => {
    console.error("Error getting seats:", error);
  });
