<?php

session_start();

// delete session variable
unset($_SESSION["user"]);

header("location: index.php");