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
<body>
<section class="Header">
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Willkommen  </h1>
    <p> bei Landify </p><br><br><br>
    <button type="button">Finde mehr heraus</button>

</section>
<body>
<div class="row"> </div>

    <div class="picture"> <!-- Klasse ist ein gruppierendes Element ohne semantische Bedeutung
Durch die Klasse kann ein einziges Element innerhalb des div mit CSS angesprochen werden -->
        <img src="https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/Suche.png"  >
        <div class="Layer">
            <p style= text-align:center </p>
        <a href="ich-suche.php"> <h3>Ich suche</h3></a>
    </div>
</div>

    <div class="picture">
        <img src="https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/Biete.png" alt=" placeholder" >
        <div class="Layer">
        <a href="ich-biete_Übersicht.php"> <h3>Ich biete</h3></a>
    </div>
</div>
    <div class="picture">
        <img src="https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/Community.png" alt=" placeholder" >
        <div class="Layer">
        <a href="community.php"> <h3>Community</h3></a>
    </div>
    </div>
    <div class="picture">
        <img src="https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/Aktivitäten.png" alt=" placeholder" >
       <div class="Layer">
        <a href="aktivitaeten.php"> <h3>aktivitaeten</h3> </a>
    </div>
    </div>
</div>


</body>
</html>
