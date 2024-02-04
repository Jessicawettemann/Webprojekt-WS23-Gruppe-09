<?php


include 'Datenbank Verbindung.php';
include "Header Sicherheit.php";

session_start();
if(!isset($_SESSION["Nutzer_ID"])){
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Bitte melde dich zunächst an.<br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');
}else{


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Profil_1.css">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
    <title>Mail bearbeiten</title>

</head>
<body>


<!-- Datensatz aus der Datenbank holen von angemeldetem Nutzer -->
<?php
$Nutzer= $_SESSION["Nutzer_ID"];
$statement=$pdo->prepare("SELECT * FROM Nutzer WHERE ID = ?");
if (!$statement->execute([$Nutzer])){
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Datensatz nicht verfügbar.<br>", 'fail');
}
$row = $statement->fetch();
$Nutzer_Id = $row["ID"];
$email = $row["email"];
?>

<!-- Formular Profil mail bearbeiten-->
<form class="rows" action = "email_do.php?Nutzer_Id=<?php echo $Nutzer_Id ;?>" method="post">
    <h1>E-Mail bearbeiten</h1>
    <label for="mailinput"></label>
    <input type="email" name="email" id="email_input" value="<?php echo $row["email"]; ?>"> <br>
    <p1><input type="submit" value="Änderung bestätigen"></p1>
</form>
<?php
}
?>
</body>
</html>
