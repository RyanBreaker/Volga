<?php
require_once "db/mysql.php";

$isbn = $_GET['isbn'];

// If the ISBN is invalid...
//if (!$isbn) {
//    http_redirect("/");
//    exit();
//}

$productStmt = $mysqli->prepare("
SELECT
  tblbooks.title,
  tblbooks.price,
  tblbooks.imageFilename,
  tblbooks.description,
  tblauthors.compositeName
FROM tblbooks
  JOIN tblbooksauthorsxref
    ON tblbooksauthorsxref.isbn = tblbooks.isbn
  JOIN tblauthors
    ON tblbooksauthorsxref.authorId = tblauthors.authorId
WHERE tblbooks.isbn = ?
LIMIT 1
");

$productStmt->bind_param("s", $isbn);
$productStmt->execute();

// Bind and fetch results, then close the stmt
$productStmt->bind_result($title, $price, $imageFilename, $description, $authorName);
$productStmt->fetch();
$productStmt->close();

// Decode escpaed HTML tags
$description = str_replace(array('&lt;', '&gt;'), array('<', '>'), $description);
// Remove erroneous paragraphs
$description = str_replace(array('<p style="margin: 0px;">&Acirc;&nbsp;</p>', '<p></p>','style="margin: 0px;"'), array(), $description);
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

            while ($genre = $genres->fetch_assoc()):?>
                <li>
                    <a href="/search.php?genre=<?php echo $genre['genreId']?>">
                        <?php echo $genre['genreName'] ?>
                    </a>
                </li>
            <?php endwhile;
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

<main id="book-page">
    <img id="book-cover" src="/images/<?php echo $imageFilename ?>">
    <article id="book-details">
        <h2><?php echo $title ?></h2>

        <h3><?php echo $authorName ?></h3>

        <h4><?php echo '$' . $price ?></h4>

        <p>
            <?php echo $description ?>
        </p>
    </article>
</main>

<footer>
    Volga Books&copy;
</footer>

</body>
</html>
