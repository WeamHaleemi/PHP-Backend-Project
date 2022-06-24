<?php
include '../app/dashboardFunctions.php';
if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $numplaces = $_POST["number-places"];
    $date = $_POST["reservation-date"];
    $time = $_POST['reservation-time'];
    insertReservation($name, $phone, $numplaces, $date, $time);
}
if (isset($_POST['max_reserve'])) {
    $max_reserve = (int) $_POST['max_reserve'];
} else $max_reserve = 3;
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


    <title>Reservations</title>
</head>

<body>
    <header class="clearfix" id="header">
        <div class="container">
            <div class="row">
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <!-- <img id="header-title" src="./images/header-title.PNG"> -->
                    <h1 id="header-title">Pizza House</h1>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <img class="img-fluid" id="header-image" src="./images/header-image.png">
                </div>
            </div>
        </div>
        <div class="nav-border"></div>
        <div class="container">
            <nav id="nav">
                <ul id="nav-list" class="sf-menu clearfix">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li class="current"><a href="reservation.php">Reservations</a></li>
                    <li><a href="offers.php">Offers</a></li>
                    <li><a href="feedbacks.php">Feedback</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </nav>
        </div>
        <div class="nav-border"></div>
    </header>
    <div class="section-border"></div>
    <div id="reservation-section" class="container-flud">
        <div class="container">
            <div class="row" id="reservation-header">
                <h2>Book a Reservation Now:</h2>
            </div>
            <div class="row">
                <div class="col-xs-1 col-sm-12 col-md-6 col-lg-6">
                    <form class="reservation-form" method="POST" action="reservation.php">
                        <label for="name">Full Name:</label>
                        <input type="text" name="name" id="name" required>
                        <label for="phone">Phone Number:</label>
                        <input type="text" inputmode="numeric" pattern="[0-9]*" name="phone" id="phone" required>
                        <label for="number-places">Number of Seats:</label>
                        <select size="1" name="number-places" id="number-places" required>
                            <option value="" selected hidden>Select Number of Seats</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <label for="reservation-date">Date:</label>
                        <input type="date" name="reservation-date" min="<?php echo date('Y-m-d') ?>" required>
                        <label for="reservation-time">Time:</label>
                        <input type="time" name="reservation-time" required>
                        <input type="submit" name="submit" value="Make Reservation">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="section-border"></div>
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                    <div class="footer-content footer-left">
                        <div class="footer-content-top">
                            <img src="images/header-image_nobg.png" />
                            <h5>PizzaHouse</h5>
                        </div>
                        <div class="footer-content-bottom">
                            <ul class="footer-nav">
                                <li><a href="#">Home </a></li>
                                <li><a href="menu.php">| Menu | </a></li>
                                <li><a href="reservation.php">Reservations | </a></li>
                                <li><a href="offers.php">Offers |</a></li>
                                <li><a href="feedbacks.php">Feedbacks |</a></li>
                                <li><a href="about.php">About</a></li>
                            </ul>
                        </div>
                        <div class="footer-copy">

                            <p> &copy Copyrights PizzaHouse 2022 all rights reserved</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                    <div class="footer-content footer-center">
                        <div class="footer-content-bottom">
                            <div class="footer-center-content">
                                <i class="fa-solid fa-location-dot" style="margin-top: 10px;"></i>
                                <div>
                                    <p class="location-top">Rafic Hariri University Campus - Hadath</p>
                                    <p class="location-bottom"> Beirut, Lebanon</p>

                                </div>
                            </div>

                            <div class="footer-center-content">
                                <i class=" fa fa-phone"></i>
                                <p>+961 71 307466</p>
                            </div>
                            <div class="footer-center-content" style="margin-top: 0px;">
                                <i class=" fa fa-envelope" style="margin-top:10px"></i>
                                <p><a href="mailto:support@pizzahouse.com"
                                        style="color:  #fffb00;">a.allakeas@st.ul.edu.lb</a>
                                    <br>
                                    <a href="mailto:support@pizzahouse.com"
                                        style="color:  #fffb00;">w.haleemi@st.ul.edu.lb</a>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                    <div class="footer-content footer-right">
                        <div class="footer-content-top">
                            <h5>About PizzaHouse</h5>
                            <p>PizzaHouse is a food company founded and based in Beirut, Lebanon. We offer all types of
                                food services at our restaurant.</p>
                        </div>
                        <div class="footer-content-bottom">

                            <div class="footer-contact-links">
                                <ul class="social-links">
                                    <li><a href="#">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a></li>
                                    <li><a href="#">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a></li>
                                    <li><a href="#">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a></li>
                                    <li><a href="#">
                                            <i class="fa-brands fa-youtube"></i>
                                        </a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


    </footer>

</body>

</html>