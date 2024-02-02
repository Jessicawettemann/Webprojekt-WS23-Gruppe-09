<?php
session_start();
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
?>

    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
        <title>Mein Profil</title>

    </head>
<?php
if(!isset($_SESSION["Nutzer_ID"])){
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Bitte melde dich zunächst an. <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');

}else{
    ?>
    <body>
    <h5>Mein Profil</h5>
    <ul>
        <li> <a href="Profil_do.php"> Meine Daten </a></li><br>

    </ul>
    <br>
    <?php
}
?>