<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();

// Fehlerprotokollierung aktivieren
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="css_community.css">
    <title>Forum</title>
</head>
<body>

<div class="container">

    <h1>Community</h1>

    <!-- Formular zum Hinzufügen von Beiträgen -->
    <form id="communityForm" action="community_do.php" method="post" enctype="multipart/form-data" class="forum-form">
        <label for="beitrag"></label>
        <input type="text" placeholder="Beitrag" id="beitrag" name="beitrag" required>
        <button type="submit">Beitrag hinzufügen</button>
    </form>

    <!-- Formular zur Suche nach einem Nutzer -->
    <form action="community.php" method="post" class="forum-form">
        <label for="search_user">Nutzer suchen:</label>
        <input type="text" id="search_user" name="search_user" required>
        <button type="submit">Suchen</button>
    </form>

    <?php
    // Überprüfen, ob der Benutzer NICHT angemeldet ist
    if (!isset($_SESSION["Nutzer_ID"])) {
        echo("<div class='fail'> Bitte melde dich zunächst an! " . "<br><br>" . "<a href='Login Formular.php'>Hier geht's zum Login</a> </div>");
    } else {
        // Überprüfen, ob das Formular zur Nutzersuche abgeschickt wurde
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $searchUser = htmlspecialchars($_POST["search_user"]); // Daten aus dem Formular extrahieren

            // Überprüfen, ob der Nutzer existiert
            $searchStatement = $pdo->prepare("SELECT * FROM Nutzer WHERE benutzername = ? OR CONCAT(vorname, ' ', nachname) = ?");
            $searchStatement->execute([$searchUser, $searchUser]);

            if ($searchStatement->rowCount() > 0) {
                // Wenn der Nutzer gefunden wurde,  Informationen anzeigen
                $userRow = $searchStatement->fetch(PDO::FETCH_ASSOC);
                echo "<h2>Gefundener Nutzer:</h2>";
                echo "Benutzername: " . $userRow['benutzername'] . "<br>";
                echo "Vorname: " . $userRow['vorname'] . "<br>";
                echo "Nachname: " . $userRow['nachname'] . "<br>";

                // Überprüfen, ob der Benutzer bereits folgt
                $checkStatement = $pdo->prepare("SELECT * FROM Follower WHERE follower_username = ? AND followed_username = ?");
                $checkStatement->execute([$_SESSION["benutzername"], $userRow['benutzername']]);

                // Formular für das Folgen oder Entfolgen erstellen
                echo "<form action='follow.php' method='post'>";
                echo "<input type='hidden' name='followed_username' value='" . $userRow['benutzername'] . "'>";

                if ($checkStatement->rowCount() == 0) { //Wenn Anzahl der Zeilen = 0 wird noch nicht gefolgt
                    echo "<button type='submit'>Follow</button>";
                } else {
                    echo "<button type='submit' formaction='unfollow.php'>Unfollow</button>";
                }

                echo "</form>";
            } else {
                // Wenn der Nutzer nicht gefunden wurde, entsprechende Meldung
                echo "<p>Nutzer nicht gefunden.</p>";
            }
        }

        // Beiträge aus der Datenbank abrufen und anzeigen
        $statementBeitrag = $pdo->prepare("SELECT * FROM Beitrag INNER JOIN Nutzer ON Beitrag.benutzername = Nutzer.benutzername ORDER BY datum DESC");
        $statementBeitrag->execute();

        if ($statementBeitrag->rowCount() > 0) {
            // Wenn Beiträge vorhanden sind,  Container erstellen
            echo "<div class='forum-container'>";

            // Iterieren durch jeden Beitrag und anzeigen
            foreach ($statementBeitrag as $key => $row) {
                // Container für jeden Beitrag 
                echo "<div class='comment-container";
                echo "<div class='comment'>";

                // Profilbild des Benutzers anzeigen, falls vorhanden
                $statementProfilbild = $pdo->prepare("SELECT profilbild FROM Nutzer WHERE benutzername = ?");
                $statementProfilbild->execute([$row['benutzername']]);
                $profilbildRow = $statementProfilbild->fetch();

                if (!empty($profilbildRow['profilbild'])) {
                    // Wenn ein Profilbild vorhanden ist, anzeigen
                    echo "<div><img class='profilpicture' src='https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/" . $profilbildRow['profilbild'] . "'></div>";
                } else {
                    // Wenn kein Profilbild vorhanden ist, Hinweis anzeigen
                    echo "<div>Kein Profilbild</div>";
                }

                // Benutzername, Beitrag und Datum anzeigen
                echo "<p><strong>" . $row['vorname'] . " " . $row['nachname'] . "</strong></p>";
                echo "<p>" . $row['beitrag'] . "</p>";
                echo "<span>" . $row['datum'] . "</span>";

                // Formular für das Folgen oder Entfolgen erstellen
                echo "<form action='follow.php' method='post' class='follow-form'>"; //geht an follow.php
                echo "<input type='hidden' name='followed_username' value='" . $row['benutzername'] . "'>";

                //Überprüfung, ob schon gefolgt wird
                $checkStatement = $pdo->prepare("SELECT * FROM Follower WHERE follower_username = ? AND followed_username = ?");
                $checkStatement->execute([$_SESSION["benutzername"], $row['benutzername']]);

                if ($checkStatement->rowCount() == 0) {
                    echo "<button type='submit'>Follow</button>"; //keine Zeilenim Ergebnis des SQL-Statements: follow-Button
                } else {
                    echo "<button type='submit' formaction='unfollow.php'>Unfollow</button>";
                }

                echo "</form>";

                echo "</div>";
                echo "</div>";
            }

           
            echo "</div>"; //Container für Beiträge
        } else {
            
            echo "<p>Es gibt keine Beiträge.</p>"; // Wenn keine Beiträge vorhanden sind, zeige eine Meldung
        }
    }
    ?>

    ?>

</div>

<!-- Füge JavaScript am Ende der Datei hinzu, um die aktive Klasse zu steuern -->
<script>
    let currentIndex = 0;
    const commentContainers = document.querySelectorAll('.comment-container');

    function showPost(index) {
        commentContainers.forEach((container, i) => {
            container.classList.toggle('active', i === index);
        });
    }

    function showPreviousPost() {
        currentIndex = (currentIndex - 1 + commentContainers.length) % commentContainers.length;
        showPost(currentIndex);
    }

    function showNextPost() {
        currentIndex = (currentIndex + 1) % commentContainers.length;
        showPost(currentIndex);
    }

    // Zeige den ersten Beitrag an
    showPost(currentIndex);
</script>


</body>
</html>
