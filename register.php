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
    <title>Corona Blues - Register</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.19/dist/css/uikit.min.css" />


    <link rel="stylesheet" href="assets/css/main_styles.css">
    <style>
        body{
            background-image: url('assets/images/shaking_girl.jpg');
            background-size: cover;  /* Todo: remove again? */
            height: 100vh;
        }
        .js-register{
            background: whitesmoke;
            padding: 50px;
            box-shadow: 0 0 1em gold;
        }
        @media only screen and (max-width: 500px)  {
            .js-register{
            background: whitesmoke;
            padding: 20px 20px;
            margin: 100px 20px 100px 50px;
            opacity: 0.9;
        }
        }
    </style>
</head>
<body>
    
    <div class="uk-section uk-container">
        <div class="uk-grid uk-child-width-1-3@s uk-child-width-1-1" uk-grid="">
            <form class="uk-form-stacked js-register uk-align-center">

                <h2>Register</h2>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Username</label>
                    <div class="uk-form-controls">
                        <input id="usernameRegister" class="uk-input" id="form-stacked-text" type="text" required placeholder="e.g. HeavyDrinker">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Email</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-stacked-text" type="email" required placeholder="your@email.com">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Password</label>
                    <div class="uk-form-controls">
                        <input id="passwordRegister" class="uk-input" id="form-stacked-text" type="password" required placeholder="Your Password">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">Confirm Password</label>
                    <div class="uk-form-controls">
                        <input id="confirmPwRegister" class="uk-input" id="form-stacked-text" type="password" required placeholder="repeat Password">
                    </div>
                </div>

                <div class="uk-margin uk-alert uk-alert-danger js-error" style="display:none;"></div>

                <div class="uk-margin">
                    <button class="uk-button uk-button-default goldButton" type="submit">Sign Up</button>
                </div>

            </form>
        </div>
    </div>


    <?php require_once "inc/footer.php" ?>

</body>
</html>