<?php
//Verbingsinformationen
$hostname = "mars.iuk.hdm-stuttgart.de"; // Hostname Datenbank
$username = "jw170"; // Datenbank-Benutzername
$password = "Air8aing3r"; // Datenbank-Passwort
$dbname = "u-jw170"; // Name  Datenbank

try {
    // Erstelle eine PDO-Verbindung zur Datenbank
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

    echo "Verbindung zur Datenbank erfolgreich hergestellt!";
} catch (PDOException $e) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $e->getMessage());
}
?>


