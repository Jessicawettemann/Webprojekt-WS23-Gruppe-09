<?php
include "Datenbank Verbindung.php";

$benutzername = $_GET['benutzername'];
$statementProfilbild = $pdo->prepare("SELECT profilbild FROM Nutzer WHERE benutzername = ?");
$statementProfilbild->execute([$benutzername]);
$rowProfilbild = $statementProfilbild->fetch();

if ($rowProfilbild && isset($rowProfilbild['profilbild'])) {
    header("Content-type: image/jpeg");
    echo $rowProfilbild['profilbild'];
} else {
    // Hier kannst du ein Standardbild ausgeben, wenn kein Profilbild gefunden wurde
    header("Content-type: image/jpeg");
    // echo file_get_contents("Pfad/Zum/Standardbild.jpg");
}
?>
