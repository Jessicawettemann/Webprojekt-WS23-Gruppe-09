<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Angebotsübersicht</title>

</head>

<body>
    <h1> Das ist unsere Ich biete-Seite </h1>
<?php
$statement=$pdo->prepare("SELECT * FROM Ich_biete");
if ($statement->execute()){
    while($row=$statement->fetch()) {
        echo "<h4>" . $row["name"]. "</h4>";

        if (!empty($row["foto"])) {
            echo "<img class='image' src='https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/" . $row["foto"] . "'height='100px'>";
        } else {
            echo "<div class='no'>kein Foto des Angebots enthalten</div>";
        }
        echo "<br><a class='edit' href=ich-biete_Bearbeiten.php?ID=" . $row["ID"] . "'>Bearbeiten</a>  <a class='edit' href=ich-biete_Löschen_do.php?ID=" . $row["ID"] . "'> Löschen </a>  " . "<br>";
    }
}else{
    echo "<div class='fail'>Fehlermeldung</div>";
    echo $statement->errorInfo()[2];
    die();
    }
?>
<br>

</body>
</html>

</body>
</html>