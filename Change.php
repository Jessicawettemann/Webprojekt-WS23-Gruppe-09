<?php
include "Header Sicherheit.php";
include "Datenbank Verbindung.php";
session_start();

$statement=$pdo->prepare("SELECT * FROM Upload WHERE ID=?");
if ($statement->execute(array($_GET["ID"]))){
    if($row=$statement->fetch()){
        ?>
        <form action="Change_do.php?ID=<?php echo $row["ID"];?>" method="post" enctype="multipart/form-data">
            neuer Beschreibung: <input type="text" name="beschreibung" value="<?php echo $row["beschreibung"];?>"> <br> <br>
            neue Zustand: <input type="text" name="zustand" value="<?php echo $row["zustand"];?>"> <br><br>
            neue Bilddatei einfügen: <input type="file" name="foto" value="<?php echo $row["foto"];?>"> <br><br>
            neuer Preis einfügen: <input type="text" name="preis" value="<?php echo $row["preis"];?>" > <br><br>
            <input type="submit">
        </form>
        <?php
    }else{
        die("<div class='fail'>Song nicht vorhanden</div>");
    }

} else{
    die("<div class='fail'>Formular-Fehler</div>");
}



?>


<a href="ich-biete_Übersicht.php"> <button class="button">Zurück</button></a>
</body>
</html>