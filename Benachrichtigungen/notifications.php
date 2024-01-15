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

    $statement = $pdo->prepare("SELECT email FROM Nutzer WHERE benutzername = ?");
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

//    use PHPMailer\PHPMailer\PHPMailer;
//    use PHPMailer\PHPMailer\Exception;
    
//    require '/home/fb106/public_html/Exception.php';
//    require '/home/fb106/public_html/PHPMailer.php';
//    require '/home/fb106/public_html/SMTP.php';

    // Benachrichtigungen anzeigen
    while ($notification = $notificationStatement->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='notification'>"; // Änderung hier, um die Klasse hinzuzufügen
        echo "<p>Benachrichtigung: " . $notification['nachricht'] . "</p>";
        echo "<p>Von: " . $notification['absender_username'] . "</p>";
        echo "</div>";
    
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
            $absenderEmail = getEmailFromDatabase($notification['absender_username']);
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
    }    
    ?>

</div>

</body>
</html>
