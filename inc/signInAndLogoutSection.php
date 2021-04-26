<?php

$loginAndSignUpVisibility = '';  //used to hide login / Signup buttons if user IS LOGGED IN.
$logoutVisibility = ''; //used to hide logout button if user is NOT LOGGED IN. 

if( isset($_SESSION['user_id']) ){ //&& $_SESSION['user_id'] > 0

    $loginAndSignUpVisibility = "hide"; //hide login / signup button
    
}else{
    $logoutVisibility = "hide"; //hide logout button
}


?>


<a class="item <?=$loginAndSignUpVisibility?>" href="register.php">Sign Up</a>
<a class="item <?=$loginAndSignUpVisibility?>" href="login.php">Log In</a>
<a class="item <?=$logoutVisibility?>" href="logout.php">Logout</a>
