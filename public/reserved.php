<?php
if (isset($_POST["submit"])) {

    echo $_POST["name"] . "<br/>".  $_POST["phone"] . "<br/>". $_POST["number-places"] . "<br/>"  . $_POST["reservation-date"];
    
}