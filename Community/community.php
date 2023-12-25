<?php include "Header Sicherheit.php"; include "Datenbank Verbindung.php"; session_start(); ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminkalender</title>
    <link rel="stylesheet" type="text/css" href="Formulare_1.css">
</head>
<body>

<!-- Forum -->
<div id="forum">

</div>

<!-- Formular zum Hinzufügen von Beiträgen -->
<?php
// Überprüfen, ob der Benutzer angemeldet ist
if(isset($_SESSION['benutzername'])) {
    echo '<form action="community_do.php" method="post" enctype="multipart/form-data">';
    echo '    <h1>Forum</h1>';
    echo '    <br><br>';
    echo '    <label for="beitrag"></label>';
    echo '    <input type="text" placeholder="Beitrag" id="beitrag" name="beitrag" required>';
    // Verstecktes Feld für den Benutzernamen
    echo '    <input type="hidden" name="benutzername" value="' . $_SESSION['benutzername'] . '">';
    echo '    <button type="submit">Ereignis hinzufügen</button>';
    echo '<br><br><br><br>';
    echo '</form>';
} else {
    echo '<p>Du musst angemeldet sein, um einen Beitrag hinzuzufügen.</p>';
}
?>

<?php
// Rest des Codes bleibt unverändert
?>
</body>
</html>
