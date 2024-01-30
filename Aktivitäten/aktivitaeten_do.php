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
</head>
<body>

<?php
if (!isset($_SESSION["Nutzer_ID"])){
    echo "<div class='fail'>Bitte melde dich zunächst an! <br><a href='Login Formular.php'>Hier geht's zum Login</a></div>";
} else {
    if (isset($_POST["thema"], $_POST["beschreibung"], $_POST["datum"], $_POST["ort"])) {
        $thema = htmlspecialchars($_POST["thema"]);
        $beschreibung = htmlspecialchars($_POST["beschreibung"]);
        $datum = htmlspecialchars($_POST["datum"]);
        $ort = htmlspecialchars($_POST["ort"]);

        $currentDate = date('Y-m-d');
        if (strtotime($datum) >= strtotime($currentDate)) {
            $statement = $pdo->prepare("INSERT INTO Aktivitäten (thema, beschreibung, datum, ort) VALUES (?,?,?,?)");

            if ($statement->execute([$thema, $beschreibung, $datum, $ort])) {
                echo "<div class='fine'>Ereignis erfolgreich gespeichert! <br><a href='aktivitaeten.php'>Zu den Aktivitäten</a></div>";
            } else {
                echo "<div class='fail'>Fehler beim Speichern des Ereignisses. <br><a href='aktivitaeten.php'>Erneut versuchen</a></div>";
            }
        } else {
            echo "<div class='fail'>Das eingegebene Datum darf nicht in der Vergangenheit liegen. <br><a href='aktivitaeten.php'>Erneut versuchen</a></div>";
        }
    }
}
?>
</body>
</html>
