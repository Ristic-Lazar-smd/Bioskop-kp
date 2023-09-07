<?php

include 'dbBroker.php';
include 'model/rezervacija.php';
include 'model/sediste.php';

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Rezervisanje karata</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="home.php" class="cinemax-logo">CineMAX</a></li>
            <li><a href="rezervisanje.php">Rezervacija</a></li>
            <li><a href="lokacija.php">Lokacija</a></li>
        </ul>
    </nav>
</header>
<section class="films-section">
    <h2>Filmovi koji se trenutno prikazuju:</h2>
    <div id="films-container"></div>
    <div id="buttons-container"> 
        <h3 class="seats-heading" style="display: none;">Sedišta za izabrani film:</h3>
        <div class="seat-grid" id="seat-grid"></div>
    </div>
</section>




<div id="myModal" class="modal">
  <div class="modal-content">
    <span id="closeModal" class="closeModal">&times;</span>
    <h2>Sedište</h2>
    <ul>
      <li>Cena: $10</li>
      <li>Metode plaćanja: Kartica, PayPal</li>
    </ul>
    <button id="buyButton" class="buyButton">Kupi</button>
  </div>
</div>


<footer>
    <div class="footer-content">
        <div class="location">
            <h3>Lokacije</h3>
            <p>Možete nas naći <a href="lokacija.php">ovde</a></p>
        </div>
        <div class="contact-info">
            <h3>Kontakt Informacije</h3>
            <p>Email: cimemax@bioskop.rs</p>
            <p>Telefon: +634444444</p>
            <p>Instagram: @cinemaxbioskop</p>
            <p>Twitter: twitter/Cinemax</p>
        </div>
    </div>
</footer>

<script src="index.js"></script>
</body>
</html>
