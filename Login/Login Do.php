<?php
include "Datenbank Verbindung.php";
session_start();
 //Abruf der Daten des Formulars
 if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
//Abruf der Daten in der Datenbank
    $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
    $result = <conn->query($sql);
//Überprüfung ob Anmeldung erfolgreich oder nicht
    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header (location der Homepage);          //Bei erfolgreichem Anmelden direkte weiterleitung auf die Homepage 
    } else {
        $_SESSION['login_error'] = "Falsche Anmeldedaten!";
        header ("Location: Login Formular.html")  //Bei fehlerhaften Login zurückleitung auf Login-Seite
        }
    } 
 ?>