<?php
include '../app/getItems.php';
$offers = getOffers();
$flag = 0; ?>

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
    <link rel="stylesheet" href="./styles/glide-3.4.1/dist/css/glide.core.min.css" />
    <link rel="stylesheet" href="./styles/glide-3.4.1/dist/css/glide.theme.css" />
    <link rel="stylesheet" href="styles/styles.css" />


    <title>Pizza House</title>
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
                    <li class="current"><a href="#">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="reservation.php">Reservations</a></li>
                    <li><a href="offers.php">Offers</a></li>
                    <li><a href="feedbacks.php">Feedbacks</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </nav>
        </div>
        <div class="nav-border"></div>
    </header>

    <div class="container">
        <div class="row" id="index-offers">
            <h2>Offers</h2>
            <div class="glide">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <?php
                        foreach ($offers as $offer) :
                            $idItem = $offer->Item_idItem;
                            $item = getItem((int)$idItem);
                            $discount = $offer->offer_discount;
                            $new_price = $item->Item_price - ($item->Item_price * $discount / 100);
                            $date = new DateTime(date("F j"));
                            $date->modify('+ ' . $offer->Offer_duration . ' days');
                            echo ' <li class="glide__slide">
            <div class="content-no-padding">
            <div class="row">
                <div class=" col-lg-5 col-sm-5 col-md-5 col-xs-5 offer-content-top">
                    <img class="img-fluid offer-image" src="../' . $item->Item_image . '">
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 content-bottom">
                <h2>' . $offer->Offer_name . '</h2>
                    <a href="item.php?itemId=' . $item->idItem . '"><h5>' .  $item->Item_name . '</h5></a>
                    <h4 class="item-price">  Old price: 
        <span style="text-decoration: line-through;">' .

                                $item->Item_price . '$' .
                                '
        </span></h4><h4><span style="color:#69c834">New price: ' . $new_price . '$
              </span> </h4>
              <p>Valid till ' . $date->format('F j') . '</p></div>
            </div>
            </div>
            </li>
       ';
                        endforeach;

                        ?>

                    </ul>
                </div>
            </div>
            <div class="glide__arrows" data-glide-el="controls">

            </div>
        </div>
        <script src="./styles/glide-3.4.1/dist/glide.min.js"></script>

        <script>
        const config = {
            type: "carousel",
            perView: "1",
            autoplay: "3000",
            hoverpause: false,
            gap: 2
        };
        new Glide(".glide", config).mount();
        </script>
    </div>
    <div class="section-border"></div>
    <div class="container">
        <div class="row" id="menus-section">
            <div class="row menus-header">

                <h2>Menu</h1>
            </div>
            <div class="row">
                <?php

                $menus = getMenus();
                foreach ($menus as $menu) :
                    echo '<div class="col-sm-6 col-xs-6 col-md-6 offset-md-0 col-lg-6 menu-item">
						 <div class="menu-item-content">
						 <img class="img-fluid" src= "../' . $menu->menu_image . '">
						  <a href="menuItems.php?menuId=' . $menu->idMenu . ' ">
                          
	                      <div class="menu-item-name">
						 <p>' . $menu->Menu_name . '</p>
						 </div>
                         </a>
					       </div>
							</div> ';
                endforeach;
                ?>
            </div>
        </div>
    </div>
    </div>
    <div class="section-border"></div>
    <div class="container">
        <div class="about-content" style="margin-bottom:100px">
            <h2>About us:</h2>
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">


                    <p>PizzaHouse is a food company founded in 2022 and based in Beirut, Lebanon. We specialize in pizza
                        but offer all food services. PizzaHouse strictly maintain high food hyginic standards, quality
                        metrics, and well customer services in local market.<br>
                        We are located in Hadath, Lebanese University Campus in Beirut.</p>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                    <img src="./images/header-image.png">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                    <div class="goto-links">
                        <a href="reservation.php">Make a reservation</a>
                        <a href="feedback.php">Leave a feedback</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                <li class="current"><a href="index.php">Home </a></li>
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
                            <p>PizzaHouse is a food company founded and based in Beirut, Lebanon. We offer all types
                                of
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