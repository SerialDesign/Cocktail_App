<?php 

// Allow the config
define('__CONFIG__', true);
// Require the config
require_once "../inc/config.php";

//make sure this site was accessed over an AJAX call. otherwise the user could simply go to this site over the URL
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Always return JSON Format
    header('Content-Type: application/json');

    $return = []; //$array = ['Test', 'Test2', 'Test3', array('name' => 'Cyrill', 'lastname' => 'Wyrsch')];
    
    $userID = $_SESSION['user_id'];
    $drinkID = $_POST['drinkID']; 


    if( User::checkIfDrinkIsFavourited($userID, $drinkID) ){
        // Remove from favourites (If it was already favourited)
        $removeDrinkFromFavourites = User::deleteDrinkFromFavourites($userID, $drinkID);

        if($removeDrinkFromFavourites){
            $return['successRemovedFav'] = "Removed Drink from Favourites";
    
        }else{
            $return['error'] = "Something went wrong"; 
        }

    }else{
        // Add to Favourites (If it was NOT favourited = add as favourite)
        $insertDrinkToFavourites = User::saveDrinkToFavourites($userID, $drinkID);

        if($insertDrinkToFavourites){
            $return['success'] = "Successfully added Drink to Favourites";

        }else{
            $return['error'] = "Fuck.. didn't work";
        }
    }
    
    /* OLD Version:
    $insertDrinkToFavourites = User::saveDrinkToFavourites($userID, $drinkID);

    if($insertDrinkToFavourites){
        $return['success'] = "Successfully added Drink to Favourites";

    }else{
        $return['error'] = "Fuck.. didn't work";
    } */

    echo json_encode($return, JSON_PRETTY_PRINT); exit;
    
}else{
    //Die. Kill the scrip. Redirect the user. Do something regardless.
   
    //exit('Site not called over AJAX');
    header('Location: ../home.php');
}

?>
