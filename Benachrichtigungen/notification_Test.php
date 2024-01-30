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






<?php
// Einbinden der erforderlichen Dateien
include "Datenbank Verbindung.php"; // Achten Sie darauf, dass Leerzeichen in Dateinamen vermieden werden
include "Header Sicherheit.php";// Start der Session am Anfang des Skripts
session_start();

// Überprüfen, ob der Benutzername in der Session gesetzt ist
if (!isset($_SESSION["benutzername"])) {
    // Umleitung auf eine andere Seite oder Fehlerbehandlung
    exit("Benutzer nicht angemeldet.");
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" type="text/css" href="benachrichtigungen.css">
</head>
<body>
<?php

function getEmailFromDatabase($pdo, $Nutzer) {
    $statement = $pdo->prepare("SELECT email FROM Nutzer WHERE benutzername = :benutzername");
    $statement->execute(['benutzername' => $Nutzer]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['email'] : 'default@example.com';
}

// Benachrichtigungen abrufen
$notificationStatement = $pdo->prepare("SELECT * FROM Benachrichtigungen WHERE empfaenger_username = :benutzername AND email_gesendet = 0");
$notificationStatement->execute(['benutzername' => $_SESSION["benutzername"]]);

while ($notification = $notificationStatement->fetch(PDO::FETCH_ASSOC)) {
    // Escape von Output für HTML
    $nachricht = htmlspecialchars($notification['nachricht']);
    $absender = htmlspecialchars($notification['absender_username']);

    echo "<div class='notification'>"; 
    echo "<p>Benachrichtigung: " . $nachricht . "</p>";
    echo "<p>Von: " . $absender . "</p>";
    echo "</div>";

    // E-Mail-Parameter
    $absenderEmail = getEmailFromDatabase($pdo, $notification['absender_username']);
    $empfaengerEmail = getEmailFromDatabase($pdo, $notification['empfaenger_username']);
    $betreff = 'Neue Benachrichtigung';
    
    // Der Header wird mit der Absender-E-Mail-Adresse erstellt
    $header = 'From: ' . $absenderEmail;

    // E-Mail senden
    if(mail($empfaengerEmail, $betreff, $nachricht, $header)){
        echo 'Message has been sent';

        // Markiere die Benachrichtigung als gesendet, um Doppelversand zu verhindern
        $updateNotificationStatement = $pdo->prepare("UPDATE Benachrichtigungen SET email_gesendet = 1 WHERE ID = :id");
        $updateNotificationStatement->execute(['id' => $notification['ID']]);
    } else {
        echo 'Message could not be sent';
    }
}
?>
</body>
</html>