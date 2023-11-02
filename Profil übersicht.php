<?php
session_start();
include"../Datenbank Verbindung.php";
# hier muss der Header noch hin für die Sicherherit
?>

    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>Mein Profil</title>

    </head>
<?php

if (!isset($_SESSION["User_ID"])) {
    echo("<div class='fail'> Bitte melde dich zunächst an! " . "<br><br>" .# hier muss die verlunkung zu Login hin "<a href='../Login/login.php'>Hier geht's zum Login</a> </div>");
} else{
?>
