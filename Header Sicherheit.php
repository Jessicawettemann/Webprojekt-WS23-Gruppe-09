<?php
include "Datenbank Verbindung.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Zur Playlist hinzufügen</title>

</head>
<body>
<header>
    <div class="header">
        <ul class="ul">
            <li class="li"><a href="Profil übersicht.php">Mein Profil</a></li>


            <?php
            #wenn Nutzer angemeldet ist wird zum Logout verlinkt, anderenfalls zum Login
            if(isset($_SESSION["benutzername"])) {
                echo "<li class='li'><a href='Logout.php'>Logout</a></li";
            }else{
                echo "<li class='li'><a href='Login Formular.php'>Login</a></li";
            }
            ?>

            <div>
                <?php
                #ist Nutzer angemeldet wird das Profilbild angezeigt, wenn nicht dann der Platzhalter
                if (!isset($_SESSION["Nutzer_ID"])) {
                    echo "<div>nicht angemeldet</div>";
                }else{

                    $statement = $pdo -> prepare ("SELECT profilbild FROM Nutzer WHERE ID= :Nutzer_ID ");
                    $statement -> bindParam(":Nutzer_ID", $_SESSION["Nutzer_ID"]);
                    if($statement -> execute()) {
                        if ($row = $statement->fetch()) {
                            if (($row["profilbild"]) == null or "") {
                                echo "<div>kein Profilbild</div>";
                            } else {
                                echo "<div><img class='profilpicture' src='https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/" . $row['profilbild'] ."'></div>";
                            }
                        }
                    }
                }
                ?>
            </div>
        </ul>
    </div>
</header>
</body>