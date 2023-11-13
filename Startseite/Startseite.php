<?php
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
</head>

<body>
    <h1> Das ist unsere Startseite </h1>

    <div class="ich-suche"> <!-- Klasse ist ein gruppierendes Element ohne semantische Bedeutung 
Durch die Klasse kann ein einziges Element innerhalb des div mit CSS angesprochen werden -->
        <h2>Ich suche</h2>
        <a href="ich-suche">Weiterleitung ich-suche</a>
    </div>

    <div class="ich-biete">
        <h2>Ich biete</h2>
        <a href="redirect.php?category=2">Weiterleitung ich-biete</a>
    </div>

    <div class="community">
        <h2>Community</h2>
        <a href="redirect.php?category=3">Weiterleitung community</a>
    </div>

    <div class="aktivitaeten">
        <h2>Aktivitäten</h2>
        <a href="redirect.php?category=4">Weiterleitung aktivitaeten</a>
    </div>

</body>
</html>
