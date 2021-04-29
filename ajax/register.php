<?php 

// Allow the config
define('__CONFIG__', true);
// Require the config
require_once "../inc/config.php";


//make sure this site was accessed over an AJAX call. otherwise the user could simply go to this site over the URL
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Always return JSON Format
    header('Content-Type: application/json');
    // return array -> saves result of validation with error messages
    $return = [];
    
    $username = Filter::String( $_POST['username'] );
    $email = Filter::String( $_POST['email'] ); 
    //$email = strtolower($email); - better in SQL Statement with LOWER() = faster 
    $password = Filter::String( $_POST['password'] ); 
    $confirmPW = Filter::String( $_POST['confirm_password'] ); 


    // Validate Username
    if( strlen($username) < 4 ){
        $return['error'] = "Username must be more than 3 signs"; 
        // if it is not a valid email - send error back and quits script
        echo json_encode($return, JSON_PRETTY_PRINT); exit;
    }

    // Validate e-mail
    if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $return['error'] = $email ." is not a valid email"; 
        // if it is not a valid email - send error back and quits script
        echo json_encode($return, JSON_PRETTY_PRINT); exit;
    }


    // Validate if Passward and ConfirmPassword are the save value
    if( $password != $confirmPW ){
        $return['error'] = "Passwords do not match each other"; 
        // if it is not a valid email - send error back and quits script
        echo json_encode($return, JSON_PRETTY_PRINT); exit;
    }

    

    // Making sure the user does not exist
    $user_found = User::Find($email);

    if($user_found){
        // User exists
        // We can also check to see if they are able to log in
        $return['error'] = "You already have an account. Go to <a href='login.php' class='signInLink'>Log in</a>";
        $return['isLoggedIn'] = false;
    }else{
        // User does not exists, add them now
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT );

        $addUser = $con->prepare("INSERT INTO USER(username, email, password) VALUES(:username, LOWER(:email), :password)");
        $addUser->bindParam(':username', $username, PDO::PARAM_STR);
        $addUser->bindParam(':email', $email, PDO::PARAM_STR);
        $addUser->bindParam(':password', $password, PDO::PARAM_STR);
        $addUser->execute();

        $user_id = $con->lastInsertID();

        $_SESSION['user_id'] = (int) $user_id;

        // Return the proper information back to JavaScript to redirect us
        $return['redirect'] = 'home.php?message=welcome'; 
        $return['isLoggedIn'] = true;
    }

    echo json_encode($return, JSON_PRETTY_PRINT); exit;

}else{
    //Die. Kill the scrip. Redirect the user. Do something regardless.
    
    //exit('Site not called over AJAX');
    header('Location: ../home.php');
}

?>
