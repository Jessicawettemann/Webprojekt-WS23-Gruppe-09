<?php
include"Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">

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

                echo "<div class='fine'>Herzlich Willkommen, " . $row["admin"]."</div>";
                $_SESSION["admin"] = $row["admin"];
                $_SESSION["Admin_ID"] = $row["ID"];
                echo "<a class='go' href= 'ich-biete_Hinzufügen.php'> ich biete </a> <br> ";

                echo "<a class='go' href='ich-biete_Übersicht.php'> Übersicht </a> <br>";
            } else {

                echo("<div class='fail'>Passwort falsch</div>");
                echo $st->errorInfo()[2];
            }
        } else {

            echo "<div class='fail'>Nutzer nicht vorhanden</div>";
        }
    } else {
        echo "<div class='fail'>Passwort falsch!</div>";
    }
}

?>



</body>
</html>
