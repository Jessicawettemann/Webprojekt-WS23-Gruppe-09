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
<header>
    <div class="header">


            <?php
            #wenn Nutzer angemeldet ist wird zum Logout verlinkt, anderenfalls zum Login
            if(isset($_SESSION["admin"])) {
                echo "<li class='li'><a href='Logout_Admin.php'>Logout</a></li";
            }else{
                echo "<li class='li'><a href='Login_Admin.php'>Login</a></li";
            }
            ?>
        </ul>
    </div>
</header>

<?php

$statement = $pdo->prepare("SELECT * FROM Admin WHERE admin=?");
$statement->bindParam(":admin", $_POST["admin"]);
if($statement->execute(array(htmlspecialchars($_POST["admin"])))) {

    if ($row = $statement->fetch()) {
        $st = $pdo->prepare("SELECT * FROM Admin WHERE Passwort=?");
        $st->bindParam(":Passwort", $_POST["Passwort"]);
        if ($st->execute(array(htmlspecialchars($_POST["Passwort"])))) {
            if ($r = $st->fetch()) {

                
                //displayMessage-Funktion
                include 'fehlermeldung.php';
                displayMessage("Herzlich Willkommen <br><a href='Startseite.php'>Startseite</a>", 'fine');
        

                $_SESSION["admin"] = $row["admin"];
                $_SESSION["Admin_ID"] = $row["ID"];
                //displayMessage-Funktion
                include 'fehlermeldung.php';
                displayMessage("Passwort falsch. <br><a href='ich-biete_Hinzufügen.php'>Ich biete</a>", 'fine');
               
                
                //displayMessage-Funktion
                include 'fehlermeldung.php';
                displayMessage("Passwort falsch. <br><a href='Startseite.php'>Startseite</a>", 'fine');
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
