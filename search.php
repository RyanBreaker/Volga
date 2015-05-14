<?php
require_once "db/mysql.php";

$genreId = intval($_GET["genre"]);

$search = $mysqli->prepare("SELECT tblbooks.isbn, title, price, imageFilename FROM tblbooks
                              JOIN tblbooksgenresxref
                              ON tblbooksgenresxref.isbn=tblbooks.isbn AND
                                 tblbooksgenresxref.genreId=?");

$genreResults = [];

$search->bind_param("i", $genreId);
$search->execute();

$search->bind_result($isbn, $title, $price, $imageFilename);

while ($search->fetch())
    $genreResults[] = ["isbn" => $isbn, "title" => $title, "price" => $price, "imageFilename" => $imageFilename];

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Volga</title>
    <link href="stylesheets/style.css" rel="stylesheet" type="text/css">
    <script src="//use.typekit.net/sam3app.js"></script>
    <script>try {
            Typekit.load();
        } catch (e) {
        }</script>
    <meta name="keywords" content="Books">
    <meta name="Description" content="Awesome books!">
</head>
<body>

<header>
    <a href="index.php"><h1 id="logo">Volga.</h1></a>
    <nav>
        <h2>Genres</h2>
        <ul>
            <?php
            $genres = $mysqli->query("SELECT * FROM tblgenres");

            while ($genre = $genres->fetch_assoc()) {
                echo "<li><a href=\"/search.php?genre={$genre['genreId']}\">{$genre['genreName']}</a></li>";
            }

            $genres->free();
            ?>
        </ul>
    </nav>
    <form id="login">
        <label for="uname">Username: </label>
        <input type="text" id="uname"><br>
        <label for="pass-login">Password: </label>
        <input type="password" id="pass-login"><br>
        <a href="register.html">Register</a>
    </form>
</header>

<main>
    <?php
    foreach($genreResults as $result) {
        echo "";
    }
    ?>
</main>

<footer>
    Volga Books&copy;
</footer>

</body>
</html>
