<?php
session_start();
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
?>

    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>Mein Profil</title>

    </head>
<?php

if (!isset($_SESSION["Nutzer_ID"])) {
    echo("<div class='fail'> Bitte melde dich zunächst an! " . "<br><br>" .;
} else{
?>
