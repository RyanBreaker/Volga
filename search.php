<?php
require_once "db/mysql.php";

$genreId = intval($_GET["genre"]);
if ($genreId <= 0)
    $genreId = 1;

$search = $mysqli->prepare("SELECT tblbooks.isbn,
                                   tblbooks.title,
                                   tblbooks.price,
                                   tblbooks.imageFilename
                            FROM tblbooks
                              JOIN tblbooksgenresxref
                                ON tblbooksgenresxref.isbn=tblbooks.isbn AND
                                   tblbooksgenresxref.genreId=?");

$genreResults = array();

$search->bind_param("i", $genreId);
$search->execute();

$search->bind_result($isbn, $title, $price, $imageFilename);

while ($search->fetch())
    $genreResults[] = array("isbn" => $isbn, "title" => $title, "price" => $price, "imageFilename" => $imageFilename);
$search->free_result();

include "header.php";
?>

    <main>
        <ul>
            <?php
            foreach ($genreResults as $result): ?>
                <li class="book">
                    <a href="/product.php?isbn=<?php echo $result["isbn"] ?>">
                        <img src="/images/<?php echo $result["imageFilename"] ?>">
                        <h4><?php echo $result["title"] ?></h4>
                    </a>
                </li>
            <?php endforeach;  // I HAD NO IDEA PHP HAD THIS, MY MIND IS BLOWN ?>
        </ul>
    </main>

<?php include "footer.php";
