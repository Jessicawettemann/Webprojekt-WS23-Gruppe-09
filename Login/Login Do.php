<?php

include"Datenbank Verbindung.php";

session_start();
?>


<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">

    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
</head>
</head>
<body>

<?php
$statement = $pdo->prepare("SELECT * FROM Nutzer WHERE benutzername=?");
$statement->bindParam(":benutzername", $_POST["benutzername"]);
$p="hjfew3545r8c0szhwgfsdafghjgfdhj";
if($statement->execute(array(htmlspecialchars($_POST["benutzername"])))){ #htmlspecialcharts=

    if($row = $statement->fetch()){

        if(password_verify($_POST["passwort"].$p,$row["passwort"])){

            echo "<div class='big'>Herzlich Willkommen, ".$row["benutzername"]."<br>"."</div>";
            $_SESSION["benutzername"]=$row["benutzername"];
            $_SESSION["Nutzer_ID"]=$row["ID"];

            header("Location: Startseite.php");
            exit();



        } else{
             // Rufe die displayMessage-Funktion auf
             include 'fehlermeldung.php';
             displayMessage("Passwort falsch. <br><a href='Login Formular.php'>Erneut versuchen</a>", 'fail');
            echo $statement->errorInfo()[2];
        }
    }else{

        include 'fehlermeldung.php';
        displayMessage("Nutzer nicht vorhanden. <br><a href='Registrierung_Formular.php'>Hier registrieren</a>", 'fail');
    }
}else{
    include 'fehlermeldung.php';
    displayMessage("Datenbank-Fehler. <br><a href='Login Formular.php'>Erneut versuchen</a>", 'fail');

}
?>
<br>

</body>
</html>



