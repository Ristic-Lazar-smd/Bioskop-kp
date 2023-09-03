const seats = document.querySelectorAll(".seat");

seats.forEach((seat) => {
  seat.addEventListener("click", async () => {
    const filmID = 1;
    const sedisteID = seat.dataset.sedisteId;

    try {
      const response = await reserveSeat(filmID, sedisteID);
      console.log(response);

      if (seat.dataset.statusSedista === "0") {
        seat.classList.remove("available");
        seat.classList.add("reserved");
      }
    } catch (error) {
      console.error(error);
    }
  });
});

const reservedSeats = document.querySelectorAll(".seat.reserved");

reservedSeats.forEach((seat) => {
  seat.addEventListener("click", async () => {
    const filmID = 1;
    const sedisteID = seat.dataset.sedisteId;

    try {
      const response = await releaseSeat(filmID, sedisteID);
      console.log(response);

      if (seat.dataset.statusSedista === "1") {
        seat.classList.remove("reserved");
        seat.classList.add("available");
      }
    } catch (error) {
      console.error(error);
    }
  });
});

function showSeats(seats) {
  const seatContainer = document.getElementById("seat-container");

  seats.forEach((seat) => {
    const seatItem = document.createElement("div");
    seatItem.classList.add("seat");
    seatItem.textContent = seat.brojSedista;
    seatItem.dataset.sedisteId = seat.sedisteID;
    seatItem.dataset.statusSedista = seat.statusSedista;

    if (seat.statusSedista === "0") {
      seatItem.classList.add("available");
    } else if (seat.statusSedista === "1") {
      seatItem.classList.add("reserved");
    }

    seatContainer.appendChild(seatItem);
  });
}

fetch("api.php", {
  method: "POST",
  body: JSON.stringify({ action: "getSeats" }),
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
