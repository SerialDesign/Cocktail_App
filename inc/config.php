<?php 

// If there is no constant defined calld __CONFIG__, do ot load this file
if(!defined('__CONFIG__')){
    exit('You do not have a confi file');

    // TODO: redirect here for Productin deploy
}

// Sessions are always turned on
if(!isset($_SESSION)){
    session_start();
}

// Our config is below
// Allow errors
error_reporting(-1);
ini_set('display_errors', 'On');

// Include the DB php files
include_once "classes/db.class.php";
include_once "classes/Filter.class.php";
include_once "classes/Page.class.php";
include_once "classes/User.class.php";
include_once "functions.php";

$con = DB::getConnection();

?>