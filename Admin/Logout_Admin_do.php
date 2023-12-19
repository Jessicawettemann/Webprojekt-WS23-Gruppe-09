<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">

    <title>Logout</title>

</head>
<div>

    <h2>Logout</h2>
</div>
</body>

<?php
if (!isset($_SESSION["Admin_ID"])) {
    die("<div class='fail'> Du bist nicht angemeldet! " . "<br><br>" . "<a href='Login_Admin.php'>Hier geht's zum Login</a> </div>");
}
session_destroy();
echo "<div class='fine'> Logout war erfolgreich " . "<br><br>" . "<a href='Startseite.php'>zurück zur Startseite</a> </div>";
?>
</html>