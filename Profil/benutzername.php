<?php

include 'Datenbank Verbindung.php';
include "Header Sicherheit.php";
session_start();
if(!isset($_SESSION["Nutzer_ID"])){
    echo("<div class='fail'> Bitte melde dich zunächst an! "."<br><br>". "<a href='Login Formular.php'>Hier geht's zum Login</a> </div>");
}else{

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Profil_1.css">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
    <title>Username bearbeiten</title>

</head>
<body>


<!-- Datensatz aus der Datenbank holen von angemeldetem Nutzer -->
<?php
$Nutzer = $_SESSION["Nutzer_ID"];
$statement=$pdo->prepare("SELECT * FROM Nutzer WHERE ID = ?");
if (!$statement->execute([$Nutzer])){
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Datensatz nicht verfügbar.", 'fail');

}
$row = $statement->fetch();
$Nutzer_id = $row["ID"];
$benutzername = $row["benutzername"];
?>

<!-- Formular Profil Benutzername bearbeiten-->
<form class='rows' action = "benutzername_do.php?Nutzer_id=<?php echo $Nutzer_id; ?>" method="post">
    <h1>Username bearbeiten</h1>
    <label for="benutzernameinput"></label>
    <input type="text" name="username" id="benutzernameinput" value="<?php echo $row["benutzername"]; ?>"> <br>
    <p><input type="submit" value="Änderung bestätigen"></p>
</form>
<?php
}
?>
</body>
</html>
