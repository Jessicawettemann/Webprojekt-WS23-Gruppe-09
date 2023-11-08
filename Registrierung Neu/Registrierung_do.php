<?php
include"Datenbank Verbindung.php";

session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>

</head>
<body>

<?php
if(!isset($_POST["benutzername"]) or !isset($_POST["passwort"])){
    die("<div class='fail'> Formularfehler </div>");
} //Der Code überprüft, ob die POST-Variablen "benutzername" und "passwort" gesetzt sind.
// Wenn nicht, wird eine Fehlermeldung angezeigt und der Code wird beendet.

if ($_FILES["profilbild"]["name"] != null) {
    $fileName = $_FILES["profilbild"]["name"];
    $fileSplit = explode(".", $fileName);
    $fileType = $fileSplit[sizeof($fileSplit) - 1];
//In diesem Codeabschnitt wird überprüft, ob ein Profilbild hochgeladen wurde.
// Dazu wird überprüft, ob der Wert des "name" Feldes des "profilbild" Arrays in $_FILES nicht null ist.
//Wenn ein Profilbild hochgeladen wurde, wird der Dateiname in der Variable $fileName gespeichert.
// Dann wird der Dateiname mit dem Punkt als Trennzeichen in ein Array aufgeteilt, um das Dateiformat zu erhalten.
    //In diesem Codeabschnitt wird überprüft, ob ein Profilbild hochgeladen wurde. Dazu wird überprüft, ob der Wert des "name" Feldes des "profilbild" Arrays in $_FILES nicht null ist.
    //
    //Wenn ein Profilbild hochgeladen wurde, wird der Dateiname in der Variable $fileName gespeichert. Dann wird der Dateiname mit dem Punkt als Trennzeichen in ein Array aufgeteilt, um das Dateiformat zu erhalten.
    // Das Dateiformat wird in der Variable $fileType gespeichert, indem das letzte Element des Arrays verwendet wird.
// Das Dateiformat wird in der Variable $fileType gespeichert, indem das letzte Element des Arrays verwendet wird.
    if ($fileType == "jpg" or $fileType == "png" or $fileType == "PNG" or $fileType == "pdf" or $fileType == "HEIC" or $fileType == "jpeg" or $fileType == "JPG") {
        echo "";
    } else {
        die("<div class='fail'> Dein aktuelles Dateiformat wird nicht unterstützt. </div>");

    }

}
    if ($_FILES["profilbild"]["size"] > 80000000) {
    die("<div class='fail'> Deine aktuellle Datei ist leider zu groß </div>");
}
$statement = $pdo->prepare("INSERT INTO Nutzer (vorname, nachname, benutzername, email, profilbild, passwort) VALUES (?,?,?,?,?,?)");
$p = "hjfew3545r8c0szhwgfsdafghjgfdhj";

// Felder sollen nicht freigelassen werden wenn doch Fehlermeldung:
if(($_POST["vorname"]) !=null and ($_POST["nachname"]) !=null and ($_POST["benutzername"]) !=null and ($_POST["email"]) !=null and ($_POST["passwort"]) != null and ($_POST["profilbild"]) ){
    if($statement->execute(array(htmlspecialchars($_POST["vorname"]), htmlspecialchars($_POST["nachname"]), htmlspecialchars($_POST["benutzername"]), htmlspecialchars($_POST["email"]), htmlspecialchars($_FILES["profilbild"]["name"]), password_hash($_POST["passwort"].$p, PASSWORD_BCRYPT), ))){
        echo"<div class='fine'> Du wurdest erfolgreich registriert "."<br><br>";
    }else{
        die("<div class='fail'> Diese Zugangsdaten sind bereits vergeben "."<br><br>". "<a href='Registrierung%20Formular.php'>Erneut versuchen</a> </div>");
    }
}else{
    echo"<div class='fail'> Alle Felder müssen ausgefüllt sein! "."<br><br>"."<a href='Registrierung%20Formular.php'>Erneut versuchen</a> </div>";
} //Der Code bereitet dann eine SQL-Abfrage vor, um die Benutzerdaten in die Datenbanktabelle "Nutzer" einzufügen. Es werden verschiedene Felder überprüft, um sicherzustellen, dass sie nicht leer sind. Wenn alle Felder ausgefüllt sind, wird die Abfrage ausgeführt und eine Erfolgsmeldung angezeigt.
// Andernfalls wird eine Fehlermeldung angezeigt, die darauf hinweist, dass alle Felder ausgefüllt sein müssen.
?>

</body>
</html>