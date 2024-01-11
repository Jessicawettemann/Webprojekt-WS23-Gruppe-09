<!-- ... -->
<div class="notification-container">

    <h1>Benachrichtigungen</h1>
    <br><br>

    <?php
    // Benachrichtigungen anzeigen
    $notificationQuery = "
        SELECT Benachrichtigungen.*, Beitrag.datum
        FROM Benachrichtigungen
        JOIN Beitrag ON Benachrichtigungen.beitrags_id = Beitrag.id
        WHERE Benachrichtigungen.empfaenger_username = ?
    ";

    $notificationStatement = $pdo->prepare($notificationQuery);
    $notificationStatement->execute([$_SESSION["benutzername"]]);

    while ($notification = $notificationStatement->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='notification'>"; // Änderung hier, um die Klasse hinzuzufügen
        echo "<p>Benachrichtigung: " . $notification['nachricht'] . "</p>";
        echo "<p>Von: " . $notification['absender_username'] . "</p>";

        // Hier das Datum hinzufügen
        echo "<p>Datum: " . $notification['datum'] . "</p>";

        echo "</div>";

        // E-Mail senden
        mail($empfaenger, $betreff, $notification['nachricht'], $header);
    }
    ?>
</div>
<!-- ... -->
