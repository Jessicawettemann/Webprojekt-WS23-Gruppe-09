<?php
include"Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="UTF-8">

    <title>Logout</title>


<body>



<div>

    <h2>Logout</h2>
</div>

<?php
if (!isset($_SESSION["Admin_ID"])){ //Überprüfen, ob Admin angemeldet ist und Zugriff hat
    echo "<div class='fail'> Du bist nicht angemeldet.</div>";
    echo "<br>";
    echo "<a href='Login_Admin.php'>Klicke hier</a>, um dich als Admin anzumelden";
    die();
}
?>

<?php
#if(isset($_SESSION["admin"])){
#$statement = $pdo->prepare("SELECT * FROM Admin WHERE ID=:ID");
#$statement->bindParam(":ID", $_SESSION["ID"]);
#if ($statement->execute()) { //Alles aus Tabelle holen, was zur Session ID gehört (angemeldeter Nutzer)
# $Admin = $statement->fetch();
#}}
?>

<p>Möchtest du dich wirklich ausloggen?</p><br>
<div>
    <form action="Logout_Admin_do.php" method="post">
        <button type="submit">Ja</button>
    </form>
    <form action="Startseite.php">
        <button type="submit">Nein</button>
    </form>
</div>

</body>
</html>