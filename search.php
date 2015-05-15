<?php
require_once "db/mysql.php";

$searchResults = array();

// Genre search
if (isset($_GET['genre']) && $genreId = intval($_GET['genre'])) {

    $genreSearch = $mysqli->prepare("SELECT tblbooks.isbn,
                                   tblbooks.title,
                                   tblbooks.price,
                                   tblbooks.imageFilename
                            FROM tblbooks
                              JOIN tblbooksgenresxref
                                ON tblbooksgenresxref.isbn=tblbooks.isbn AND
                                   tblbooksgenresxref.genreId=?");
    $genreSearch->bind_param('i', $genreId);
    $genreSearch->execute();
    $genreSearch->bind_result($isbn, $title, $price, $imageFilename);

    while ($genreSearch->fetch())
        $searchResults[] = array('isbn' => $isbn, 'title' => $title, 'price' => $price, 'imageFilename' => $imageFilename);

    $genreSearch->free_result();

} else if (!empty($_GET['author']) || !empty($_GET['isbn']) || !empty($_GET['title'])) {

    $query = "SELECT tblbooks.isbn, tblbooks.title, tblbooks.price, tblbooks.imageFilename FROM tblbooks";
    $selectors = array();

    // Author search:
    if ($author = !empty($_GET['author'])) {
        $query .= " JOIN tblbooksauthorsxref ON tblbooksauthorsxref.isbn = tblbooks.isbn
                    JOIN tblauthors ON tblbooksauthorsxref.authorId = tblauthors.authorId
                    WHERE tblauthors.compositeName LIKE '%{$_GET['author']}%'";  // Forgive me Father for I have sinned...
    }

    if (!empty($_GET['isbn']))   // ISBN search
        $selectors[] = " tblbooks.isbn LIKE '%{$_GET['isbn']}%'";
    if (!empty($_GET['title']))  // Title search
        $selectors[] = " tblbooks.title LIKE '%{$_GET['title']}%'";

    switch (count($selectors)) {
        case 2:
            if ($author)
                $query .= ' AND' . $selectors[0] . ' AND' . $selectors[1];
            else
                $query .= ' WHERE' . $selectors[0] . ' AND' . $selectors[1];
            break;
        case 1:
            if ($author)
                $query .= ' AND' . $selectors[0];
            else
                $query .= ' WHERE' . $selectors[0];
    }

    var_dump($query);

    $results = $mysqli->query($query);
    while ($result = $results->fetch_assoc())
        $searchResults[] = $result;
}

include "header.php";
?>

    <main>
        <ul>
            <?php
            if (count($searchResults) == 0)
                echo "No results found";
            else {
                foreach ($searchResults as $result): ?>
                    <li class="book">
                        <a href="product.php?isbn=<?php echo $result["isbn"] ?>">
                            <img src="images/<?php echo $result["imageFilename"] ?>">
                            <h4><?php echo $result["title"] ?></h4>
                            <h5 class="price">$<?php echo $result["price"] ?></h5>
                        </a>
                    </li>
                <?php endforeach;  // I HAD NO IDEA PHP WAS ABLE TO OUTPUT HTML LIKE THIS, MY MIND IS BLOWN
            } ?>
        </ul>
    </main>

<?php include "footer.php";
