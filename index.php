<?php
require_once "db/mysql.php";

$allProducts = $mysqli->query("SELECT * FROM tblbooks");

include "header.php";
?>

    <main>
        <ul>
            <?php
            while ($product = $allProducts->fetch_assoc()): ?>
                <li class="book">
                    <a href="product.php?isbn=<?php echo $product['isbn'] ?>">
                        <img src="images/<?php echo $product["imageFilename"] ?>">
                        <h4><?php echo $product["title"] ?></h4>
                    </a>
                </li>
            <?php endwhile ?>
        </ul>
    </main>

<?php include "footer.php";
