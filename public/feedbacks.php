<?php
include '../app/dashboardFunctions.php';
if (isset($_POST['submit'])) {
    $flag = 1;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['feedback-message'];
    insertFeedback($name, $email, $message);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="styles/styles.css" />


    <title>Pizza House</title>
</head>

<body>
    <header class="clearfix" id="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <!-- <img id="header-title" src="./images/header-title.PNG"> -->
                    <h1 id="header-title">Pizza House</h1>
                </div>
                <div class="col-lg-3">
                    <img id="header-image" src="./images/header-image.png">
                </div>
            </div>
        </div>
        <div class="nav-border"></div>
        <div class="container">
            <nav id="nav">
                <ul id="nav-list" class="sf-menu clearfix">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="reservation.php">Reservations</a></li>
                    <li><a href="offers.php">Offers</a></li>
                    <li class="current"><a href="feedbacks.php">Feedbacks</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </nav>
        </div>
        <div class="nav-border"></div>
    </header>

    <div id="feedback-section" class="container-flud">
        <div class="container">
            <div class="row" id="feedback-header">

                <h2>Leave a Feedback:</h2>
            </div>
            <div class="row">
                <div class="col-xs-1 col-sm-12 col-md-6 col-lg-6">
                    <form class="feedback-form" method="POST" action="feedbacks.php">
                        <label for="name">Full Name:</label>
                        <input type="text" name="name" id="name" required>
                        <label for="phone">Email:</label>
                        <input type="email" name="email" id="email" required>
                        <label for="feedback-message">Message:</label>
                        <textarea name="feedback-message" id="feedback-message"></textarea>
                        <input type="submit" name="submit" value="Send Feedback">

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
                                <li><a href="index.php">Home </a></li>
                                <li><a href="menu.php">| Menu | </a></li>
                                <li><a href="reservation.php">Reservations | </a></li>
                                <li><a href="offers.php">Offers |</a></li>
                                <li class="current"><a href="feedbacks.php">Feedback |</a></li>
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
    <script src="./styles/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>