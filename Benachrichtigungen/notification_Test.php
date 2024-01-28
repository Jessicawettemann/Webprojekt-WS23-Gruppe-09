<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/fb106/public_html/Exception.php';
require '/home/fb106/public_html/PHPMailer.php';
require '/home/fb106/public_html/SMTP.php';

function getEmailFromDatabase($Nutzer) {
    global $pdo;

    $statement = $pdo->prepare("SELECT email FROM Nutzer WHERE benutzername =?");
    $statement->execute([$Nutzer]);

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['email'];
    } else {
        return 'default@example.com';
    }
}

// Benachrichtigungen abrufen
$notificationStatement = $pdo->prepare("SELECT * FROM Benachrichtigungen WHERE empfaenger_username = ?");
$notificationStatement->execute([$_SESSION["benutzername"]]);

// E-Mail-Parameter
$benutzername = $_SESSION["benutzername"]; 
$statementEmpfaenger = $pdo->prepare("SELECT email FROM Nutzer WHERE benutzername =?");
$statementEmpfaenger->execute([$benutzername]); 
$result = $statementEmpfaenger-> fetch(PDO::FETCH_ASSOC);
$betreff = 'Neue Benachrichtigung';




// Der Header wird mit der neuen Absender-E-Mail-Adresse erstellt
$header = 'From: ' . $absenderEmail;

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="benachrichtigungen.css">
    <title>Benachrichtigungen</title>
</head>
<body>

<div class="notification-container">

    <h1>Benachrichtigungen</h1>
    <br><br>

    <?php

while ($notification = $notificationStatement->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='notification'>"; 
    echo "<p>Benachrichtigung: " . $notification['nachricht'] . "</p>";
    echo "<p>Von: " . $notification['absender_username'] . "</p>";
    echo "</div>";

    // PHPMailer einsetzen
    $mail = new PHPMailer(true);

    try {
        // Server-Einstellungen
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.hdm-stuttgart.de';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'fb106@hdm-stuttgart.de';
        $mail->Password   = 'Fabio1998!';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 25;

        // E-Mail-Inhalte
        $absenderEmail = getEmailFromDatabase($notification['absender_username']);
        $empfaengerEmail = getEmailFromDatabase($notification['empfaenger_username']);
        $mail->setFrom($absenderEmail, 'Landify');
        $mail->addAddress($empfaengerEmail);
        $mail->isHTML(true);
        $mail->Subject = 'Neue Benachrichtigung';
        $mail->Body    = "<p>Benachrichtigung: " . $notification['nachricht'] . "</p>";
        $mail->AltBody = $notification['nachricht'];

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}