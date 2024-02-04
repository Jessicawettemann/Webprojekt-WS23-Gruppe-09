<?php

include 'Datenbank Verbindung.php';
include "Header Sicherheit.php";
session_start();
if(!isset($_SESSION["Nutzer_ID"])){
    echo("<div class='fail'> Bitte melde dich zunächst an! "."<br><br>". "<a href= 'Login Formular.php'>Hier geht's zum Login</a> </div>");
}else{

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Profil_1.css">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
    <title>Passwort bearbeiten</title>

</head>
<body>


<!-- Datensatz aus der Datenbank holen von angemeldetem Nutzer -->
<?php
$Nutzer = $_SESSION["Nutzer_ID"];
$statement=$pdo->prepare("SELECT * FROM Nutzer WHERE ID = ?");
if (!$statement->execute([$Nutzer])){
        //displayMessage-Funktion
        include 'fehlermeldung.php';
        displayMessage("Datensatz nicht verfügbar. <br>", 'fail');
}
$row = $statement->fetch();
$Nutzer_Id = $row["ID"];
$passwort = $row["passwort"];
?>

<!-- Formular Profil Passwort bearbeiten-->
<form class="rows" action = "Passwort_do.php?Nutzer_Id=<?php echo $Nutzer_Id; ?>" method="post">
<h1>Passwort bearbeiten</h1>
    <label for="passwort_input"></label>
    <input type="password" name="passwort" id="passwortinput" placeholder="Passwort"> <br>
    <p1><input type="submit" value="Änderung bestätigen"></p1>
</form>
<?php
}
?>
</body>
</html>
