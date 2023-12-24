<?php

include "Datenbank Verbindung.php";
include "Header Sicherheit.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width">


   <title>Forum</title>
</head>
<body>
<h1>Willkommen, <?php echo $_SESSION['username']; ?>!</h1>


<?php


?>
<!DOCTYPE html>
<html>
<head>
    <title>Community</title>
</head>
<body>

<h2>Beitrag eingeben</h2>

<form action="community_do.php" method="post">
    <textarea name="beitrag" rows="4" cols="50"></textarea><br>
    <input type="submit" name="submit" value="Submit">
</form>

<h2>Beiträge</h2>

<?php

$stmt = $pdo->query('SELECT ID, beitrag, datum, Nutzer FROM Beitrag');
while ($row = $stmt->fetch()) {
    echo '<strong>ID:</strong> ' . $row['ID'] . '<br>';
    echo '<strong>Beitrag:</strong> ' . $row['beitrag'] . '<br>';
    echo '<strong>Datum:</strong> ' . $row['datum'] . '<br>';
    echo '<strong>Nutzer:</strong> ' . $row['Nutzer'] . '<br><br>';
}
?>

</body>
</html>

