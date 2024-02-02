<?php
include"Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="Logout.css">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
    <title>Logout Admin</title>



<body>


<br><br><br><br>
<div>
<br<br<br><br>
    <h2>Logout</h2>
    <br><br>
</div>

<?php
if (!isset($_SESSION["Admin_ID"])){ //Überprüfen, ob Admin angemeldet ist und Zugriff hat
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Du bist nicht angemeldet. <br><a href='Login_Admin.php'>Hier geht's zum Admin Login</a>", 'fail');
    
    die();
}
?>



<p>Möchtest du dich wirklich ausloggen?</p><br>
<div>
    <div class="logout">
    <form action="Logout_Admin_do.php" method="post">
        <button  class="logout_button" type="submit">Ja</button>
    </form>
    <form action="Startseite.php">
        <button  class="logout_button" type="submit">Nein</button>
    </form>
</div>

</body>
</html>