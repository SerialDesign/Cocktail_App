<?php

// If there is no constant defined called __CONFIG__, do not load this file 
if(!defined('__CONFIG__')) {
	exit('You do not have a config file');
}

//Singleton class = CONNECTION IS OBLY OPENED ONCE AND THEN ALWAYS RETURNING THE SAME ONE.
class User {

	private $con;

	public $user_id;
	public $email;
	public $reg_time;

	public function __construct(int $user_id){
		$this->con = DB::getConnection();

		$user_id = Filter::Int( $user_id );

		$user = $this->con->prepare("SELECT user_id, email, reg_time FROM user WHERE user_id = :user_id LIMIT 1");
		$user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$user->execute();

		if($user->rowCount() == 1){
			$user = $user->fetch(PDO::FETCH_OBJ);

			$this->email   			= (string) $user->email;
			$this->user_id 			= (int) $user->user_id;
			$this->reg_time 		= (string) $user->reg_time;

		}else{
			//No user
			// Redirect to logout
			header("Location: logout.php");
		}
	}


	/*** Searches for User via email ***/ 
	// can be called bi User::Find() - because its a static function
	public static function Find($email, $return_assoc = false){
		
		$con =  DB::getConnection(); //gets db connection from static function of singleton DB class

		// Make sure the user does not exist
		$email = (string) FILTER::String( $email );
	
		$findUser = $con->prepare("SELECT user_id, password FROM USER WHERE email = LOWER(:email) LIMIT 1");
		$findUser->bindParam(':email', $email, PDO::PARAM_STR);
		$findUser->execute();
	
		// if return assoc variable is set to true it returns the whole assoc array
		if($return_assoc){
			return $findUser->fetch(PDO::FETCH_ASSOC);
		}
	
		$user_found = (boolean) $findUser->rowCount(); //1 in boolean is true and 0 in boolean is false
		return $user_found;
	
		/* OR, easier to understand but more code version
		if($findUser->rowCount() == 1){
			return true;
		}
	
		return false; */
	}



	/*** Saves a drink as a Favourite of a user ***/
	// can be called bi User::saveDrinkToFavourites() - because its a static function
	public static function saveDrinkToFavourites($user_id, $drink_id){
	
		$con =  DB::getConnection(); //gets db connection from static function of singleton DB class
	
		/* Ausgelagert in eigene Methode:
		$checkIfEntryExist = $con->prepare("SELECT * from user_list_of_drinks where drink_id = :drink_id AND user_fk = :user_id");
		$checkIfEntryExist->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$checkIfEntryExist->bindParam(':drink_id', $drink_id, PDO::PARAM_INT);		
		$checkIfEntryExist->execute();*/

		if( !User::checkIfDrinkIsFavourited($user_id, $drink_id) ){
			//$insertFavDrink = $con->prepare("SELECT user_id, password FROM USER WHERE email = LOWER(:email) LIMIT 1");
			$insertFavDrink = $con->prepare("INSERT INTO user_list_of_drinks (drink_id, user_fk) VALUES (:drink_id, :user_id)  ");
			$insertFavDrink->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$insertFavDrink->bindParam(':drink_id', $drink_id, PDO::PARAM_INT);
			$insertFavDrink->execute();
		
			//echo "insert: "+$insertFavDrink;
		
			//$user_found = (boolean) $findUser->rowCount(); //1 in boolean is true and 0 in boolean is false
			return $insertFavDrink;
		}
	}

	
	/*** Deletes a drink from Favourites of a user ***/
	// can be called bi User::Find() - because its a static function
	public static function deleteDrinkFromFavourites($user_id, $drink_id){

		$con =  DB::getConnection(); //gets db connection from static function of singleton DB class

		if( User::checkIfDrinkIsFavourited($user_id, $drink_id) ){
			//$insertFavDrink = $con->prepare("SELECT user_id, password FROM USER WHERE email = LOWER(:email) LIMIT 1");
			$deleteFavDrink = $con->prepare("DELETE FROM user_list_of_drinks where drink_id = :drink_id AND user_fk = :user_id");
			$deleteFavDrink->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$deleteFavDrink->bindParam(':drink_id', $drink_id, PDO::PARAM_INT);
			$deleteFavDrink->execute();
			
			return $deleteFavDrink;
		}
	}


	/* 
	Returns true if user has certain drink as a favourite
	Returns false if user DOES NOT have certain drink as a favourite */
	public static function checkIfDrinkIsFavourited($user_id, $drink_id){
		$con =  DB::getConnection(); //gets db connection from static function of singleton DB class
	
		$checkIfEntryExist = $con->prepare("SELECT * from user_list_of_drinks where drink_id = :drink_id AND user_fk = :user_id");
		$checkIfEntryExist->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$checkIfEntryExist->bindParam(':drink_id', $drink_id, PDO::PARAM_INT);		
		$checkIfEntryExist->execute();

		if( $checkIfEntryExist->rowCount() == 0){
			return false;
		}else{
			return true;
		}
	}

	/*** Returns all favourite drinks of a user ***/
	public static function getFavouriteDrinksOfUser($user_id){
		$con =  DB::getConnection(); //gets db connection from static function of singleton DB class
	
		$favouriteDrinksOfUser = $con->prepare("SELECT drink_id from user_list_of_drinks where user_fk = :user_id");
		$favouriteDrinksOfUser->bindParam(':user_id', $user_id, PDO::PARAM_INT);	
		$favouriteDrinksOfUser->execute();

		if( $favouriteDrinksOfUser->rowCount() > 0){
			return $favouriteDrinksOfUser->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return null;
		}
	}
}
?>