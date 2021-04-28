<?php

// Allow the config
define('__CONFIG__', true);
// Require the config
require_once "inc/config.php";

// checks if user is logged in by checking if user_id is in actual session
Page::forceLogin();

// if Visitor passed forceLogin method above, user_id is set, so it can be passed as parameter
// to get all favourite drinks of user out of DB
$allFavouriteDrinksOfUser = User::getFavouriteDrinksOfUser( $_SESSION['user_id'] );

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
    <title>Corona Blues - Favourite Drinks</title>

    <!-- Semantic UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" />

<!--     <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"
      type="text/css"
    /> -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
    />


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

      /* .hide{
          display: none !important;
      } */

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
          <a class="header item">Corona Blues</a>
          <a class="item" href="home.php">Home</a> 
          <a class="item" href="searchDrink.php">Search a Drink</a>
          <a class="item" href="searchByIngredient.php">Search by Ingredient</a>
          <a class="active item" href="favouriteDrinks.php">Favourite Drinks</a>

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
          <a class="item" href="home.php">Home</a> 
          <a class="item" href="searchDrink.php">Search a Drink</a>
          <a class="item" href="searchByIngredient.php">Search by Ingredient</a>
          <a class="active item" href="favouriteDrinks.php">Favourite Drinks</a>

          <!-- Show SignUp & Login buttons OR Logout - depending if the User is logged in or not --> 
          <?php require('inc/signInAndLogoutSection.php')?>
        
        </div>
      </div>
    </div>




    <div class="slide"> <!-- slideImageBackground -->
      <div class="ui inverted vertical center aligned segment searchDrinkHeader">
          <section class="ui text container">

            <!-- *** SEARCH *** -->
            <h1 class="ui inverted header" style="color: #FF1493; text-shadow: 1px 1px 5px black;"> <!-- TODO:remove inline style -->
              Your Favourite Drinks
            </h1>                             

            <!-- SEARCH -->
            <form class="margin20sides"> <!-- TODO? <form method="GET" action="searchDrink.php" class="margin20sides"> -->



            </form>

          </section>
      </div>
    </div> 






    <div class="ui container extended">
      

      <!-- <div id="resultIngredientSearch" class="ui vertical segment link cards"> -->
        <?php
            if( $allFavouriteDrinksOfUser != null ){

              echo "<div id=\"allFavouriteDrinksCards\" class=\"ui vertical segment link cards\"></div>";
        
              //print_r($allFavouriteDrinksOfUser);
              /* HIDDEN FIELD WITH All favourite DRINKIDs   
              echo "<input type=\"hidden\" id=\"allFavDrinkIDs\" value=\"" + $allFavouriteDrinksOfUser +"\">";
              */

              // iterating through each favourite drinks and print out each drink as a card 
              /* foreach( $allFavouriteDrinksOfUser as $favouriteDrink  ){

                echo "<div class=\"card\">
                    <div class=\"content\">
                    <div class=\"header\">";
                echo $favouriteDrink['drink_id'];
                echo "</div> </div>";
              } */

            }else{
              echo "<br><h2>Nothing to show here. You have no favourite Drinks yet. <br><br>Click the heart icon on the drink detail page to save as a favourite.</h2><hr>";
            }
        ?>

        

      <!-- </div> -->

      

      <!-- FOOTER -->
      <footer class="ui vertical segment">
        <div class="ui two column grid">
          <div class="column">
            &copy; 2021 SupportDrinking Company, Inc. · <a href="#root">Privacy</a> ·
            <a href="#root">Terms</a>
          </div>
          <div class="right aligned column">
            <a href="#root">Back to top</a>
          </div>
        </div>
      </footer>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>


    <script src="assets/js/searchDrink.js"></script>

    
    <script>
      $(document).ready(function() {
        $(".ui.toggle.button").click(function() {
          $(".mobile.only.grid .ui.vertical.menu").toggle(100);
        });

        $(".ui.dropdown").dropdown();

        //getFavouriteDrinks('skrt');

        let allFavouriteDrinks = <?php echo json_encode($allFavouriteDrinksOfUser); ?>;
        getFavouriteDrinks(allFavouriteDrinks);
        //alert('test: '+allFavs);
        //alert(allFavs.length);

      });


    </script>
  </body>
</html>
