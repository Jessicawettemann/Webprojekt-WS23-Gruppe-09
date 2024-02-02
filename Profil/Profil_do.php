<?php
include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">

    <title>Profil bearbeiten</title>
    <link rel="stylesheet" type="text/css" href="Profil.css">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
</head>
<body>

<br><br>

<div class="profile-card"

     <br>

<?php
if(!isset($_SESSION["Nutzer_ID"])){
    echo("<div class='fail'> Bitte melde dich zunächst an! "."<br><br>". "<a href='Login Formular.php'>Hier geht's zum Login</a> </div>");
}else {

#<!-- Datensatz aus der Datenbank holen von angemeldetem Nutzer-->

    $Nutzer = $_SESSION["Nutzer_ID"];
    $statement = $pdo->prepare("SELECT * FROM Nutzer WHERE ID = ?");
    if (!$statement->execute([$Nutzer])) {
        die("<div class='fail'>Datensatz nicht verfügbar</div>");
    }
    $row = $statement->fetch();
    $profilbild = $row["profilbild"];
    $Nutzer_Id = $row["ID"];
    $benutzername = $row["benutzername"];
    $email = $row["email"];
    $passwort = $row["passwort"];

    echo "<div class='rows'>";
    echo "<h5> Mein Profil </h5>";
    echo "<br><br>". " <p style= text-align:center </p>";
    echo "<img src='https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/" . $row["profilbild"] . "'height='100px'> <br><br>".
        "<a href= 'Profilbild.php'>" . "Profilbild ändern". "</a>";

    echo "<br><br>"." <p style= text-align:center </p>";
    echo "Benutzername:" ." " . $row ["benutzername"]."<a class='edit'  href= 'benutzername.php'>" . " bearbeiten ". "</a>" ." <p style= text-align:center </p>";
    echo "<br><br>";
    echo "E-Mail:"." ". $row ["email"]. "<a class='edit' href= 'email.php'>" . " bearbeiten". "</a>";
    echo "<br><br>";
    echo "<a href= 'Passwort.php'>". "Passwort ändern". "</a> <br>" ;
    echo "<br><br>";

    echo "</div>";
}
?>
</div>
</body>
</html>
