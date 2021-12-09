<?php

require_once("connexion.php");

// open the $_SESSION
session_start();

try {

    //prepare() is a PDO method to make sure that our query is not subject to a SQL inject.
    //this returns a PDOStatement object
    $q = $db->prepare("SELECT productName, productCode FROM products");

    //To execute the query set into $q (PDOStatement) object
    $q->execute();

} catch(Exception $e) {
    echo $e->getMessage();
    exit;
}

// PDO::FETCH_ASSOC to display only the columns as keys in the array returned
$products = $q->fetchAll(PDO::FETCH_ASSOC);

include "includes/header.php";

?>

<h1>Classic Models</h1>

    <ol>
        <?php
            //display the datas
            foreach($products as $product) : ?>

            <li>
                <a href="product.php?code=<?php echo $product["productCode"]; ?>">
                <h3><?php echo $product["productName"];?></h3>
                </a>
            </li>

        <?php
            endforeach;
        ?>
    </ol>

<?php
    include "includes/footer.php";
?>