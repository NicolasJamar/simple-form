<?php

require_once("connexion.php");

session_start();

// check if $_GET is empty
if(empty($_GET["code"])) {
    echo "url incorrect";
    exit;
}
    $code = $_GET["code"];

    try {
        $q = $db->prepare("SELECT productCode, productName, buyPrice FROM products WHERE productCode=:codeproduct");

        //To bind the $code variable to the :codeproduct declaration and give a type.
        $q->bindParam(":codeproduct", $code, PDO::PARAM_STR);

        //To execute the query set into results object
        // execute() return true or false
        $q->execute();
    } catch(Exception $e) {
        echo $e->getMessage();
        exit;
    }

    $product = $q->fetch(PDO::FETCH_ASSOC);

    if($product == FALSE) {
        echo "This code reference $code doesn't exist in the Database. </br> <a href='/''>Go back</a>";
        die();
    }

include "includes/header.php";

?>


    <h1><?= $product["productName"]; ?></h1>

    <h2><?php echo strip_tags("<h2>attention</h2>"); ?></h2>



<?php
    include "includes/footer.php";
?>