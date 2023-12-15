<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aidens Superhero API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="background">

    <?php
    //displays the nav
    include "view/nav.php";
    //connects us to the database
    include "model/userApi.php";
    ?>


    <div class="mx-auto text-center">
        <?php

        //This is getting the action form the browser
        $action = filter_input(INPUT_GET, 'action');

        // this sees if there is a action then puts the action name into the variable
        $action ? $action : $action = filter_input(INPUT_POST, 'action');

        // this switch statement then will look at the var action to see what it needs to do
        switch ($action) {
            // if the action is to add a user
            case "addUser":
                $Email = filter_input(INPUT_POST, 'Email');
                // Call the addUser function with the provided email
                addUser($Email);
                break;
                // If the action is to validate login
            case "ValidLogin":
                $Email = filter_input(INPUT_POST, 'Email');
                $Apikey = filter_input(INPUT_POST, 'Apikey');

                // Initialize a variable to check if a match is found
                $results = Apikey();

                $matchFound = false;
                
                // Loop through the results to check for a match
                foreach ($results as $item) {
                    if ($item['User_Email'] === $Email && $item['User_apikey'] === $Apikey) {

                        // Set matchFound to true if a match is found
                        $matchFound = true;
                        break;
                    }
                }

                if ($matchFound) {
                    header("Location: superinterface.php");
                    exit(); // Make sure to call exit() after using header()
                } else {
                    // If no match is found, include the invalid login view
                    include "view/invalidlogin.php";
                }
                break;
                // If the action is to display the registration form
            case "registration":
                include "view/registration.php";
                break;
                // If the action is to display the login form
            case "login":
                include "view/login.php";
                break;
                // If no specific action is provided, display a greeting
            default:
                include "view/greeting.php";
        }

        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>