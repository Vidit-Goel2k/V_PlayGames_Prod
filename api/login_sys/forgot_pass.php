<?php

require 'C:\xampp\htdocs\cwh\partials\_nav.php';



if (isset($_GET["reset"])) {
    if ($_GET["reset"] == "success") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Reset password request successful!</strong> We have sent you a mail. Please check your email for further instructions. Kindly check your spam folder too.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    elseif($_GET["reset"] == "failure") {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Reset password request unsuccessful!</strong> Due to some technical reason we could not validate your request. Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <link href="C:\xampp\htdocs\CWH\rps\style.css" rel="stylesheet" type="text/css" />

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Forgot Password</title>

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

    <h5>Please Enter the Email associated to your account to recieve the instruction on how to reset your password</h5>

    <div class="container mt-3 p-4" class="row">
        <form class="form-inline" action="reset_pass_req.php" method="post">
            <div class=" mb-3 col-5">
                <!-- <label for="email" class="form-label ">Email address</label> -->
                <input placeholder="Email Address" type="email" maxlength="52" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            </div>
            <button type="submit" name="reset_req_submit" class="btn btn-primary">Get the email</button>
        </form>
    </div>

      <!-- Optional JavaScript; choose one of the two! -->
            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->
             <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
       

</body>

</html>