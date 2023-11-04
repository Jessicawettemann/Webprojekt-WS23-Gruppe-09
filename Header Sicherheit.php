<?php
include "Datenbank Verbindung.php";
session_start();
?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">

    </head>
    <body>
    <header>
        <div class="header">



<?php
#wenn Nutzer angemeldet ist wird zum Logout verlinkt, anderenfalls zum Login
if(isset($_SESSION["Benutzername"])) {
    echo "<li class='li'><a href='../Login/logout.php'>Logout</a></li"; # Login verlinken
}else{
    echo "<li class='li'><a href='../Login/login.php'>Login</a></li";
}
    $statement = $pdo -> prepare ("SELECT Profilbild FROM User WHERE ID= :USER _ID ");
                        $statement -> bindParam(":User_ID", $_SESSION["User_ID"]);
                        if($statement -> execute()) {
                            if ($row = $statement->fetch()) {
                                if (($row["Profilbild"]) == null or "") {
                                    echo "<div>kein Profilbild</div>";
                                } else {
                                    echo "<div><img class='profilpicture' src='https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/" . $row['Profilbild'] ."'></div>";
                                }
                            }

                    }
                    ?>
        </div>

        </div>
    </header>
    </body>