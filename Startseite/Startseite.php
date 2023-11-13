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
        <p>Willkommen in Kategorie 1. Hier findest du interessante Inhalte.</p>
        <a href="redirect.php?category=1">Zur Kategorie 1</a>
    </div>

    <div class="ich-biete">
        <h2>Ich biete</h2>
        <p>Entdecke spannende Informationen in Kategorie 2.</p>
        <a href="redirect.php?category=2">Zur Kategorie 2</a>
    </div>

    <div class="community">
        <h2>Community</h2>
        <p>Hier gibt es interessante Beiträge in Kategorie 3.</p>
        <a href="redirect.php?category=3">Zur Kategorie 3</a>
    </div>

    <div class="aktivitaeten">
        <h2>Aktivitäten</h2>
        <p>Tauche ein in Kategorie 4 und entdecke aufregende Themen.</p>
        <a href="redirect.php?category=4">Zur Kategorie 4</a>
    </div>

</body>
</html>
