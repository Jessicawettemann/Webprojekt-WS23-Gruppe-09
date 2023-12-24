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

$beitrag = $_POST['beitrag'];
$Nutzer = $_SESSION['benutzername'];
$stmt = $pdo->prepare('INSERT INTO Beitrag (beitrag, Nutzer) VALUES (?, ?)');
$stmt->execute([$beitrag, $Nutzer]);

header('Location: community.php');

exit();
?>