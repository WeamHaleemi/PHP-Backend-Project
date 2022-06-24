<?php
include 'getItems.php';

session_start();

function displayHome()
{


    //get Admin name from session, when he logs in his name will be stored in the session
    echo    '<div class="row inner-top">
                 <h4> Welcome ' . $_SESSION['admin']->Administrator_username . '</h4>
                </div>';
    echo    '<div class="row inner-bottom">
               ' . changeOffersForm(0) . '
               </div>';
    echo    '<div class="row inner-bottom">
               ' . changeReservationsForm(0) . '
               </div>';
    echo    '<div class="row inner-bottom">
               ' . changeFeedbacksForm(0) . '
               </div>';
}
function displayDashboard()
{
    //function to display dashboards depending on the GET parameter.
    switch ($_GET['page']) {
        case 'addMeal':
            addMealForm();
            break;
        case 'addMenu':
            addMenuForm();
            break;
        case 'addReservation':
            addReservationForm();
            break;
        case 'addOffer':
            addOfferForm();
            break;
        case 'menus':
            changeMenusForm();
            break;
        case 'reservations':
            changeReservationsForm(1);
            break;
        case 'meals':
            changeMealsForm();
            break;
        case 'offers':
            changeOffersForm(1);
            break;
        case 'feedbacks':
            changeFeedbacksForm(1);
            break;
        case 'editMeal':
            editMealForm();
            break;
        case 'editOffer':
            editOfferForm();
            break;
        case 'menu':
            displayMenu();
            break;
        case 'editReservation':
            editReservationForm();
            break;
        case 'addAdmins':
            addAdministratorForm();
            break;
        case 'admins':
            changeAdminForm();
            break;
        case 'editAdmin':
            editAdminForm();
            break;
    }
}
function lastestRes()
{
    //function to get latest reservations
}
function latestOffers()
{
    //function to get latest Offers
}
function addMealForm()
{
    if (isset($_POST['add-meal-submit'])) {
        //add Meal to database
        $name = $_POST['meal-name'];
        $desc = $_POST['meal-desc'];
        $price = $_POST['meal-price'];
        $mealID = $_POST['meal-menu'];
        $image = uploadFile('meal-file');
        insertMeal($name, $desc, $price, $mealID, $image);
        header('Location:dashboard.php?page=meals');
    }
    echo '<div class="row">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">

                    <h4 class="add-meal-header">Add Meal:</h4>

                    <form class="dashboard-form" method="post"
                        action="dashboard.php?page=addMeal" enctype="multipart/form-data">
            <label for="meal-menu">Menu:</label>
            <select name="meal-menu" required>';
    $menus = getMenus();
    foreach ($menus as $menu) {
        echo '<option value="' . $menu->idMenu . '">' . $menu->Menu_name . '</option>';
    }
    echo ' </select>
            <label for="meal-name">Meal Name:</label>
            <input type="text" name="meal-name" id="meal-name">
            <label for="meal-desc">Meal Description:</label>
            <textarea name="meal-desc" id="meal-desc" required></textarea>
            <label for="meal-price">Meal Price:</label>
            <input type="text" inputmode="numeric" pattern="[0-9]*"  name="meal-price" id="meal-price" required>
            <label for="meal-file">Image:</label>
            <input type="file" name="meal-file" id="meal-file" accept="image/*" required>
            <input type="submit" name="add-meal-submit" value="Add Meal">

            </form>
            </div>
            </div>';
}
function addMenuForm()
{
    if (isset($_POST['add-menu-submit'])) {
        //add Menu to database
        $name = $_POST['menu-name'];
        if (!isset($_POST['menu-name']) || !isset($_FILES['menu-file'])) {
            echo 'Please fill out all the fields';
        } else {
            $image = uploadFile('menu-file');
            insertMenu($name, $image);
            header('Location:dashboard.php?page=menus');
        }
    }

    echo ' <div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">

        <h4 class="dashboard-form-header">Add Menu:</h4>

        <form class="dashboard-form" method="post" action="dashboard.php?page=addMenu" enctype="multipart/form-data">

            <label for="menu-name">Menu Name:</label>
            <input type="text" name="menu-name" id="menu-name" required>
            <label for="menu-image">Image:</label>
            <input type="file" name="menu-file" id="menu-file" accept="image/*" required>
            <input type="submit" name="add-menu-submit" value="Add Menu">

        </form>
    </div>
</div>';
}
function addReservationForm()
{
    if (isset($_POST["add-reservation-submit"])) {

        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $numplaces = $_POST["number-places"];
        $date = $_POST["reservation-date"];
        $time = $_POST['reservation-time'];
        insertReservation($name, $phone, $numplaces, $date, $time);
        $flag = 1;
    }

    echo '<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">

        <h4 class="dashboard-form-header">Add Reservation:</h4>';
    if (isset($flag) && $flag == 1) {
        echo '<p class="success-message">Reservation added.</p>';
    }
    echo '   <form class="dashboard-form" method="POST"
            action="dashboard.php?page=addReservation">
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
                        <input type="date" name="reservation-date" min="' . ('Y-m-d') . '" required>
<label for="reservation-time">Time:</label>
<input type="time" name="reservation-time" required>
<input type="submit" name="add-reservation-submit" value="Make Reservation">
</form>
</div>
</div>';
}
function addOfferForm()
{

    if (isset($_POST['add-offer-submit'])) {
        //add Reservation to database
        $menuID = $_POST['offer-menu'];
        $mealID = $_POST['offer-meal'];
        $offerName = $_POST['offer-name'];
        $offerDiscount = $_POST['offer-discount'];
        $offerDuration = $_POST['offer-duration'];
        insertOffer($mealID, $offerName, $offerDiscount, $offerDuration);
        header('Location:dashboard.php?page=offers');
    }

    echo ' <div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">

        <h4 class="add-offer-header">Add Offer:</h4>

        <form class="dashboard-form" method="post" action="dashboard.php?page=addOffer">
            <label for="offer-menu">Menu:</label>
            <select name="offer-menu" id="offer-menu" onchange="populate(this.value);" required>';
    echo '<option value="0" selected>Select Menu</option>';
    $menus = getMenus();
    foreach ($menus as $menu) {
        echo '<option value="' . $menu->idMenu . '">' . $menu->Menu_name . '</option>';
    }
    echo '</select>
            <label for="offer-meal">Menu:</label>
            <select name="offer-meal" id="offer-meal" required>
                <option value="0">Select Meal</option>
            </select>
            <label for="offer-name">Offer Name:</label>
            <input type="text" name="offer-name" id="offer-name" required>
            <label for="offer-discount">Discount Percent:</label>
            <input type="text" inputmode="numeric" pattern="[0-9]*" name="offer-discount" id="offer-discount" required>
            <label for="offer-duration">Duration:</label>
            <input type="text" inputmode="numeric" pattern="[0-9]*" name="offer-duration" id="offer-duration" required>
            <input type="submit" name="add-offer-submit" value="Add Offer">

        </form>
    </div>
</div>
';
}

function uploadFile($type)
{
    if ($type == 'menu-file') {
        $name = 'menu-name';
    } else
        $name = 'meal-name';
    $fileName = $_POST[$name];
    $upload_dir = "/upload/images/";
    $file = $upload_dir . basename($_FILES[$type]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES[$type]["tmp_name"]);
    if ($check !== false) {

        $uploadOk = 1;
    } else {

        $uploadOk = 0;
    }
    if ($_FILES[$type]["size"] > 500000) {
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES[$type]["tmp_name"], '../' . $file)) {
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return $file;
}
function insertMenu($menuName, $menuImage)
{
    $connection = OpenConnection();
    $query = 'insert into menu (Menu_name,menu_image) values (?,?)';
    $statement = $connection->prepare($query);
    $statement->bind_param('ss', $menuName, $menuImage);
    $statement->execute();
    CloseConnection($connection);
}
function insertMeal($name, $desc, $price, $mealID, $image)
{
    $connection = OpenConnection();
    $query = 'insert into item (Item_name,Item_description,Item_price,Item_image,Menu_idMenu) values (?,?,?,?,?)';
    $statement = $connection->prepare($query);
    $statement->bind_param('ssisi', $name, $desc, $price, $image, $mealID);
    $statement->execute();
    CloseConnection($connection);
}
function insertOffer($mealID, $offerName, $offerDiscount, $offerDuration)
{
    $connection = OpenConnection();
    $query = 'insert into offers (Offer_name,offer_discount,Offer_duration,Item_idItem) values (?,?,?,?)';
    $statement = $connection->prepare($query);
    $statement->bind_param('siii', $offerName, $offerDiscount, $offerDuration, $mealID);
    $statement->execute();
    CloseConnection($connection);
}

function changeMenusForm()
{

    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        deleteMenu($id);
    }
    if (isset($_POST['edit'])) {
        $id = $_POST['edit'];
        header('Location:dashboard.php?page=menu&menu=' . $id);
    }
    // if (!empty($_POST['Menus'])) {
    // foreach ($_POST['Menus'] as $delMenu) {
    // deleteMenu($delMenu);
    // }
    // }
    $arrayMenus = getMenus();

    echo '<form class="edit-delete-form" action="dashboard.php?page=menus" method="POST">
    <h3>Menus:</h3>
    <table class="display-table">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th># items</th>
            <th>Image</th>
        </tr>';
    foreach ($arrayMenus as $menu) {
        echo '<tr>
            <td>' . $menu->idMenu . '</td>
            <td><a href="dashboard.php?page=menu&menu=' . $menu->idMenu . '">' . $menu->Menu_name . '</a></td>
            <td>' . getItemsCount($menu->idMenu) . '</td>
            <td><img class="img-fluid" src="../' . $menu->menu_image . '"></td>
            <td>
                <div class="edit-delete">
                    <button name="edit" type="submit" value="' . $menu->idMenu . '">Edit</button>
                    <button name="delete" type="submit" value="' . $menu->idMenu . '">Delete</button>
                </div>
            </td>
        </tr>';
    }
    echo '
    </table>
</form>';
}

function changeReservationsForm($flag)
{
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        deleteReservation($id);
    }
    if (isset($_POST['edit'])) {
        $id = $_POST['edit'];
        header('Location:dashboard.php?page=editReservation&reservation=' . $id);
    }
    if ($flag == 1)
        $arrayReservations = getReservations();
    else
        $arrayReservations = getLatestReservations();


    echo '<form class="edit-delete-form" action="dashboard.php?page=reservations" method="POST"> 
       ';
    if ($flag == 1)
        echo '<h3>Reservations:</h3>';
    else
        echo '<h3>Latest Reservations:</h3>';
    echo ' <table class="display-table">
                                <tr>
                                    <th>Id</th>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Places</th>
                                </tr>';
    foreach ($arrayReservations as $reservation) {
        echo '<tr>
                                    <td>' . $reservation->Reservation_ID . '</td>
                                    <td>' . $reservation->Reservation_name . '</td>
                                    <td>' . $reservation->Reservation_phone . '</td>
                                    <td>' . $reservation->Reservation_date . '</td>
                                    <td>' . $reservation->Reservation_time . '</td>
                                    <td>' . $reservation->Reservation_count . '</td>
                                    <td><div class="edit-delete">
                                    <button  name="edit" type="submit" value="' . $reservation->Reservation_ID . '">Edit</button>
                                    <button  name="delete" type="submit" value="' . $reservation->Reservation_ID . '">Delete</button>
                                    </div></td>
                                    </tr>';
    }
    echo '</table></form>';
}
function changeMealsForm()
{
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        deleteItem($id);
    }
    if (isset($_POST['edit'])) {
        $id = $_POST['edit'];
        header('Location:dashboard.php?page=editMeal&item=' . $id);
    }
    $arrayItems = getItems();
    echo '<form class="edit-delete-form" action="dashboard.php?page=meals" method="POST"> 
    <h3>Meals:</h3>
    <table class="display-table">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Menu</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Image</th>
                            </tr>';
    foreach ($arrayItems as $item) {
        echo '<tr>
                                <td>' . $item->idItem . '</td>
                                <td>' . $item->Item_name . '</td>
                                <td>' . getMenuName($item->Menu_idMenu) . '</td>
                                <td>' . $item->Item_description . '</td>
                                <td>' . $item->Item_price . '</td>
                                <td><img class="img-fluid" src="../' . $item->Item_image . '" ></td>
                                <td><div class="edit-delete">
                                <button  name="edit" type="submit" value="' . $item->idItem . '">Edit</button>
                                <button  name="delete" type="submit" value="' . $item->idItem . '">Delete</button>
                                </div></td>
                                </tr>';
    }
    echo '</table></form>';
}

function changeOffersForm($flag)
{
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        deleteOffer($id);
    }
    if (isset($_POST['edit'])) {
        $id = $_POST['edit'];
        header('Location:dashboard.php?page=editOffer&offer=' . $id);
    }
    if ($flag == 1)
        $arrayOffers = getOffers();
    else
        $arrayOffers = getlatestOffers();
    echo '<form class="edit-delete-form" action="dashboard.php?page=offers" method="POST"> ';
    if ($flag == 1)
        echo '<h3>Offers:</h3>';
    else
        echo '<h3>Latest Offers:</h3>';
    echo '<table class="display-table">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Item</th>
                                <th>Discount</th>
                                <th>Duration</th>

                            </tr>';
    foreach ($arrayOffers as $offer) {
        echo '<tr>
                                <td>' . $offer->Offer_ID . '</td>
                                <td>' . $offer->Offer_name . '</td>
                                <td>' . getItemName($offer->Item_idItem) . '</td>
                                <td>' . $offer->offer_discount . '</td>
                                <td>' . $offer->Offer_duration . '</td>
                               
                                <td><div class="edit-delete">
                                <button  name="edit" type="submit" value="' . $offer->Offer_ID . '">Edit</button>
                                <button  name="delete" type="submit" value="' . $offer->Offer_ID . '">Delete</button>
                                </div></td>
                                </tr>';
    }
    echo '</table></form>';
}
function changeFeedbacksForm($flag)
{

    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        deleteFeedback($id);
    }

    if ($flag == 1)
        $arrayFeedbacks = getFeedbacks();
    else
        $arrayFeedbacks = getLatestFeedbacks();
    echo '<form class="edit-delete-form" action="dashboard.php?page=feedbacks" method="POST"> ';
    if ($flag == 1)
        echo '<h3>Feedbacks:</h3>';
    else
        echo '<h3>Latest Feedbacks:</h3>';
    echo '<table class="display-feedback">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th >Feedback</th>

                            </tr>';
    foreach ($arrayFeedbacks as $feedback) {
        echo '<tr>
                                <td class="small-td">' . $feedback->Feedback_ID . '</td>
                                <td class="small-td">' . $feedback->Feedback_name . '</td>
                                <td class="small-td">' . $feedback->Feedback_email . '</td>
                                <td class="big">' . $feedback->Feedback_description . '</td>
                               
                                <td><div class="edit-delete">
    
                                <button  name="delete" type="submit" value="' . $feedback->Feedback_ID . '">Delete</button>
                                </div></td>
                                </tr>';
    }
    echo '</table></form>';
}

function deleteMenu($delMenu)
{
    $items = getMenuItems($delMenu);
    foreach ($items as $item) {
        deleteItem($item->idItem);
    }
    $connection = OpenConnection();
    $query = 'DELETE FROM menu WHERE idMenu = ? ';
    $statement = $connection->prepare($query);
    $statement->bind_param('s', $delMenu);
    $statement->execute();
    CloseConnection($connection);
}

function deleteReservation($delRsv)
{

    $connection = OpenConnection();
    $query = 'DELETE FROM reservations WHERE Reservation_ID  = ? ';
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $delRsv);
    $statement->execute();
    CloseConnection($connection);
}

function deleteItem($delItem)
{

    $connection = OpenConnection();
    $query = 'DELETE FROM item WHERE idItem = ? ';
    $statement = $connection->prepare($query);
    $statement->bind_param('s', $delItem);
    $statement->execute();
    CloseConnection($connection);
}

function deleteOffer($id)
{

    $connection = OpenConnection();
    $query = 'DELETE FROM offers WHERE Offer_ID = ? ';
    $statement = $connection->prepare($query);
    $statement->bind_param('s', $id);
    $statement->execute();
    CloseConnection($connection);
}

function deleteFeedback($Feedback_ID)
{
    $connection = OpenConnection();
    $query = 'DELETE FROM feedbacks WHERE Feedback_ID  = ? ';
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $Feedback_ID);
    $statement->execute();
    CloseConnection($connection);
}
// function changeMealsForm()
// {
//     if (!empty($_POST['items'])) {
//         foreach ($_POST['items'] as $delItem) {
//             deleteItem($delItem);
//         }
//     }
//     $arrayItems = getItems();
//     echo '<form class="dashboard-form" method="post"
//                         action="dashboard.php?page=meals" enctype="multipart/form-data">';
//     echo "<Table> <th> List of Items </th>";
//     foreach ($arrayItems as $item) {
//         echo '<tr><td><input type="checkbox" name="items[]" value="' . $item->Item_name . '">' . '&nbsp;' . $item->Item_name . '</td>' . '<td> <img src="' . $item->Item_image . '" alt="' . $item->Item_name . 'picture"/> </td> <td> Price: ' . $item->Item_price . '</td></tr>';
//     }
//     echo "</Table>";
// 

// <input type="submit" name="deleteMeals" value="Delete Checked Meals">
// </form>

// <?php
// }

function editMealForm()
{
    $id = $_GET['item'];
    $item = getItem($id);
    if (isset($_POST['add-meal-submit'])) {
        //edit Meal
        $name = $_POST['meal-name'];
        $desc = $_POST['meal-desc'];
        $price = $_POST['meal-price'];
        $mealID = $_POST['meal-menu'];
        if (!empty($_FILES['meal-file']['name'])) {
            $image = uploadFile('meal-file');
            updateMealWithImage($id, $name, $desc, $price, $image, $mealID);
        } else {
            updateMealWithoutImage($id, $name, $desc, $price, $mealID);
        }
        header('Location:dashboard.php?page=meals');
        // insertMeal($name, $desc, $price, $mealID, $image);
    }
    echo '<div class="row">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">

                    <h4 class="add-meal-header">Add Meal:</h4>

                    <form class="dashboard-form" method="post"
                        action="dashboard.php?page=editMeal&item=' . $id . '" enctype="multipart/form-data">
            <label for="meal-menu">Menu:</label>
            <select name="meal-menu" required>';
    $menus = getMenus();
    foreach ($menus as $menu) {
        if ($item->Menu_idMenu == $menu->idMenu)
            echo '<option selected value="' . $menu->idMenu . '">' . $menu->Menu_name . '</option>';
        else
            echo '<option value="' . $menu->idMenu . '">' . $menu->Menu_name . '</option>';
    }
    echo ' </select>
            <label for="meal-name">Meal Name:</label>
            <input type="text" name="meal-name" id="meal-name" value=' . $item->Item_name . ' required>
            <label for="meal-desc">Meal Description:</label>
            <textarea name="meal-desc" id="meal-desc" required >' . $item->Item_description . '  </textarea>
            <label for="meal-price">Meal Price:</label>
            <input type="text" inputmode="numeric" pattern="[0-9]*"  name="meal-price" id="meal-price" value=' . $item->Item_price . ' required>
            <label for="meal-file">Image:</label>
            <input type="file" name="meal-file" id="meal-file" accept="image/*" >
            <input type="submit" name="add-meal-submit" value="Edit Meal">

            </form>
            </div>
            </div>';
}
function updateMealWithImage($id, $name, $desc, $price, $image, $mealID)
{
    $connection = OpenConnection();
    //   $query1 = 'update item set (Item_name,Item_description,Item_price,Item_image,Menu_idMenu) = (?,?,?,?,?) where idItem=?';
    $query = 'update item set Item_name=? , Item_description=? , Item_price=? , Item_image=? , Menu_idMenu=? where idItem=? ';
    $statement = $connection->prepare($query);
    $statement->bind_param('ssisii', $name, $desc, $price, $image, $mealID, $id);
    $statement->execute();
    echo $statement->execute();
    CloseConnection($connection);
}
function updateMealWithoutImage($id, $name, $desc, $price, $mealID)
{
    $connection = OpenConnection();
    $query = 'update item set Item_name=? , Item_description=? , Item_price=? , Menu_idMenu=? where idItem=? ';
    $statement = $connection->prepare($query);
    $statement->bind_param('sssss', $name, $desc, $price, $mealID, $id);
    $res = $statement->execute();
    echo $res;
    CloseConnection($connection);
}
function editOfferForm()
{
    $id = $_GET['offer'];
    $offer = getOffer($id);
    $item = getItem($offer->Item_idItem);
    if (isset($_POST['add-offer-submit'])) {
        //edit Reservation in database
        $menuID = $_POST['offer-menu'];
        if ($menuID == 0) {
            echo 'Please Select a Menu';
        } else {
            $mealID = $_POST['offer-meal'];
            if ($mealID == 0) {
                echo 'Please Select a Meal';
            } else {
                $offerName = $_POST['offer-name'];
                $offerDiscount = $_POST['offer-discount'];
                $offerDuration = $_POST['offer-duration'];
                editOffer($id, $mealID, $offerName, $offerDiscount, $offerDuration);
                header('Location:dashboard.php?page=offers');
            }
        }
    }

    echo '  <div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">

        <h4 class="add-offer-header">Add Offer:</h4>

        <form class="dashboard-form" method="post" action="dashboard.php?page=editOffer&offer=' . $id . '">
            <label for="offer-menu">Meal:</label>
            <select name="offer-menu" id="offer-menu" onchange="populate(this.value);" required>';
    echo '<option value="0" selected>Select Menu</option>';
    $menus = getMenus();
    foreach ($menus as $menu) {
        if ($item->Menu_idMenu == $menu->idMenu)
            echo '<option selected value="' . $menu->idMenu . '">' . $menu->Menu_name . '</option>';
        else
            echo '<option value="' . $menu->idMenu . '">' . $menu->Menu_name . '</option>';
    }
    echo '</select>
            <label for="offer-meal">Menu:</label>
            <select name="offer-meal" id="offer-meal" required>
            
            <option selected value="' . $item->idItem . '">' . $item->Item_name . '</option>
            ' .
        $items = getMenuItems($item->Menu_idMenu);
    foreach ($items as $meal) {
        if ($meal->idItem != $item->idItem)
            echo '<option value="' . $meal->idItem . '">' . $meal->Item_name . '</option>';
    }
    echo '
            </select>
            <label for="offer-name">Offer Name:</label>
            <input type="text" name="offer-name" id="offer-name" value="' . $offer->Offer_name . '" required>
            <label for="offer-discount">Discount Percent:</label>
            <input type="text" inputmode="numeric" pattern="[0-9]*" name="offer-discount" id="offer-discount" value="' . $offer->offer_discount . '" required>
            <label for="offer-duration">Duration:</label>
            <input type="text" inputmode="numeric" pattern="[0-9]*" name="offer-duration" id="offer-duration" value="' . $offer->Offer_duration . '" required>
            <input type="submit" name="add-offer-submit" value="Edit Offer">

        </form>
    </div>
</div>
';
}
function editOffer($id, $mealID, $offerName, $offerDiscount, $offerDuration)
{
    $connection = OpenConnection();
    $query = 'update offers set Offer_name=? , offer_discount=? , Offer_duration=?, Item_idItem=? where Offer_ID=?';
    $statement = $connection->prepare($query);
    $statement->bind_param('siiii', $offerName, $offerDiscount, $offerDuration, $mealID, $id);
    $statement->execute();
    CloseConnection($connection);
}
function displayMenu()
{
    if (isset($_GET['menu'])) {
        $id = $_GET['menu'];
    }
    $arrayItems = getMenuItems($id);
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        deleteItem($id);
    }
    if (isset($_POST['edit'])) {
        $id = $_POST['edit'];
        header('Location:dashboard.php?page=editMeal&item=' . $id);
    }

    echo '<form class="edit-delete-form" action="dashboard.php?page=meals" method="POST"> 
    <h3>' . getMenuName($id) . ':</h3>
    <table class="display-table">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Menu</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Image</th>
                            </tr>';
    foreach ($arrayItems as $item) {
        echo '<tr>
                                <td>' . $item->idItem . '</td>
                                <td>' . $item->Item_name . '</td>
                                <td>' . getMenuName($item->Menu_idMenu) . '</td>
                                <td>' . $item->Item_description . '</td>
                                <td>' . $item->Item_price . '</td>
                                <td><img class="img-fluid" src="../' . $item->Item_image . '" ></td>
                                <td><div class="edit-delete">
                                <button  name="edit" type="submit" value="' . $item->idItem . '">Edit</button>
                                <button  name="delete" type="submit" value="' . $item->idItem . '">Delete</button>
                                </div></td>
                                </tr>';
    }
    echo '</table></form>';
}
function insertReservation($name, $phone, $numplaces, $date, $time)
{
    $connection = OpenConnection();
    $query = 'insert into reservations (Reservation_name ,Reservation_phone,Reservation_date,Reservation_time,Reservation_count) values (?,?,?,?,?)';
    $statement = $connection->prepare($query);
    $statement->bind_param('sssss', $name, $phone, $date, $time, $numplaces);
    $statement->execute();
    CloseConnection($connection);
}
function editReservation($id, $name, $phone, $numplaces, $date, $time)
{
    $connection = OpenConnection();
    $query = 'update offers set Reservation_name=? , Reservation_phone=? , Reservation_date=?, Reservation_time=?,Reservation_count=? where Reservation_ID=?';
    $statement = $connection->prepare($query);
    $statement->bind_param('ssssss', $name, $phone, $date, $time, $numplaces, $id);
    $statement->execute();
    CloseConnection($connection);
}
function editReservationForm()
{
    $id = $_GET['reservation'];
    $reservation = getReservation($id);
    if (isset($_POST["add-reservation-submit"])) {

        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $numplaces = $_POST["number-places"];
        $date = $_POST["reservation-date"];
        $time = $_POST['reservation-time'];
        editReservation($id, $name, $phone, $numplaces, $date, $time);
        $flag = 1;
    }

    echo '<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">

        <h4 class="dashboard-form-header">Add Reservation:</h4>';
    if (isset($flag) && $flag == 1) {
        echo '<p class="success-message">Reservation Edited.</p>';
    }
    echo '<form class="dashboard-form" method="POST"
            action="dashboard.php?page=addReservation">
            <label for="name">Full Name:</label>
                        <input type="text" name="name" id="name" value="' . $reservation->Reservation_name . '" required>
                        <label for="phone">Phone Number:</label>
                        <input type="text" inputmode="numeric" pattern="[0-9]*" name="phone" id="phone" value="' . $reservation->Reservation_phone . '" required>
                        <label for="number-places">Number of Seats:</label>
                        <select size="1" name="number-places" id="number-places" required>
                            <option value=""  hidden>Select Number of Seats</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option selected value="' . $reservation->Reservation_count . '">' . $reservation->Reservation_count . '</option>
                        </select>
                        <label for="reservation-date">Date:</label>
                        <input type="date" name="reservation-date" min="' . date('Y-m-d') . '" value="' . $reservation->Reservation_date . '" required>
<label for="reservation-time">Time:</label>
<input type="time" name="reservation-time" value="' . $reservation->Reservation_time . '" required>
<input type="submit" name="add-reservation-submit" value="Make Reservation">
</form>
</div>
</div>';
}
function addAdministratorForm()
{

    if (isset($_POST["add-admin-submit"])) {

        $username = $_POST["admin-username"];
        $password = $_POST["admin-password"];
        if (isset($_POST["admin-superadmin"])) {
            $superadmin = true;
        } else
            $superadmin = false;
        insertAdmin($username, $password, $superadmin);
    }
    echo '<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">

        <h4 class="dashboard-form-header">Add Administrator:</h4>

        <form class="dashboard-form" method="POST"
            action="dashboard.php?page=addAdmins">
            <label for="admin-username">Username:</label>
                        <input type="text" name="admin-username" id="admin-name" required>
                        <label for="admin-password">Password:</label>
                        <input type="password" name="admin-password" id="admin-password" required>
                        <div class=" row isAdminCheck">
                        <div class="col-xs-8 col-lg-8 col-sm-8 col-md-8">
                            <label for="admin-superadmin">Super Admin</label>
                            <input type="checkbox" id="admin-superadmin" value="true" name="admin-superadmin">
                        </div>

<input type="submit" name="add-admin-submit" value="Add Admin">
</form>
</div>
</div>';
}
function insertAdmin($username, $password, $superadmin)
{
    if (getAdministrator($username) != null) {
        echo '<p class="success-message">Username already exists</p>';
        return;
    }

    $connection = OpenConnection();
    $query = 'insert into Administrator (Administrator_username ,Admin_password,isSuper ) values (?,?,?)';
    $statement = $connection->prepare($query);
    $statement->bind_param('sss', $username, $password, $superadmin);
    $statement->execute();
    CloseConnection($connection);
    header('Location:dashboard.php?page=admins');
}
function changeAdminForm()
{
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        deleteAdmin($id);
        if ($id == $_SESSION['admin']->idAdministrator) {
            header('Location:admin-login.php?logout=1');
        }
    }
    if (isset($_POST['edit'])) {
        $id = $_POST['edit'];
        header('Location:dashboard.php?page=editAdmin&admin=' . $id);
    }

    $arrayAdmins = getAdministrators();
    echo '<form class="edit-delete-form" action="dashboard.php?page=admins" method="POST"> ';

    echo '<h3>Adminstrator:</h3>';

    echo '<table class="display-table">
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>SuperAdmin</th>
                               

                            </tr>';
    foreach ($arrayAdmins as $admin) {
        echo '<tr>
                                <td>' . $admin->idAdministrator . '</td>
                                <td>' . $admin->Administrator_username . '</td>
                              
                                <td>' . $admin->Admin_password . '</td>
                                <td>';
        if ($admin->isSuper == 1)
            echo 'true';
        else
            echo 'false';
        echo '</td>';
        if ($admin->isSuper == 0 || ($admin->isSuper == 1 && $_SESSION['admin']->idAdministrator == $admin->idAdministrator))
            echo '   <td><div class="edit-delete">
                                <button  name="edit" type="submit" value="' . $admin->idAdministrator . '">Edit</button>
                                <button  name="delete" type="submit" value="' . $admin->idAdministrator . '">Delete</button>
                                </div></td>
                                </tr>';
    }
    echo '</table></form>';
}
function  deleteAdmin($id)
{
    $connection = OpenConnection();
    $query = 'DELETE FROM Administrator WHERE idAdministrator = ? ';
    $statement = $connection->prepare($query);
    $statement->bind_param('s', $id);
    $statement->execute();
    CloseConnection($connection);
}
function updateAdmin($id, $username, $password, $isSuper)
{

    $connection = OpenConnection();
    $query1 = "SELECT * FROM administrator where Administrator_username =?  and idAdministrator!=?";
    $statement = $connection->prepare($query1);
    $statement->bind_param('ss', $username, $id);
    $statement->execute();
    $result = $statement->get_result()->fetch_object();
    if (!$result) {
        if (empty($password)) {
            $query = 'update Administrator set Administrator_username=? , isSuper=? where idAdministrator=?';
            $statement = $connection->prepare($query);
            $statement->bind_param('sss', $username, $isSuper, $id);
        } else {
            $query = 'update Administrator set Administrator_username=? , Admin_password=? ,isSuper=? where idAdministrator=? ';
            $statement = $connection->prepare($query);
            $statement->bind_param('ssss', $username, $password, $isSuper, $id);
        }
        $statement->execute();
        CloseConnection($connection);
    } else
        echo '<p class="success-message">Username already exists.</p>';
}
function editAdminForm()
{

    if (($_SESSION['admin']->isSuper == 0)) {
        header('Location:dashboard.php');
    }
    $id = $_GET['admin'];
    $admin = getAdministratorById($id);
    if (isset($_POST["edit-admin-submit"])) {

        $username = $_POST["admin-username"];
        if (!isset($_POST["admin-password"])) {
            $password = "";
        } else

            $password = $_POST["admin-password"];
        if (isset($_POST["admin-superadmin"])) {
            $superadmin = true;
        } else
            $superadmin = false;

        updateAdmin($id, $username, $password, $superadmin);


        if ($id == $_SESSION['admin']->idAdministrator) {
            session_destroy();
            session_start();
            $_SESSION['loggedin'] = 1;
            $_SESSION['admin'] = getAdministratorById($id);


            header('Location:dashboard.php');
        } else
            header('Location:dashboard.php?page=admins');
    }

    echo '<div class="row">
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">

        <h4 class="dashboard-form-header">Edit Administrator:</h4>

        <form class="dashboard-form" method="POST"
            action="dashboard.php?page=editAdmin&admin=' . $id . '">
            <label for="admin-username">Username:</label>
                        <input type="text" name="admin-username" id="admin-name" value="' . $admin->Administrator_username . '" required>
                        <label for="admin-password">Password:</label>
                        <input type="password" name="admin-password" id="admin-password" placeholder="Leave empty if not willing to change" >
                        <div class=" row isAdminCheck">
                        <div class="col-xs-8 col-lg-8 col-sm-8 col-md-8">
                            <label for="admin-superadmin">Super Admin</label>
                            <input type="checkbox" id="admin-superadmin" value="true" name="admin-superadmin"';
    if ($admin->isSuper == 1) echo 'checked';
    echo '>
                        </div>

<input type="submit" name="edit-admin-submit" value="Edit Admin">
</form>
</div>
</div>';
}
function insertFeedback($name, $email, $message)
{
    $connection = OpenConnection();
    $query = 'insert into feedbacks (Feedback_name,Feedback_email,Feedback_description) values (?,?,?)';
    $statement = $connection->prepare($query);
    $statement->bind_param('sss', $name, $email, $message);
    $statement->execute();
    CloseConnection($connection);
}