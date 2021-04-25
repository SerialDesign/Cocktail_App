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
    <title>Dashboard</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.19/dist/css/uikit.min.css" />
    
    <!-- Semantic UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" />

</head>
<body>
    
    <div class="uk-section uk-container">
        <h2>Dashboard</h2>
        <p>Hello <?php echo $User->email; ?>, you registered at <?php echo $User->reg_time; ?></p>
        <p>
            <a href="logout.php">Logout</a>
        </p>
    </div>

    <div style="width: 300px;">
        <h1 style="margin:50px;">Drink Inspiration</h1>
        <div class="ui card">
            <a class="image" href="#">
                <img id="randomDrinkImg" src="" alt="">
            </a>
            
            <div class="content">
                <a class="header" href="#">
                    <h3 id="randomDrink"></h3>
                </a>
                <div class="meta">
                    <h4 id="randomDrinkIngredients" class="ingredients" style="display:none;"></h4>
                    <p id="randomDrinkDetailText"></p>
                    </div>
            </div>
        
            <!-- <button id="loveRandomDrink" class="ui button">Love</button> -->
            <div class="extra content">
                <div class="ui compact menu">
                
                    <a id="drinkIngredients" class="item">
                        <i class="glass martini icon"></i> Ingredients
                        <!-- <div class="floating ui teal label">22</div> -->
                    </a>
                    <a id="drinkInstructions" class="item">
                        <i class="hand point right icon"></i> Instructions
                        <!-- <div class="floating ui teal label">22</div> -->
                    </a>
                    
                </div>
            </div>
        </div>
        <hr>
        
        <button id="generateRandomDrink" class="ui button">Get another random Drink</button>

        <div id="messageBox"></div>

        <!-- HIDDEN FIELD WITH DRINKID - for further requests -->
        <input type="hidden" id="drinkID">

    </div>


    
    <!-- <h1 style="margin:50px;">Drinks</h1>
    <div class="games"></div>


    <div class="ui container">
        <div class="ui fluid search selection dropdown">
                <input type="hidden" name="country">
                <i class="dropdown icon"></i>
                <div class="default text">Select a Drink</div>
                <div class="menu">
                                     
                    <div class="item" data-value="ax"><i class="ax flag"></i>Aland Islands</div>
                    <div class="item" data-value="al"><i class="al flag"></i>Albania</div>
                    
            </div>
        </div>
    </div>

    <div class="amiibos"></div>

    <div class="ui container">
        <div class="ui link cards" style="margin:50px;">
        </div>
    </div>
 -->

    <?php require_once "inc/footer.php" ?>

    <script>
        
        getRandomDrink();
        
    </script>

</body>
</html>