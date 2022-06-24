<?php

include '../app/dashboardFunctions.php';
if (!isset($_SESSION['admin'])) {
    header('Location:admin-login.php');
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


    <title>Dashboard</title>
</head>

<body>
    <div class="dashboard-wrapper">
        <div class="row">
            <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                <div class="left-sidebar">
                    <div class="left-sidebar-inner">
                        <a href="dashboard.php">
                            <h6>PizzaHouse</h6>
                        </a>
                        <div class="sidebar-list">
                            <ul>
                                <li><a href="dashboard.php?page=menus">Menus</a></li>
                                <li><a href="dashboard.php?page=addMenu">Add Menu</a></li>
                                <li><a href="dashboard.php?page=reservations">Reservations</a></li>
                                <li><a href="dashboard.php?page=addReservation">Add Reservation</a></li>
                                <li><a href="dashboard.php?page=meals">Meals</a></li>
                                <li><a href="dashboard.php?page=addMeal">Add Meal</a></li>
                                <li><a href="dashboard.php?page=offers">Offers</a></li>
                                <li><a href="dashboard.php?page=addOffer">Add Offer</a></li>
                                <li><a href="dashboard.php?page=feedbacks">Feedbacks</a></li>
                                <?php
                                if ($_SESSION['admin']->isSuper == 1) {
                                    echo ' <li><a href="dashboard.php?page=admins">Adminstrators</a></li>';
                                    echo ' <li><a href="dashboard.php?page=addAdmins">Add Adminstrators</a></li>';
                                }
                                ?>
                                <li class="dashboard-logout"><a href="admin-login.php?logout=1">Logout</a></li>

                            </ul>

                        </div>

                    </div>
                </div>
            </div>
            <div class=" col-sm-10 col-xs-10 col-md-10 col-lg-10">
                <div class="right-side">
                    <div class="right-side-inner">
                        <div class="right-side-inner-data container">
                            <?php
                            if (!isset($_GET['page'])) {
                                displayHome();
                            } else
                                displayDashboard();

                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function populate(menu) {
        if (window.XMLHttpRequest) {
            xmlHttp = new XMLHttpRequest()
        } else {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlHttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('offer-meal').innerHTML = this.responseText;
            }
        }
        xmlHttp.open("GET", "../app/populateSelect.php?value=" + menu, true);
        xmlHttp.send();
    }
    </script>
</body>