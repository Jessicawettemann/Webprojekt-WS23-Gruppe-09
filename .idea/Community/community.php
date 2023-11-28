<?php
include "Header Sicherheit.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminkalender</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<h1>Forum</h1>

<form id="post-form" action="community_do.php">
    <textarea id="beitrag" placeholder="Gib hier deine Nachricht ein..."></textarea>
    <button type="submit">Senden</button>
</form>

<div id="forum-posts">
    <!-- Nachrichten werden hier angezeigt. -->
</div>


</body>
</html>

