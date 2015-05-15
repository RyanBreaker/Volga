<?php
require_once "db/mysql.php";
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Volga</title>
    <link href="stylesheets/style.css" rel="stylesheet" type="text/css">
    <script src="//use.typekit.net/sam3app.js"></script>
    <script>
        try {
            Typekit.load();
        } catch (e) {
        }
    </script>
    <meta name="keywords" content="Books">
    <meta name="Description" content="Awesome books!">
</head>
<body>

<header>
    <a href="index.php"><h1 id="logo">Volga.</h1></a>
    <nav>
        <h2><label for="genre-chooser">Genre</label></h2>
        <select id="genre-chooser">
            <option disabled selected>View by genre...</option>
            <?php
            $genres = $mysqli->query("SELECT * FROM tblgenres ORDER BY genreName");
            while ($genre = $genres->fetch_assoc()): ?>
                <option value="<?php echo $genre["genreId"] ?>"><?php echo $genre["genreName"] ?></option>
            <?php endwhile;
            $genres->close();
            ?>
        </select>
    </nav>
    <form id="login">
        <label for="uname">Username: </label>
        <input type="text" id="uname"><br>
        <label for="pass-login">Password: </label>
        <input type="password" id="pass-login"><br>
        <a href="register.html">Register</a>
    </form>
</header>
