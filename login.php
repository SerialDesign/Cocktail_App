<?php 

// Allow the config
define('__CONFIG__', true);
// Require the config
require_once "inc/config.php";

Page::forceDashboard();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Corona Blues - Login</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.19/dist/css/uikit.min.css" />

    <link rel="stylesheet" href="assets/css/main_styles.css">
    
    <style>
        body{
            background-image: url('assets/images/woman_drinking.jpg');
            background-size: cover; /* Todo: remove again? */
            height: 100vh;
        }
        .js-login{
            background: whitesmoke;
            padding: 50px;
            box-shadow: 0 0 1em gold;
            opacity: 0.9;
        }
        @media only screen and (max-width: 640px)  {
            .js-login{
            background: whitesmoke;
            padding: 20px 20px;
            margin: 100px 20px 100px 50px;
        }
        }
    </style>
</head>
<body>
    
    <div class="uk-section uk-container">
        <div class="uk-grid uk-child-width-1-3@s uk-child-width-1-1" uk-grid="">
            <form class="uk-form-stacked js-login uk-align-center">

                <h2>Login</h2>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Email</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="email" autocomplete="true" required placeholder="your@email.com">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Password</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="password" autocomplete="true" required placeholder="Your Password">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">
                        You do not have an account yet? 
                        <a href='register.php'>Sign Up</a>
                    </label>
                </div>
                

                <div class="uk-margin uk-alert uk-alert-danger js-error" style="display:none;"></div>

                <div class="uk-margin">
                    <button class="uk-button uk-button-default goldButton" type="submit">Login</button>
                </div>

            </form>
        </div>
    </div>


    <?php require_once "inc/js_scripts_footer.php" ?>
    
    <!-- Script only used on Login and Registration Page -->
    <script src="assets/js/loginAndRegister.js"></script>

    <!-- UIkit JS - just used for Login and Registration Form, nowhere else.. Semantic Ui main Frontent Framework -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.19/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.19/dist/js/uikit-icons.min.js"></script>


</body>
</html>