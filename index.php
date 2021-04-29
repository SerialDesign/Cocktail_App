<?php 

// Allow the config
define('__CONFIG__', true);
// Require the config
require_once "inc/config.php";

/* REDIRECTS TO home.php - used if deployed to a server later on :) */
header('Location: home.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
</head>
<body>


    <?php require_once "inc/js_scripts_footer.php" ?>

</body>
</html>