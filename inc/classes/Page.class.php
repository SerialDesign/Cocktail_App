<?php

// If there is no constant defined called __CONFIG__, do not load this file 
if(!defined('__CONFIG__')) {
	exit('You do not have a config file');
}

// Page Functions
class Page {

	// Force the user to be logged in or redirect
	static function forceLogin(){
		if( isset($_SESSION['user_id']) ){
			// The user is allwoed here
		
		}else{
			// The user is not allowed here
			header("Location: login.php"); exit;
		}
	}

	// Force the user to the dashboard if he is already logged in
	static function forceDashboard(){
		if( isset($_SESSION['user_id']) ){
			// The user is allowed here but redirect anyways
			header("Location: dashboard.php"); exit;

		}else{
			// The user is not allowed here
		}
	}

}

?>