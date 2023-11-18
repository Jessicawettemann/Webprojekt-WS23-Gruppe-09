<?php

include"Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>


<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">

    <title>Login</title>
</head>
<body>

<?php
$statement = $pdo->prepare("SELECT * FROM Nutzer WHERE benutzername=?");
$statement->bindParam(":benutzername", $_POST["benutzername"]);
$p="hjfew3545r8c0szhwgfsdafghjgfdhj";
if($statement->execute(array(htmlspecialchars($_POST["benutzername"])))){

    if($row = $statement->fetch()){

        if(password_verify($_POST["passwort"].$p,$row["passwort"])){

            echo "<div class='big'>Herzlich Willkommen, ".$row["benutzername"]."<br>"."</div>";
            $_SESSION["benutzername"]=$row["benutzername"];
            $_SESSION["Nutzer_ID"]=$row["ID"];

            echo "<a href='../Startseite.php'> Herzliche Willkommen </a>"; //noch klären



        } else{

            echo("<div class='fail'>Passwort falsch</div>");
            echo $statement->errorInfo()[2];
        }
    }else{

        echo "<div class='fail'>Nutzer nicht vorhanden</div>";
        echo "<a href='../Registrierung%20Neu/Registrierung_Formular.php'> hier registrieren </a>";
    }
}else{
    die("<div class='fail'>Datenbank-Fehler</div>");

}
?>
<br>

</body>
</html>



