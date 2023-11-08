<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container1 {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container1">
        <h2>Registrieren</h2> <br> 
        <form action="registrieren.php" method="post">
            <label for="vorname">Vorname:</label>
            <input type="text" id="vorname" name="vorname" required> <br><br>
            
            <label for="nachname">Nachname:</label>
            <input type="text" id="nachname" name="nachname" required> <br><br>

            <label for="email">E-Mail:</label>
            <input type="email" id="email" name="email" required> <br><br>

            <label for="benutzername">Benutzername:</label>
            <input type="text" id="benutzername" name="benutzername" required> <br><br>

            <label for="passwort">Passwort:</label>
            <input type="password" id="passwort" name="passwort" required> <br><br>

            <label for="profilbild">Profilbild hochladen:</label>
            <input type="file" id="profilbild" name="profilbild" required> <br><br><br>
            
            <button type="submit">Registrieren</button> 

        </form>
    </div>
</body>
</html>