<?php
include "Datenbank Verbindung.php"; //Datenbankverbindung herstellen

//Sie müssen die Daten abrufen, die der Benutzer im Registrierungsformular eingegeben hat. 
$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$email = $_POST['email'];
$benutzername = $_POST['benutzername'];
$passwort = $_POST['passwort'];

//Erstellen Sie einen SQL-Befehl, um die Daten in die Datenbank einzufügen.
$sql = "INSERT INTO User (Vorname, Nachname, EMail, Benutzername, Passwort) VALUES (:vorname, :nachname, :email, :benutzername, :passwort)";

//Verwenden Sie PDO, um den vorbereiteten SQL-Befehl auszuführen.
// Binden Sie die Parameter an die entsprechenden Werte, die Sie aus dem Formular abgerufen haben. 
//Führen Sie dann den Befehl aus, um die Daten in die Tabelle einzufügen:
$stmt = $db->prepare($sql);
$stmt->bindParam(":vorname", $Vorname);
$stmt->bindParam(":nachname", $Nachname);
$stmt->bindParam(":email", $EMail);
$stmt->bindParam(":benutzername", $Benutzername);
$stmt->bindParam(":passwort", $Passwort);
$stmt->execute();

echo "Registrierung erfolgreich!"; //Überprüfung, ob erfolgreich   
$db = null; // Datenbankverbindung schließen
