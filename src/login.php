<?php

// open the $_SESSION
session_start();

if(!empty($_POST)) {
    // 1. Check all the inputs exist
    // 2. We check also if the $_POST are not empty because we load the page, the form is empty
    if(isset($_POST["login"],$_POST["pass"])
        && !empty($_POST["login"]) && !empty($_POST["pass"])) {

        $login = strip_tags($_POST["login"]);

        //SQL part
        require_once "connexion.php";
        $q = $db->prepare("SELECT * FROM users WHERE login=:login");

        // bindParam() accepte uniquement une variable qui est interprétée au moment de l'execute()
        $q->bindParam(":login", $login, PDO::PARAM_STR);

        // exexute return a boolean
        if(!$q->execute()) {
            die("form not sent to the db");
        }

        $user = $q->fetch(PDO::FETCH_ASSOC);

        if(!$user) {
            die("user doesn't exist &/or password incorrect");
        }

        // check the password input with the password in db
        if(!password_verify($_POST["pass"], $user["password"])){
            die("user doesn't exist &/or password incorrect");
        }


        // store data of user in $_SESSION
        $_SESSION["user"] = [
            "id" => $user["id"],
            "login" => $user["login"],
            "email" => $user["email"]
        ];

        header("location: index.php");

    }
}

include "includes/header.php";

?>

    <h1>User Login</h1>

    <form method="post" action="">
        <div>
            <label for="login">Login :</label>
            <input type="text" name="login">
        </div>
        <div>
            <label for="pass">Password</label>
            <input type="text" name="pass">
        </div>
        <button type="submit">Login</button>
    </form>



<?php
include "includes/footer.php";
?>