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
    <title>Corona Blues - Search By Ingredient</title>

    <!-- Semantic UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="assets/css/main_styles.css">

    <style>
      .wrapper{
        background: rgba(0,0,0,0,3) url('https://www.thecocktaildb.com/images/media/drink/dztcv51598717861.jpg');
        background-size: cover;
        background-position: center;
        background-blend-mode: overlay;
        min-height: 100vh;
      }
      h1{
        color#fff;
        font-weight: 300;
        font-size: 98px;
        text-align:center;
      }

      .bg-music{
        position: absolute;
        top:64%;
        left:0;
        right:0;
        margin:0 auto;
        z-index:99;
      }
      .btn{
        background-color: transparent;
        color:#fff;
        font-size:78px;
        border: none !important;
        display: block;
        margin: 0 auto;
        opacity: 3;
        transition: all linear .2s;
      }
      .btn:focus {
        outline:0;
      }
      .btn:hover{
        opacity: 1;
      }

      .fa-pause-circle{
          display: none;
      }

      .imgHoverEffect{
        -webkit-filter: brightness(80%);
        -webkit-transition: all 1s ease;
        -moz-transition: all 1s ease;
        -o-transition: all 1s ease;
        -ms-transition: all 1s ease;
        transition: all 1s ease;
      }

      .imgHoverEffect:hover {
        -webkit-filter: brightness(100%);
      }

    </style>
  </head>

  <body id="root">

    <!-- NAVIGATION -->
    <div class="ui tablet computer only padded grid">
      <div class="ui container">
        <div class="ui inverted borderless huge menu">
          <a class="header item" href="home.php">Corona Blues</a>
          <a class="item" href="home.php">Home</a> 
          <a class="item" href="searchDrink.php">Search a Drink</a>
          <a class="active item" href="searchByIngredient.php">Search by Ingredient</a>
          <a class="item <?=$visibilityFavouriteDrinksSite?>" href="favouriteDrinks.php">Favourite Drinks</a>

          
          <!-- Show SignUp & Login buttons OR Logout - depending if the User is logged in or not --> 
          <?php require('inc/signInAndLogoutSection.php')?>


        </div>
      </div>
    </div>

    
    <!-- NAVIGATION MOBILE VERSION -->
    <div class="ui mobile only grid">
      <div class="ui top fixed inverted borderless huge menu">
        <a class="header item" href="home.php">Corona Blues</a>
        <div class="right menu">
          <div class="item">
            <button class="ui icon toggle basic inverted button">
              <i class="content icon"></i>
            </button>
          </div>
        </div>
        <div class="ui vertical borderless inverted fluid menu">
          <a class="item" href="home.php">Home</a> 
          <a class="item" href="searchDrink.php">Search a Drink</a>
          <a class="active item" href="searchByIngredient.php">Search by Ingredient</a>
          <a class="item <?=$visibilityFavouriteDrinksSite?>" href="favouriteDrinks.php">Favourite Drinks</a>

          
          <!-- Show SignUp & Login buttons OR Logout - depending if the User is logged in or not --> 
          <?php require('inc/signInAndLogoutSection.php')?>
        
        </div>
      </div>
    </div>




    <div class="slide"> 
      <div class="ui inverted vertical center aligned segment searchDrinkHeader">
          <section class="ui text container">

            <!-- *** SEARCH *** -->
            <h1 class="ui inverted header" style="color: #FF1493; text-shadow: 1px 1px 5px black;"> <!-- TODO:remove inline style -->
              Search by Ingredient
            </h1>                             

            <!-- SEARCH -->
            <form class="margin20sides"> <!-- TODO? <form method="GET" action="searchDrink.php" class="margin20sides"> -->

              <!-- DRINK SEARCH -->
              <div class="ui search marginTop50">
                <div class="ui fluid icon input">
                  <input id="drinkSearchByIngredient" type="text" name="drinkSearch" placeholder="Type in Ingredient... e.g. Vodka">
                  <i class="search icon"></i>
                </div>
              </div>

              <!-- SEARCH BUTTON -->
              <button id="ingredientSearchSubmit" type="submit" class="ui huge pink button marginTop30 marginBottom30">Search</button>
              

              <!-- MUSIC FEATURE
               - because it's fun and why not listening to some music while search for a drink.. :) -->
              <div class="wrapper">
                <h4>Want some music?</h4>
              </div>

              <div class="bg-music" style="margin-top:80px">
                  <audio id="music" src="assets/music/myCupRunnethOver.wav" loop=""></audio>
                  <button class="btn" id="musicButtonIngredientPage">
                    <i class="fas fa-play-circle"></i>
                    <i class="fas fa-pause-circle"></i>
                  </button>
              </div>

            </form>

          </section>
      </div>
    </div> 






    <div class="ui container extended">
      

      <div id="resultIngredientSearch" class="ui vertical segment link cards">
        <h2>Nothing to show here. Use the search above Dude.. Are you drunk already?</h2>


      </div>



      <!-- FOOTER -->
      <?php require_once "inc/footer.php" ?>


    </div>
    
 
    <!-- JS Scripts linking (Libraries and JS files) -->
    <?php require_once "inc/js_scripts_footer.php" ?>

    <script src="assets/js/searchDrink.js"></script>

    
    <script>
      $(document).ready(function() {
        $(".ui.toggle.button").click(function() {
          $(".mobile.only.grid .ui.vertical.menu").toggle(100);
        });


        $(".fa-play-circle").on('click', () => {
          event.preventDefault();

          $(".fa-play-circle").hide();
          //$(".fa-pause-circle").removeClass("hide");
          $(".fa-pause-circle").fadeIn();
          $("#music")[0].play();
        });

        $(".btn .fa-pause-circle").on('click', () => {
          event.preventDefault();

          $(".fa-pause-circle").hide();
          //(this).addClass("hide");
          $(".fa-play-circle").fadeIn();
          $("#music")[0].pause();
        });

      });


    </script>
  </body>
</html>
