<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start()
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

<h1>Community</h1>

<!-- Formular zum Hinzufügen von Beiträgen -->
<form action="community_do.php" method="post" placeholder="Gib hier deinen Beitrag ein..." enctype="multipart/form-data">
    <h1>Forum</h1>
    <br><br>
    <label for="beitrag"></label>
    <input type="text" placeholder="Beitrag" id="beitrag" name="beitrag" required>
    <button type="submit">Beitrag hinzufügen</button>
    <br>
    <br>
    <br><br><br><br>
</form>

<!-- Formular zur Suche nach einem Nutzer -->
<form action="community.php" method="post">
    <label for="search_user">Nutzer suchen:</label>
    <input type="text" id="search_user" name="search_user" required>
    <button type="submit">Suchen</button>
</form>


<br> <br> 

<?php

if (!isset($_SESSION["Nutzer_ID"])){
    echo("<div class='fail'> Bitte melde dich zunächst an! " . "<br><br>" . "<a href='Login Formular.php'>Hier geht's zum Login</a> </div>");
}else {

// Überprüfen, ob das Formular zur Nutzersuche abgeschickt wurde
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Annahme: $_POST["search_user"] enthält den eingegebenen Nutzernamen oder Vorname + Nachname
        $searchUser = htmlspecialchars($_POST["search_user"]);

        // Überprüfen, ob der Nutzer existiert
        $searchStatement = $pdo->prepare("SELECT * FROM Nutzer WHERE benutzername = ? OR CONCAT(vorname, ' ', nachname) = ?");
        $searchStatement->execute([$searchUser, $searchUser]);

        if ($searchStatement->rowCount() > 0) {
            // Nutzer gefunden, zeige Informationen oder Follow-Button an
            $userRow = $searchStatement->fetch(PDO::FETCH_ASSOC);

            // Hier können Sie Informationen über den gefundenen Nutzer anzeigen
            echo "<h2>Gefundener Nutzer:</h2>";
            echo "Benutzername: " . $userRow['benutzername'] . "<br>";
            echo "Vorname: " . $userRow['vorname'] . "<br>";
            echo "Nachname: " . $userRow['nachname'] . "<br>";

            // Überprüfen, ob der Benutzer bereits folgt
            $checkStatement = $pdo->prepare("SELECT * FROM Follower WHERE follower_username = ? AND followed_username = ?");
            $checkStatement->execute([$_SESSION["benutzername"], $userRow['benutzername']]);

            echo "<form action='follow.php' method='post'>";
            echo "<input type='hidden' name='followed_username' value='" . $userRow['benutzername'] . "'>";

            if ($checkStatement->rowCount() == 0) {
                // Der Benutzer folgt noch nicht, zeige den Follow-Button
                echo "<button type='submit'>Follow</button>";
            } else {
                // Der Benutzer folgt bereits, zeige den Unfollow-Button
                echo "<button type='submit' formaction='unfollow.php'>Unfollow</button>";
            }

            echo "</form>";
        } else {
            // Nutzer nicht gefunden
            echo "<p>Nutzer nicht gefunden.</p>";
        }
    }
}
?>


<br><br><br>

<!-- Beiträge in einer Tabelle anzeigen -->
<?php
$statement = $pdo->prepare("SELECT * FROM Beitrag INNER JOIN Nutzer ON Beitrag.benutzername = Nutzer.benutzername");
$statement->execute();

echo "<table border='1'>";
echo "<tr>";
echo "<th>Beitrag</th>";
echo "<th>Datum</th>";
echo "<th>Nutzer</th>";
echo "<th>Profilbild</th>";
echo "<th>Folgen</th>"; // Folgen-Spalte hinzugefügt
echo "</tr>";

foreach ($statement as $row) {
    echo "<tr>";
    echo "<td>" . $row['beitrag'] . "</td>";
    echo "<td>" . $row['datum'] . "</td>";
    echo "<td>" . $row['vorname'] . " " . $row['nachname'] . "</td>";
    echo "<td>" . $row['profilbild'] . "</td>";
    
    // Hier fügen Sie den Follow-Button hinzu
    echo "<td>";
    // Überprüfen, ob der Benutzer bereits folgt
    $checkStatement = $pdo->prepare("SELECT * FROM Follower WHERE follower_username = ? AND followed_username = ?");
    $checkStatement->execute([$_SESSION["benutzername"], $row['benutzername']]);

    echo "<form action='follow.php' method='post'>";
    echo "<input type='hidden' name='followed_username' value='" . $row['benutzername'] . "'>";

    if ($checkStatement->rowCount() == 0) {
        // Der Benutzer folgt noch nicht, zeige den Follow-Button
        echo "<button type='submit'>Follow</button>";
    } else {
        // Der Benutzer folgt bereits, zeige den Unfollow-Button
        echo "<button type='submit' formaction='unfollow.php'>Unfollow</button>";
    }

    echo "</form>";
    echo "</td>";

    echo "</tr>";
}

echo "</table>";
?>

</body>
</html>
