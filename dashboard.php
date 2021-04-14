<?php 

// Allow the config
define('__CONFIG__', true);
// Require the config
require_once "inc/config.php";

Page::forceLogin();

$user_id = $_SESSION['user_id'];

$User = new User($_SESSION['user_id']);

/* Below = Before converting everything into the class (User.class.php file)

forceLogin(); //in functions.php file - new in Page Class

$getUserInfo = $con->prepare("SELECT email, reg_time FROM user WHERE user_id = :user_id LIMIT 1");
$getUserInfo->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$getUserInfo->execute();

if($getUserInfo->rowCount() == 1){
    // User was found
    $User = $getUserInfo->fetch(PDO::FETCH_ASSOC);

}else{
    // User is not signed in -> maybe the user was deleted in the meantime, doublechecks if the user is still in the db and not only in the session
    header("Location: logout.php"); exit;
} */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.19/dist/css/uikit.min.css" />
</head>
<body>
    
    <div class="uk-section uk-container">
        <h2>Dashboard</h2>
        <p>Hello <?php echo $User->email; ?>, you registered at <?php echo $User->reg_time; ?></p>
        <p>
            <a href="logout.php">Logout</a>
        </p>
    </div>


    <?php require_once "inc/footer.php" ?>

</body>
</html>