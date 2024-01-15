<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/fb106/public_html/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

// Benachrichtigungen abrufen
$notificationStatement = $pdo->prepare("SELECT * FROM Benachrichtigungen WHERE empfaenger_username = ?");
$notificationStatement->execute([$_SESSION["benutzername"]]);

// E-Mail-Parameter
$empfaenger = $_SESSION["email"];
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
    // Benachrichtigungen anzeigen
    //while ($notification = $notificationStatement->fetch(PDO::FETCH_ASSOC)) {
    //    echo "<div class='notification'>"; // Änderung hier, um die Klasse hinzuzufügen
    //    echo "<p>Benachrichtigung: " . $notification['nachricht'] . "</p>";
    //    echo "<p>Von: " . $notification['absender_username'] . "</p>";
    //    echo "</div>";

        // E-Mail senden
    //    mail($empfaenger, $betreff, $notification['nachricht'], $header);
    //}
    // PHPMailer einsetzen
        $mail = new PHPMailer(true);

        try {
            // Server-Einstellungen
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.example.com'; // Setzen Sie Ihren SMTP-Host hier
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your@email.com'; // Setzen Sie Ihre E-Mail-Adresse hier
            $mail->Password   = 'your-password'; // Setzen Sie Ihr Passwort hier
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // E-Mail-Inhalte
            $mail->setFrom($absenderEmail, 'Your Name');
            $mail->addAddress($empfaenger);
            $mail->isHTML(true);
            $mail->Subject = $betreff;
            $mail->Body    = $notification['nachricht'];
            $mail->AltBody = $notification['nachricht'];

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    ?>

</div>

</body>
</html>
