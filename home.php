<?php

// Allow the config
define('__CONFIG__', true);
// Require the config
require_once "inc/config.php";

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=no"
    />
    <meta
      name="description"
      content="Semantic-UI-Forest, collection of design, themes and templates for Semantic-UI."
    />
    <meta name="keywords" content="Semantic-UI, Theme, Design, Template" />
    <meta name="author" content="PPType" />
    <meta name="theme-color" content="#ffffff" />
    <title>Corona Blues - HOME</title>

    <!-- Semantic UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>

    <link rel="stylesheet" href="assets/css/main_styles.css">

  </head>

  <body id="root">
    
    <!-- NAVIGATION -->
    <div class="ui tablet computer only padded grid">
      <div class="ui container">
        <div class="ui inverted borderless huge menu">
          <a class="header item">Corona Blues</a>
          <a class="active item">Home</a> 
          <a class="item" href="searchDrink.php">Search a Drink</a>
          <a class="item" href="searchByIngredient.php">Search by Ingredient</a>
          <a class="item <?=$visibilityFavouriteDrinksSite?>" href="favouriteDrinks.php">Favourite Drinks</a>

          <!-- Show SignUp & Login buttons OR Logout - depending if the User is logged in or not --> 
          <?php require('inc/signInAndLogoutSection.php')?>

        </div>
      </div>
    </div>


    
    <!-- NAVIGATION MOBILE VERSION -->
    <div class="ui mobile only grid">
      <div class="ui top fixed inverted borderless huge menu">
        <a class="header item">Corona Blues</a>
        <div class="right menu">
          <div class="item">
            <button class="ui icon toggle basic inverted button">
              <i class="content icon"></i>
            </button>
          </div>
        </div>
        <div class="ui vertical borderless inverted fluid menu">
          <a class="active item">Home</a> 
          <a class="item" href="searchDrink.php">Search a Drink</a>
          <a class="item" href="searchByIngredient.php">Search by Ingredient</a>
          <a class="item <?=$visibilityFavouriteDrinksSite?>" href="favouriteDrinks.php">Favourite Drinks</a>


          <!-- Show SignUp & Login buttons OR Logout - depending if the User is logged in or not --> 
          <?php require('inc/signInAndLogoutSection.php')?>
          
        </div>
      </div>
    </div>


    <div class="slide"> <!-- slideImageBackground -->
      <div class="ui inverted vertical center aligned segment">
        <div class="ui active text container">
          <h1 class="ui inverted header">Got the Corona Blues?</h1>
          <p>
            Drink some cocktails.. and you will be just fine! 
            <!-- Note: If you're viewing this page via a <code>file://</code> URL,
            the "next" and "previous" Glyphicon buttons on the left and right
            might not load/display properly due to web browser security rules. -->
          </p>
          <a class="ui huge primary button" href="register.php" >Sign up today</a>
        </div>
      </div>

      
      <div class="ui inverted vertical center aligned segment">
        <div class="ui active text container">
          <h1 class="ui inverted header">Search our Library for drinks</h1>
          <p>
            Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec
            id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
            ultricies vehicula ut id elit.
          </p>
          <a class="ui huge primary button" href="searchDrink.php">Search a Drink</a>
        </div>
      </div>


      <div class="ui inverted vertical center aligned segment">
        <div class="ui active text container">
          <h1 class="ui inverted header">Save Drinks to Favourites</h1>
          <p>
            If you have an Account, you can save Drinks to your Favourite list and visit them anytime. If you do not have an account, simply click on Sign Up and create one. :)
          </p>
          <a class="ui huge primary button" href="favouriteDrinks.php">Learn more</a>
        </div>
      </div>


    </div>


    <div class="ui container">
      <div class="ui vertical segment">
        <div class="ui three column stackable center aligned grid container">
          <div class="column">
            <img
              class="ui centered small circular image"
              src="https://www.thecocktaildb.com/images/media/drink/lijtw51551455287.jpg"
            /><!-- drinkID = "12754" -->
            <h1 class="ui header">Get Drunk today!</h1>
            <p>
              It's Corona Time! What else can you do instead of getting drunk ;P..
              euismod. Nullam id dolor id nibh ultricies vehicula ut id elit.
              Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
              Praesent commodo cursus magna.
            </p>
            <div class="ui basic button">View details &raquo;</div>
          </div>
          <div class="column">
            <img
              class="ui centered small circular image"
              src="https://www.thecocktaildb.com/images/media/drink/km6se51484411608.jpg"
            /> <!-- https://www.thecocktaildb.com/images/media/drink/xsqsxw1441553580.jpg -->
            <h1 class="ui header">Skrt Skrt</h1>
            <p>
              Donec sed odio dui. Etiam porta sem malesuada magna mollis
              euismod. Nullam id dolor id nibh ultricies vehicula ut id elit.
              Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
              Praesent commodo cursus magna.
            </p>
            <div class="ui basic button">View details &raquo;</div>
          </div>
          <div class="column">
            <img
              class="ui centered small circular image"
              src="https://www.thecocktaildb.com/images/media/drink/zvoics1504885926.jpg"
            /> 
            <h1 class="ui header">Don't drink and drive</h1>
            <p>
              We also have non-alcoholic Drinks! :)  malesuada magna mollis
              euismod. Nullam id dolor id nibh ultricies vehicula ut id elit.
              Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
              Praesent commodo cursus magna.
            </p>
            <div class="ui basic button">View details &raquo;</div>
          </div>
        </div>
      </div>



      <!-- RANDOM DRINK FEATURE -->
      <div class="ui vertical segment">
        <div class="ui stackable grid">
          <div class="ten wide column">
            <h1 class="ui header">
              Random Drink
              <span class="sub">out of our library.</span>
            </h1>
            <p>
              Check out this Random generated Drink for you! If you are interested, click on Ingredients or Instructions to see more information. Or just click the button to get another random Drink. Enjoy our selection!
            </p>

            <button id="generateRandomDrink" class="ui button">Get another random Drink</button>

          </div>


          <div class="six wide column">
            
            <!-- RANDOM DRINK CARD -->
            <div class="ui card margin20">
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
            
            <!-- <div id="messageBox"></div> -->

            <!-- HIDDEN FIELD WITH DRINKID - for further requests -->
            <input type="hidden" id="drinkID">


          </div>

        </div>
      </div>




      <div class="ui vertical segment">
        <div class="ui stackable grid">
          <div class="six wide column">
            <img
              class="ui image"
              src="./assets/images/girl_mixing_drink.jpg"
            /> <!-- wireframe ./assets/images/wireframe/square-image.png -->
          </div>
          <div class="ten wide column">
            <h1 class="ui header">
              Oh yeah, <span class="sub">it's that good.</span>
            </h1>
            <p>
              I know she is HOT! Not as hot as our Drinks though.. but close. 
              Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna,
              vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus
              commodo.
            </p>
          </div>
        </div>
      </div>
      <div class="ui vertical segment">
        <div class="ui stackable grid">
          <div class="ten wide column">
            <h1 class="ui header">
              And lastly, <span class="sub">this one.</span>
            </h1>
            <p>
              She even flirts with you. Especially if you buy a Drink. Vestibulum id
              ligula porta felis euismod semper. Praesent commodo cursus magna,
              vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus
              commodo.
            </p>
          </div>
          <div class="six wide right aligned column">
            <img
              class="ui image"
              src="assets/images/shaking_girl.jpg"
            />
          </div>
        </div>
      </div>


      <!-- FOOTER -->
      <?php require_once "inc/footer.php" ?>


    </div>
    
 
    <!-- JS Scripts linking (Libraries and JS files) -->
    <?php require_once "inc/js_scripts_footer.php" ?>

    <!-- Slick Carousel - only used on this site -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

    <script src="assets/js/randomDrink.js"></script>


    <script>
      $(document).ready(function() {
        $(".ui.toggle.button").click(function() {
          $(".mobile.only.grid .ui.vertical.menu").toggle(100);
        });

        $(".ui.dropdown").dropdown();

        $(".slide").slick({
          autoplay: true,
          dots: true,
          speed: 500
        });
      });

      // gets random Drink (Feature found in the middle of HOME site)
      // and makes a card with buttons for ingredients and instructions to mix
      getRandomDrink();
        
    </script>
  </body>
</html>
