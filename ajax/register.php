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
    
    $email = Filter::String( $_POST['email'] ); 
    //$email = strtolower($email); - better in SQL Statement with LOWER() = faster 

    // Make sure the user does not exist
    $user_found = User::Find($email);

    if($user_found){
        // User exists
        // We can also check to see if they are able to log in
        $return['error'] = "You already have an account";
        $return['isLoggedIn'] = false;
    }else{
        // User does not exists, add them now
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT );

        $addUser = $con->prepare("INSERT INTO USER(email, password) VALUES(LOWER(:email), :password)");
        $addUser->bindParam(':email', $email, PDO::PARAM_STR);
        $addUser->bindParam(':password', $password, PDO::PARAM_STR);
        $addUser->execute();

        $user_id = $con->lastInsertID();

        $_SESSION['user_id'] = (int) $user_id;

        // Return the proper information back to JavaScript to redirect us
        $return['redirect'] = 'dashboard.php?message=welcome'; 
        $return['isLoggedIn'] = true;
    }

    // Make sure the user CAN be added AND is added 

    echo json_encode($return, JSON_PRETTY_PRINT); exit;
}else{
    //Die. Kill the scrip. Redirect the user. Do something regardless.
    exit('Site not called over AJAX');
}

?>
