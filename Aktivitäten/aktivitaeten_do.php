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
// Überprüfung, ob Benutzer angemeldet ist
if (!isset($_SESSION["Nutzer_ID"])){
    //displayMessage-Funktion für die Fehlermeldung
    include 'fehlermeldung.php';
    displayMessage("Bitte melde dich zunächst an! <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');
} else {
    // Überprüfung, ob alle erforderlichen Felder im Formular gesetzt sind
    if (isset($_POST["thema"]) && isset($_POST["beschreibung"]) && isset($_POST["datum"]) && isset($_POST["ort"])) {
        // Daten aus dem Formular verarbeiten
        $thema = htmlspecialchars($_POST["thema"]);
        $beschreibung = htmlspecialchars($_POST["beschreibung"]);
        $datum = htmlspecialchars($_POST["datum"]);
        $ort = htmlspecialchars($_POST["ort"]);

        // Aktuelles Datum erhalten
        $currentDate = date('Y-m-d');
        
        // Überprüfung, ob eingegebene Datum in der Zukunft liegt
        if (strtotime($datum) >= strtotime($currentDate)) {
            // Vorbereiten des SQL-Statements zum Einfügen in die Datenbank
            $statement = $pdo->prepare("INSERT INTO Aktivitäten (thema, beschreibung, datum, ort) VALUES (?,?,?,?)");

            // Ausführen des SQL-Statements mit den eingegebenen Daten
            if ($statement->execute([$thema, $beschreibung, $datum, $ort])) {
                //displayMessage-Funktion für Erfolgsmeldung
                include 'fehlermeldung.php';
                displayMessage("Ereignis erfolgreich gespeichert! <br><a href='aktivitaeten.php'>Zu den Aktivitäten</a>", 'fine');
            } else {
                //displayMessage-Funktion für Fehlermeldung beim Speichern
                include 'fehlermeldung.php';
                displayMessage("Fehler beim Speichern des Ereignisses. <br><a href='aktivitaeten.php'>Erneut versuchen</a>", 'fail');
            }
        } else {
            //displayMessage-Funktion
            include 'fehlermeldung.php';
            displayMessage("Das eingegebene Datum darf nicht in der Vergangenheit liegen. <br><a href='aktivitaeten.php'>Erneut versuchen</a>", 'fail');
        }
    }
}

?>
</body>
</html>
