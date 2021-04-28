<?php 

// Allow the config
define('__CONFIG__', true);
// Require the config
require_once "inc/config.php";

if( isset($_GET["id"]) ){
  $drinkID = $_GET["id"];

  /* TODO: remove */
  /* $drink = new Drink($_GET["id"]);
  $drink->skrt();
 */

  
  $visibilityAddDrinkToFav = "hide";
  $isDrinkFavourited = "";

  if( isset($_SESSION['user_id']) ){
    $visibilityAddDrinkToFav = "";

    if ( User::checkIfDrinkIsFavourited( $_SESSION['user_id'] , $drinkID) ){
        $isDrinkFavourited = "red";
    }

  }

}else{
  header('Location: home.php');

}

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
    <title>Corona Blues - Drink Details</title>

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

  </head>

  <body id="root">
    <!-- NAVIGATION -->
    <div class="ui tablet computer only padded grid">
      <div class="ui container">
        <div class="ui inverted borderless huge menu">
          <a class="header item">Corona Blues</a>
          <a class="item">Home</a> 
          <a class="item" href="searchDrink.php">Search a Drink</a>
          <a class="item" href="searchByIngredient.php">Search by Ingredient</a>
          <a class="item <?=$visibilityFavouriteDrinksSite?>" href="favouriteDrinks.php">Favourite Drinks</a>

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
          <a class="item">Home</a> 
          <a class="item" href="searchDrink.php">Search a Drink</a>
          <a class="item" href="searchByIngredient.php">Search by Ingredient</a>
          <a class="item <?=$visibilityFavouriteDrinksSite?>" href="favouriteDrinks.php">Favourite Drinks</a>
  
          <?php require('inc/signInAndLogoutSection.php')?>
          
        </div>
      </div>
    </div>



    <!-- HEADER - DRINK IMAGE & NAME -->
    <div class="slide slideImageBackground"> 
      <div id="drinkImageHeader" class="ui inverted vertical center aligned segment ">
          <section class="ui text container">

            <!-- *** DRINK NAME *** -->
            <h1 id="drinkName" class="ui inverted header" style="padding:20px; background-color:black; color:white;"></h1>                             


          </section>
      </div>
    </div> 


    <!-- PAGE CONTENT -->
    <div class="ui container extended drinkDetailContent">
      

      <!-- CONTENT - INGREDIENTS & INSTRUCTIONS etc. -->
      <div class="ui center aligned grid marginTop30">
          
          <a id="AddOrRemoveFavourite" class="ui left aligned label <?=$visibilityAddDrinkToFav?>">
              <!-- <?= $isDrinkFavourited == "red" ? "Saved in Favourites" : "Save to Favourites" ?> -->
              <!-- Save to Favourites    -->
              <i id="heartIcon" class="large big heart icon <?=$isDrinkFavourited?>" style="margin:0;"></i>
          </a>

          <!-- SAVE TO FAVOURITE DRINKS MESSAGE BOX -->
          <div id="addToFavouritesMessage" class="ui message js-error" style="display:none; width:100%">Message</div>


          <h2 id="drinkIngredients"> </h2>
          
          <!-- <h2>Instructions</h2>  -->
          <p id="drinkInstructions" class="fontSize20 marginBottom100"> </p>



          <div class="ui divider width100perc"></div>

          <!-- SEARCH FOR ANOTHER DRINK BUTTON -->
          <a href="searchDrink.php" class="ui huge inverted green button marginTop30 marginBottom30">Search for another Drink</a>
          
          <!-- HIDDEN FIELD WITH DRINKID  -->
          <input type="hidden" id="drinkID" value="<?=$drinkID?>">

      </div>



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



    <script src="assets/js/cocktailDB.js"></script>
    <!-- TODO: why does it not work if saveDrinkToFavourites method is in searchDrink.js instead cocktailDB???-->
    <script src="assets/js/searchDrink.js"></script> 

    
    <script>
      $(document).ready(function() {
        
        $(".ui.toggle.button").click(function() {
          $(".mobile.only.grid .ui.vertical.menu").toggle(100);
        });

        $(".ui.dropdown").dropdown();


        drinkID = $('#drinkID').val();

        let obj = getDrinkObj(drinkID);

        console.log("OBJname: "+obj.name);
        //console.log("OBJimage: "+obj.image);
        //$('#drinkImageHeader').css({"backgroundImage":"url(\"https://www.thecocktaildb.com/images/media/drink/drtihp1606768397.jpg\") !important", "backgroundSize":"cover !important"});
        
        //$('#drinkImageHeader').css({'backgroundImage':'url("' + "https://www.thecocktaildb.com/images/media/drink/drtihp1606768397.jpg" + '") !important'});
        //$('#drinkImageHeader').css({"backgroundImage":"red !important"});
//        $('#drinkImageHeader').css({"backgroundColor":"red"});

        /* let url = "https://www.thecocktaildb.com/images/media/drink/drtihp1606768397.jpg";
        $('#drinkImageHeader').css({
            "background-image":'url("'+url+'")', 
            "background-size":'cover'}); */

        $('#AddOrRemoveFavourite').on('click', () => {

          event.preventDefault();

          saveDrinkToFavourites( $('#drinkID').val() )
        })

      });



    </script>
  </body>
</html>
