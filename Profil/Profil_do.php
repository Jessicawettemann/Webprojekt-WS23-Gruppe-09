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

</head>
<body>

<h5> Profil bearbeiten </h5>

<?php
if(!isset($_SESSION["Nutzer_ID"])){
    echo("<div class='fail'> Bitte melde dich zunächst an! "."<br><br>". "<a href='Login Formular'>Hier geht's zum Login</a> </div>");
}else {

#<!-- Datensatz aus der Datenbank holen von angemeldetem Nutzer-->

    $Nutzer = $_SESSION["Nutzer_ID"];
    $statement = $pdo->prepare("SELECT * FROM Nutzer WHERE ID = ?");
    if (!$statement->execute([$Nutzer])) {
        die("<div class='fail'>Datensatz nicht verfügbar</div>");
    }
    $row = $statement->fetch();
    $Nutzer_Id = $row["ID"];
    $benutzername = $row["benutzername"];
    $email = $row["email"];
    $passwort = $row["passwort"];
    $profilbild = $row["profilbild"];
    echo "<div class='rows'>";
    echo "Benutzername:" ." " . $row ["benutzername"]."<a class='edit' href= 'benutzername.php'>" . " bearbeiten ". "</a>";
    echo "<br>";
    echo "E-Mail:"." ". $row ["email"]. "<a class='edit' href= 'email.php'>" . " bearbeiten". "</a>";
    echo "<br>";
    echo "<a href= 'Passwort.php'>". "Passwort ändern". "</a> <br>" ;
    echo "<br>";
    echo "<img src='https://mars.iuk.hdm-stuttgart.de/~jw170/Bilder/" . $row["profilbild"] . "'height='100px'> <br>".
        "<a href= 'Profilbild.php'>" . "aktuelles Profilbild ändern";
    echo "<br>";
    echo "</div>";
}
?>

</body>
</html>