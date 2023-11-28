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

// Formulardaten auslesen
$beitrag = $_POST['beitrag'];

// Formulardaten prüfen
if (empty($beitrag)) {
    // Wenn der Beitrag leer ist, Fehler auslösen
    http_response_code(400);
    echo "Der Beitrag darf nicht leer sein.";
    exit();
}

// Daten in die Datenbank einfügen
$stmt = $conn->prepare("INSERT INTO Beitrag (beitrag) VALUES (?)");
$stmt->bind_param("s", $beitrag);
$stmt->execute();

// Nach erfolgreicher Ausführung auf die Startseite weiterleiten
header("Location: community.php");
exit();

?>
