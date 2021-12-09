<?php

if(!empty($_POST)) {
    // 1. Check all the inputs exist
    // 2. We check also if the $_POST are not empty because we load the page, the form is empty
    if(isset($_POST["title"], $_POST["comment"])
    && !empty($_POST["title"]) && !empty($_POST["comment"])) {

        $title = strip_tags($_POST["title"]);
        $comment = htmlspecialchars($_POST["comment"]);

        require_once "connexion.php";
        $sql = "INSERT INTO comments(title, comment) VALUES (:title, :comment)";
        $q = $db->prepare($sql);

        // bindParam() accepte uniquement une variable qui est interprétée au moment de l'execute()
        $q->bindParam(":title", $title, PDO::PARAM_STR);
        $q->bindParam(":comment", $comment, PDO::PARAM_STR);

        // exexute return a boolean
        if(!$q->execute()) {
            die("form not sent to the db");
        }

        $id = $db->lastInsertId();

        die("comment added with id: $id");

    } else {
        die("form incomplete");
    }
}

    ?>
    <form method="post" action="">
        <div>
            <label for="title">Title :</label>
            <input type="text" name="title">
        </div>
        <div>
            <label for="comment">Comment</label>
            <input type="text" name="comment">
        </div>
        <button type="submit">Add comment</button>
    </form>



<?php
include "includes/footer.php";
?>