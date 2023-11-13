<?php


include " Datenbank Verbindung.php";
include "Header Sicherheit.php";

session_start();
if(!isset($_SESSION["Nutzer_ID"])){
    echo("<div class='fail'> Bitte melde dich zunächst an! "."<br><br>". "<a href='Login Formular'>Hier geht's zum Login</a> </div>");
}else{


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Mail bearbeiten</title>

</head>
<body>
<h1>E-Mail bearbeiten</h1>

<!-- Datensatz aus der Datenbank holen von angemeldetem Nutzer -->
<?php
$Nutzer= $_SESSION["Nutzer_ID"];
$statement=$pdo->prepare("SELECT * FROM Nutzer WHERE ID = ?");
if (!$statement->execute([$Nutzer])){
    die("<div class='fail'>Datensatz nicht verfügbar</div>");
}
$row = $statement->fetch();
$Nutzer_Id = $row["ID"];
$email = $row["email"];
?>

<!-- Formular Profil mail bearbeiten-->
<form class="rows" action = "email_do.php?Nutzer_Id=<?php echo $Nutzer_Id ;?>" method="post">
    <label for="mailinput"></label>
    <input type="email" name="email" id="email_input" value="<?php echo $row["email"]; ?>"> <br>
    <p><input type="submit" value="Änderung bestätigen"></p>
</form>
<?php
}
?>
</body>
</html>
