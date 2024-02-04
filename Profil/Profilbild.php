<?php
include 'Datenbank Verbindung.php';
include "Header Sicherheit.php";
session_start();

if(!isset($_SESSION["Nutzer_ID"])){
    //displayMessage-Funktion
    include 'fehlermeldung.php';
    displayMessage("Bitte melde dich zunächst an. <br><a href='Login Formular.php'>Hier geht's zum Login</a>", 'fail');

}else{

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Profil_1.css">
    <link rel="stylesheet" type="text/css" href="fehlermeldung.css">
    <title>Profilbild bearbeiten</title>

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
$profilbild = $row["profilbild"];

?>

<!-- Formular Profilbild bearbeiten-->
<form class="rows" action = "profilbild_do.php?Nutzer_Id=<?php echo $row["ID"]; ?>" method="post" enctype="multipart/form-data">
    <h1>Profilbild bearbeiten</h1>
    <label for="profilbildinput"></label>
    <input type="file" name="profilbild" value="<?php echo $row["profilbild"];?>"> <br>
    <p1>
        <input type="submit" value="Änderung bestätigen" >
    </p1>
</form>
<?php
}
?>
</body>
</html>
