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

include "header.php";
?>

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

<?php include "footer.php";
