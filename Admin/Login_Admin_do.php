<?php
include"Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">

</head>
<body>


<?php

$statement = $pdo->prepare("SELECT * FROM Admin WHERE admin=?");
$statement->bindParam(":admin", $_POST["admin"]);
if($statement->execute(array(htmlspecialchars($_POST["admin"])))) {

    if ($row = $statement->fetch()) {
        $st = $pdo->prepare("SELECT * FROM Admin WHERE Passwort=?");
        $st->bindParam(":Passwort", $_POST["Passwort"]);
        if ($st->execute(array(htmlspecialchars($_POST["Passwort"])))) {
            if ($r = $st->fetch()) {

                echo "<div class='fine'>Herzlich Willkommen, " . $row["admin"]."</div>";
                $_SESSION["admin"] = $row["admin"];
                $_SESSION["Admin_ID"] = $row["ID"];
                echo "<a class='go' href= 'ich-biete_Hinzufügen.php'> ich biete </a> <br> ";

                echo "<a class='go' href='Startseite.php'> Startseite</a> <br>";
            } else {

                //displayMessage-Funktion
                 include 'fehlermeldung.php';
                 displayMessage("Passwort falsch. <br><a href='Login_Admin.php'>Erneut versuchen</a>", 'fail');

            }
        } else {

            //displayMessage-Funktion
            include 'fehlermeldung.php';
            displayMessage("Nutzer nicht vorhanden. <br><a href='Login_Admin.php'>Erneut versuchen</a>", 'fail');

        }
    } else {

        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Passwort falsch. <br><a href='Login_Admin.php'>Erneut versuchen</a>", 'fail');

    }
}

?>



</body>
</html>
