<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="nav_bar.css">
</head>
<body>
<ul>
      <li><a href="index.html">Home</a></li>
      <li><a>Herren</a></li>
      <!--Keine Weiterleitung zu einer anderen Seite! Eher Filtereinstellung für die Kleiderübersicht-->
      <li><a>Damen</a></li>
      <!--Keine Weiterleitung zu einer anderen Seite! Eher Filtereinstellung für die Kleiderübersicht-->
      <li style="float: right"><a class="active" href="login.php">Login</a></li>
      <!--Login/Profil-->
      <li style="float: right"><a href="contact.html">Kontakt</a></li>
    </ul>
    <form action="Post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>