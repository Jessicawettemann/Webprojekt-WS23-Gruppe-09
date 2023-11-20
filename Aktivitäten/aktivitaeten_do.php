<?php
include 'Datenbank Verbindung.php';
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kalender</title>

</head>

<body>
<?php

for ($i=0; $i < 10 $i++); 
{
	
    // Daten vom Formular aufnehmen
    $name=$_POST['event_name'][$i];
    $beschreibung=$_POST['event_beschreibung'][$i];
    $datum=$_POST['datum'][$i];
    $ort=$_POST['ort'][$i];
    
    // Daten in MySQL eintragen
    $sql="INSERT INTO $tbl_Aktivitäten(name, beschreibung, datum, ort) VALUES('$name', '$beschreibung', '$datum', '$ort')";
    $result=mysql_query($sql);
    
    }
    
    // Bei Erfolg "Erfolg!" ausgeben.
    if($result){
    echo "Erfolg!";
    echo "<BR>";
    echo "<a href='formular.html'>Zur&uuml;ck zum Formular.</a>";
    }
    
    else {
    echo "FEHLER!";
    }
    ?>
    
    <?php
    // close connection
    mysql_close();
    ?>

