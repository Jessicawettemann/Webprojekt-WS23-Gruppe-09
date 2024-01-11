<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
?>

<!-- ... -->
<div class="notification-container">

    <h1>Benachrichtigungen</h1>
    <br><br>

    <?php
    // Benachrichtigungen anzeigen
    $notificationQuery = "
        SELECT Benachrichtigungen.*, Beitrag.datum AS beitrag_datum
        FROM Benachrichtigungen
        JOIN Beitrag ON Benachrichtigungen.beitrags_id = Beitrag.ID
        WHERE Benachrichtigungen.empfaenger_username = ?
    ";

    $notificationStatement = $pdo->prepare($notificationQuery);
    $notificationStatement->execute([$_SESSION["benutzername"]]);

    while ($notification = $notificationStatement->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='notification'>"; // Änderung hier, um die Klasse hinzuzufügen
        echo "<p>Datum des Beitrags: " . $notification['beitrag_datum'] . "</p>"; // Hier das Datum des Beitrags hinzufügen
        echo "<p>Benachrichtigung: " . $notification['nachricht'] . "</p>";
        echo "<p>Von: " . $notification['absender_username'] . "</p>";

        // Hier das Datum der Benachrichtigung hinzufügen (falls vorhanden)
        echo "<p>Datum der Benachrichtigung: " . $notification['datum'] . "</p>";

        echo "</div>";

        // E-Mail senden
        mail($empfaenger, $betreff, $notification['nachricht'], $header);
    }
    ?>
</div>
<!-- ... -->
