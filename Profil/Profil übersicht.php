<?php
session_start();
include "Datenbank Verbindung.php";
;
?>

    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>Mein Profil</title>

    </head>
<?php
if(!isset($_SESSION["Nutzer_ID"])){
    echo("<div class='fail'> Bitte melde dich zunächst an! "."<br><br>". "<a href='Login Formular'>Hier geht's zum Login</a> </div>");
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