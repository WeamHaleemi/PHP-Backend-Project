<?php
include '../app/dashboardFunctions.php';
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $_SESSION['loggedin'] == 0;
    unset($_SESSION['admin']);
}
if (isset($_POST['login'])) {
    $username = $_POST['admin-username'];
    $password = $_POST['admin-password'];
    if (login($username, $password) == true) {
        $_SESSION['loggedin'] = 1;
        $admin = getAdministrator($username);
        $_SESSION['admin'] = $admin;
        header('Location:dashboard.php');
    } else {
        echo '<script> alert("Incorrect login info")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles/bootstrap/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="./styles/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles/styles.css" />


    <title>Adminstration</title>
</head>

<body class="admin-login-section">
    <div class="container ">
        <div class="row  admin-login-wrapper">
            <div class="col-lg-6 col-sm-6 col-md-6 admin-login-form-left">
                <div class="inner">
                    <h3>Admin</h4>
                        <form id="admin-login-form" method="post">
                            <label for="admin-username">Username</label>
                            <input id="text" type="text" name="admin-username">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="admin-password">
                            <div class=" row form-inner-container">
                                <div class="col-xs-8 col-lg-8 col-sm-8 col-md-8">
                                    <label for="keep-logged">Keep logged in?</label>
                                    <input type="checkbox" id="keep-logged" value="keep-logged" name="keep-logged">
                                </div>
                                <div class="col-xs-4 col-lg-4 col-sm-4 col-md-4">
                                    <input type="submit" name="login" value="Login">
                                </div>
                            </div>
                        </form>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 admin-login-form-right">

                <div class="inner-img-container">
                    <img class="img-fluid" src="./images/header-image_nobg.png">
                    <h3>Pizza House</h3>
                    <p>Sign in to manage your website. </p>
                </div>


            </div>
        </div>
    </div>
</body>

</html>