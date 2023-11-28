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

<form id="post-form">
    <textarea id="post-content" placeholder="Gib hier deine Nachricht ein..."></textarea>
    <button type="submit">Senden</button>
</form>

<div id="forum-posts">
    <!-- Nachrichten werden hier angezeigt. -->
</div>

<br><br>

 <h1>Feed</h1>
 <form id="post-form">
    <label for="post-input">Neuer Post:</label>
    <input type="text" id="post-input" name="post-input">
    <button type="submit">Posten</button>
 </form>
 <div id="posts-container"></div>
 <script src="script.js"></script>

</body>

</html>

