
<?php
include "fehlermeldung.css";

// fehlermeldung.php
function displayMessage($message, $messageType) {
    echo "<div class='message-box $messageType-message' id='messageBox'>";
    echo "<p>$message</p>";
    echo "</div>";
}
?>
