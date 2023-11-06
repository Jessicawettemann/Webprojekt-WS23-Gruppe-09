<?php
include "Datenbank Verbindung.php";
session_start();
 //Abruf der Daten des Formulars
 if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Username = $_POST['username'];
    $Passwort = $_POST['password'];
//Abruf der Daten in der Datenbank
    $sql = "SELECT * FROM User WHERE Username = '$username' and password = '$password'";
    $result = <conn->query($sql);
//Überprüfung ob Anmeldung erfolgreich oder nicht
    if ($result->num_rows == 1) {
        $_SESSION['username'] = $Username;
        header (location der Homepage);          //Bei erfolgreichem Anmelden direkte weiterleitung auf die Homepage 
    } else {
        $_SESSION['login_error'] = "Falsche Anmeldedaten!";
        header ("Location: Login Formular.html")  //Bei fehlerhaften Login zurückleitung auf Login-Seite
        }
    } 
 ?>

//<?php
//$statement = $pdo->prepare("SELECT * FROM Nutzer WHERE benutzername=?");
//$statement->bindParam(":benutzername", $_POST["benutzername"]);
//$p="hjfew3545r8c0szhwgfsdafghjgfdhj";
//if($statement->execute(array(htmlspecialchars($_POST["benutzername"])))){
//
//    if($row = $statement->fetch()){
//
//        if(password_verify($_POST["passwort"].$p,$row["passwort"])){
//
//            echo "<div class='big'>Herzlich Willkommen, ".$row["benutzername"]."<br>"."</div>";
//            $_SESSION["benutzername"]=$row["benutzername"];
//            $_SESSION["Nutzer_ID"]=$row["ID"];
//
//
//
//        } else{
//
//            echo("<div class='fail'>Passwort falsch</div>");
//            echo $statement->errorInfo()[2];
//        }
//    }else{
//
//        echo "<div class='fail'>Nutzer nicht vorhanden</div>";
//        echo "<a href='../Registrierung/register.php'> hier registrieren </a>";
//    }
//}else{
//    die("<div class='fail'>Datenbank-Fehler</div>");
//
//}
//?>
