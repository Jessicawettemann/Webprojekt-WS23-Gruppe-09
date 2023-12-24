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

<?php
session_start();

if (!isset($_SESSION['benutzername'])) {
    header('Location: Login Formular.php');
}

if (isset($_POST['beitrag'])) {
    $beitrag = $_POST['beitrag'];

    $stmt = $pdo->prepare('INSERT INTO Beitrag (benutzername, beitrag) VALUES (?, ?)');
    $stmt->execute([$_SESSION['benutzername'], $beitrag]);
}

$Beitrag = $pdo->query('SELECT * FROM Beitrag ORDER BY id DESC')->fetchAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community</title>
</head>
<body>
    <h1>Willkommen, <?php echo $_SESSION['bentuzername']; ?>!</h1>

    <form action="community.php" method="post">
        <textarea name="beitrag" rows="5" cols="50" placeholder="Gib hier deinen Beitrag ein..."></textarea>
        <br>
        <input type="submit" value="Beitrag erstellen">
    </form>

    <table border="1">
        <tr>
            <th>Benutzername</th>
            <th>Beitrag</th>
        </tr>
        <?php foreach ($Beitrag as $beitrag): ?>
            <tr>
                <td><?php echo $beitrag['benutzername']; ?></td>
                <td><?php echo $beitrag['beitrag']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="logout.php">Logout</a>
</body>
</html>