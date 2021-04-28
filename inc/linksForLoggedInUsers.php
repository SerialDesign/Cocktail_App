<?php

//Note: SignUp, Login & Logout button visibility is in a seperate file 'signInAndLogoutSection' (because it does not fit in there out of the context)


// only if the user is logged in = user_id is set in the session
// Favourite Drink Link to site is visible - if not logged in, link will not be displayed
$visibilityFavouriteDrinksSite = "hide";

if( isset($_SESSION['user_id']) ){
  $visibilityFavouriteDrinksSite = "";
}


?>