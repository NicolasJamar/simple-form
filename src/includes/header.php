<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic Models</title>
</head>
<body>

<header>
    <nav>
        <li><a href="./">Home</a></li>
        <li><a href="addcomment.php">Add comment</a></li>
        <?php if(!isset($_SESSION["user"])): ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="subscription.php">Subscription</a></li>
        <?php else: ?>
        <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>
    </nav>
</header>