<?php
include "Header Sicherheit.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" type="text/css" href="Startseite.css">
</head>
<section class="Header">
    <br><br>
    <h1>Willkommen bei </h1>
    <p> Pilo </p>
    <h1> Deine Social Media Plattform</h1>
    <br><br><br><br>
</section>
<body>
    <h1> Das ist unsere Startseite </h1>

    <div class="ich-suche"> <!-- Klasse ist ein gruppierendes Element ohne semantische Bedeutung 
Durch die Klasse kann ein einziges Element innerhalb des div mit CSS angesprochen werden -->
        <h2>Ich suche</h2>
        <a href="ich-suche.php">Weiterleitung ich-suche</a>
    </div>

    <div class="ich-biete">
        <h2>Ich biete</h2>
        <a href="ich-biete.php">Weiterleitung ich-biete</a>
    </div>

    <div class="community">
        <h2>Community</h2>
        <a href="community.php">Weiterleitung community</a>
    </div>

    <div class="aktivitaeten">
        <h2>Aktivitäten</h2>
        <a href="aktivitaeten.php">Weiterleitung aktivitaeten</a>
    </div>

</body>
</html>
