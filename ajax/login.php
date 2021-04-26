<?php 

// Allow the config
define('__CONFIG__', true);
// Require the config
require_once "../inc/config.php";

//make sure this site was accessed over an AJAX call. otherwise the user could simply go to this site over the URL
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Always return JSON Format
    header('Content-Type: application/json');
    //header('Location: ');
    $return = []; //$array = ['Test', 'Test2', 'Test3', array('name' => 'Cyrill', 'lastname' => 'Wyrsch')];
    
    /* NOT POSSIBLE?
     print_r($_POST);
    echo $_POST['email'];
    echo $_POST['password']; */

  //$email = Filter::String( $_POST['email'] ); 
    $email = Filter::Email( $_POST['email'] ); 
    //$email = strtolower($email); - better in SQL Statement with LOWER() = faster 
    $password = Filter::String( $_POST['password'] ); 


    // Validate e-mail
    if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $return['error'] = $email ." is not a valid email"; 
        // if it is not a valid email - send error back and quits script
        echo json_encode($return, JSON_PRETTY_PRINT); exit;
    }


    // Making sure the user does not exist
    $user_found = User::Find($email, true);

    if($user_found){
        // User exists, try and sign them in 
        
        $user_id = (int) $user_found['user_id'];
        $hashPassword = $user_found['password'];

        if( password_verify($password, $hashPassword) ){
            // User is signed in
            $return['redirect'] = "home.php";

            $_SESSION['user_id'] = $user_id;

        }else{
            // Invalid user email/password combo
            $return['error'] = "Invalid user email/password combo";
        }

    }else{
        //They need to create a new account
        $return['error'] = "You do not have an account. <a href='register.php'>Create one now?</a>";
    }

    echo json_encode($return, JSON_PRETTY_PRINT); exit;
    
}else{
    //Die. Kill the scrip. Redirect the user. Do something regardless.
    exit('Site not called over AJAX');
}

?>
