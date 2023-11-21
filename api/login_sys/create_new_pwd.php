<!doctype html>
    <html lang="en">

    <head>
        <link href="C:\xampp\htdocs\CWH\rps\style.css" rel="stylesheet" type="text/css" />

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <?php require 'C:\xampp\htdocs\cwh\partials\_nav.php';    ?>

        <title>Create New Password</title>

        <style>
            body {
                background-color: #555555;
                font-family: Asap, sans-serif;
                color: wheat;
                text-align: center;
            }

            div {
                margin: auto;
            }

            label {
                text-align: left;
            }
        </style>

    </head>

    <body>
        <!-- Optional JavaScript; choose one of the two! -->
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    </body>
</html>

<?php
$selector = $_GET["selector"];
// the token used to validate the user
$validator = $_GET["validator"];

// echo $selector;
// echo "<br>";
// echo $validator;

if (empty($selector) || empty($validator)) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Reset Password request Failed!</strong> We could not validate your request.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
} else {
    if (ctype_xdigit($selector) !== "false" || ctype_xdigit($validator) !== "false") {
        require 'C:\xampp\htdocs\cwh\partials\_form_create_new_pwd.php';    
    }
}
?>