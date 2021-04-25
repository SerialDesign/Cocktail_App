<?php

// Allow the config
define('__CONFIG__', true);
// Require the config
require_once "inc/config.php";

$loginAndSignUpVisibility = '';  //used to hide login / Signup buttons if user IS LOGGED IN.
$logoutVisibility = ''; //used to hide logout button if user is NOT LOGGED IN. 

if( isset($_SESSION['user_id']) ){ //&& $_SESSION['user_id'] > 0

    $loginAndSignUpVisibility = "hide"; //hide login / signup button
    
}else{
    $logoutVisibility = "hide"; //hide logout button
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
    <title>Corona Blues</title>

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

    <link rel="stylesheet" href="assets/css/main_styles.css">

  </head>

  <body id="root">
    <div class="ui tablet computer only padded grid">
      <div class="ui container">
        <div class="ui inverted borderless huge menu">
          <a class="header item">Corona Blues</a>
          <a class="active item">Home</a> 
          <a class="item" href="searchDrink.php">Search a Drink</a>
          <a class="item">About</a>
          <div class="ui dropdown item">
            Dropdown <i class="dropdown icon"></i>
            <div class="menu">
              <a class="item"> Action </a> <a class="item"> Another action </a>
              <a class="item"> Something else here </a>
              <div class="ui divider"></div>
              <div class="header">Navbar header</div>
              <a class="item"> Seperated link </a>
              <a class="item"> One more seperated link </a>
            </div>
          </div>

          <a class="item <?=$loginAndSignUpVisibility?>" href="register.php">Sign Up</a>
          <a class="item <?=$loginAndSignUpVisibility?>" href="login.php">Log In</a>
          <a class="item <?=$logoutVisibility?>" href="logout.php">Logout</a>

          <!-- <div class="item right aligned" style="z-index:99;">
            <a href="register.php">Sign Up</a>
            <a href="login.php">Log In</a>
          </div> -->


        </div>
      </div>
    </div>
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
          <a class="item">About</a>
          <div class="ui dropdown item">
            Dropdown <i class="dropdown icon"></i>
            <div class="menu">
              <a class="item"> Action </a> <a class="item"> Another action </a>
              <a class="item"> Something else here </a>
              <div class="ui divider"></div>
              <div class="header">Navbar header</div>
              <a class="item"> Seperated link </a>
              <a class="item"> One more seperated link </a>
            </div>
          </div>

          <a class="item <?=$loginAndSignUpVisibility?>" href="register.php">Sign Up</a>
          <a class="item <?=$loginAndSignUpVisibility?>" href="login.php">Log In</a>
          <a class="item <?=$logoutVisibility?>" href="logout.php">Logout</a>
          
        </div>
      </div>
    </div>
    <div class="slide"> <!-- slideImageBackground -->
      <div class="ui inverted vertical center aligned segment">
        <div class="ui active text container">
          <h1 class="ui inverted header">Headline.</h1>
          <p>
            bla bla bla
            <!-- Note: If you're viewing this page via a <code>file://</code> URL,
            the "next" and "previous" Glyphicon buttons on the left and right
            might not load/display properly due to web browser security rules. -->
          </p>
          <a class="ui huge primary button" href="register.php" >Sign up today</a>
        </div>
      </div>
      <div class="ui inverted vertical center aligned segment">
        <div class="ui active text container">
          <h1 class="ui inverted header">Another example headline.</h1>
          <p>
            Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec
            id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
            ultricies vehicula ut id elit.
          </p>
          <div class="ui huge primary button">Learn more</div>
        </div>
      </div>
      <div class="ui inverted vertical center aligned segment">
        <div class="ui active text container">
          <h1 class="ui inverted header">One more for good measure</h1>
          <p>
            Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec
            id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
            ultricies vehicula ut id elit.
          </p>
          <div class="ui huge primary button">Browse gallery</div>
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
              src="https://www.thecocktaildb.com/images/media/drink/km6se51484411608.jpg"
            /> <!-- https://www.thecocktaildb.com/images/media/drink/xsqsxw1441553580.jpg -->
            <h1 class="ui header">Heading</h1>
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
            /> <!-- wireframe ./assets/images/wireframe/square-image.png -->
            <h1 class="ui header">Heading</h1>
            <p>
              Donec sed odio dui. Etiam porta sem malesuada magna mollis
              euismod. Nullam id dolor id nibh ultricies vehicula ut id elit.
              Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
              Praesent commodo cursus magna.
            </p>
            <div class="ui basic button">View details &raquo;</div>
          </div>
        </div>
      </div>
      <div class="ui vertical segment">
        <div class="ui stackable grid">
          <div class="ten wide column">
            <h1 class="ui header">
              First featurette heading.
              <span class="sub">It'll blow your mind.</span>
            </h1>
            <p>
              Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id
              ligula porta felis euismod semper. Praesent commodo cursus magna,
              vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus
              commodo.
            </p>
          </div>
          <div class="six wide right aligned column">
            <img
              class="ui image"
              src="./assets/images/wireframe/square-image.png"
            />
          </div>
        </div>
      </div>
      <div class="ui vertical segment">
        <div class="ui stackable grid">
          <div class="six wide column">
            <img
              class="ui image"
              src="./assets/images/wireframe/square-image.png"
            />
          </div>
          <div class="ten wide column">
            <h1 class="ui header">
              Oh yeah, <span class="sub">it's that good.</span>
            </h1>
            <p>
              Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id
              ligula porta felis euismod semper. Praesent commodo cursus magna,
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
              Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id
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
    </script>
  </body>
</html>
