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


   <title>Forum</title>
</head>
<body>

<?php

// Verarbeiten der Formulardaten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $beitrag = htmlspecialchars($_POST["beitrag"]);
    $datum = date("Y-m-d H:i:s");
    $nutzer = $_SESSION["id"];

    // Prüfen, ob alle erforderlichen Felder ausgefüllt sind
    if (empty($beitrag)) {
        echo "Bitte füllen Sie alle Felder aus.";
    } else {
        // Speichern des Beitrags in der Datenbank
        $statement = $pdo->prepare("INSERT INTO Beitrag (beitrag, datum, Nutzer) VALUES (?, ?, ?)");
        $statement->execute([$beitrag, $datum, $nutzer]);

        // Weiterleitung zur Übersichtsseite
        header("Location: community.php");
    }
}
?>

?>
</body>
</html>