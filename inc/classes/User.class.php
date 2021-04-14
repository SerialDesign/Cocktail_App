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

}

?>