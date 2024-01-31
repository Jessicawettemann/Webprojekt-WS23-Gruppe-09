<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Kalender</title>
    <link rel="stylesheet" type="text/css" href="css_kalender.css">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
</head>
<body>


<?php
if (!isset($_SESSION["Nutzer_ID"])){
    displayMessage("Bitte melde dich zunächst an! <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');
} else {
    if (isset($_POST["thema"]) && isset($_POST["beschreibung"]) && isset($_POST["datum"]) && isset($_POST["ort"])) {
        $thema = htmlspecialchars($_POST["thema"]);
        $beschreibung = htmlspecialchars($_POST["beschreibung"]);
        $datum = htmlspecialchars($_POST["datum"]);
        $ort = htmlspecialchars($_POST["ort"]);

        $currentDate = date('Y-m-d');
        if (strtotime($datum) >= strtotime($currentDate)) {
            $statement = $pdo->prepare("INSERT INTO Aktivitäten (thema, beschreibung, datum, ort) VALUES (?,?,?,?)");

            if ($statement->execute([$thema, $beschreibung, $datum, $ort])) {
                // Rufe die displayMessage-Funktion auf
                include 'fehlermeldung.php';
                displayMessage("Ereignis erfolgreich gespeichert! <br><a href='aktivitaeten.php'>Zu den Aktivitäten</a>", 'fine');
            } else {
                // Rufe die displayMessage-Funktion auf
                include 'fehlermeldung.php';
                displayMessage("Fehler beim Speichern des Ereignisses. <br><a href='aktivitaeten.php'>Erneut versuchen</a>", 'fail');
            }
        } else {
            // Rufe die displayMessage-Funktion auf
            include 'fehlermeldung.php';
            displayMessage("Das eingegebene Datum darf nicht in der Vergangenheit liegen. <br><a href='aktivitaeten.php'>Erneut versuchen</a>", 'fail');
        }
    }
}

?>
</body>
</html>
