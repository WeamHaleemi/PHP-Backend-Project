<?php

include 'dbConnection.php';


function getMenus()
{
    $connection = OpenConnection();
    $menu = array();
    $query = "SELECT * FROM menu";
    $statement = $connection->query($query);
    while ($result = $statement->fetch_object()) {

        array_push($menu, $result);
    }
    CloseConnection($connection);
    return $menu;
}
function getMenuItems($menuID)
{
    $connection = OpenConnection();
    $items = array();
    $query = "SELECT * FROM item where Menu_idMenu=?";
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $menuID);
    $statement->execute();
    $result = $statement->get_result();
    while ($item = $result->fetch_object()) {
        array_push($items, $item);
    }
    CloseConnection($connection);
    return $items;
}
function getItem($ItemId)
{
    $connection = OpenConnection();
    $query = "SELECT * FROM item where idItem=?";
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $ItemId);
    $statement->execute();
    $result = $statement->get_result()->fetch_object();
    CloseConnection($connection);
    return $result;
}

function getItems()
{
    $menus = getMenus();
    $items = array();
    foreach ($menus as $menu) {
        $items = array_merge($items, getMenuItems($menu->idMenu));
    }
    return $items;
}

function getOffer($id)
{
    $connection = OpenConnection();
    $query = "SELECT * FROM offers where Offer_ID=?";
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $id);
    $statement->execute();
    $result = $statement->get_result()->fetch_object();
    CloseConnection($connection);
    return $result;
}
function getOffers()
{
    $connection = OpenConnection();
    $query = "SELECT * FROM offers";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $items = array();
    while ($item = $result->fetch_object()) {
        array_push($items, $item);
    }
    CloseConnection($connection);
    return $items;
}
function getReservations()
{
    $connection = OpenConnection();
    $query = "SELECT * FROM reservations";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $items = array();
    while ($item = $result->fetch_object()) {
        array_push($items, $item);
    }
    CloseConnection($connection);
    return $items;
}

function getFeedbacks()
{
    $connection = OpenConnection();
    $query = "SELECT * FROM feedbacks";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $items = array();
    while ($item = $result->fetch_object()) {
        array_push($items, $item);
    }
    CloseConnection($connection);
    return $items;
}

function getAdministrators()
{
    $connection = OpenConnection();
    $query = "SELECT * FROM administrator";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $items = array();
    while ($item = $result->fetch_object()) {
        array_push($items, $item);
    }
    CloseConnection($connection);
    return $items;
}

function getUsers()
{
    $connection = OpenConnection();
    $query = "SELECT * FROM administrator";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $items = array();
    while ($item = $result->fetch_object()) {
        array_push($items, $item);
    }
    CloseConnection($connection);
    return $items;
}
function getAdministrator($username)
{

    $connection = OpenConnection();
    $query = "SELECT * FROM administrator where Administrator_username =? ";
    $statement = $connection->prepare($query);
    $statement->bind_param('s', $username,);
    $statement->execute();
    $result = $statement->get_result()->fetch_object();
    CloseConnection($connection);
    return $result;
}
function getMenuName($id)
{
    $connection = OpenConnection();
    $query = "SELECT * FROM menu where idMenu =?";
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $id);
    $statement->execute();
    $result = $statement->get_result()->fetch_object();
    CloseConnection($connection);
    return $result->Menu_name;
}
function getItemName($id)
{
    $connection = OpenConnection();
    $query = "SELECT * FROM Item where idItem =?";
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $id);
    $statement->execute();
    $result = $statement->get_result()->fetch_object();
    CloseConnection($connection);
    return $result->Item_name;
}
function getItemsCount($id)
{
    $connection = OpenConnection();
    $query = "SELECT COUNT(*) as count FROM item where Menu_idMenu=?";
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $id);
    $statement->execute();
    $result = $statement->get_result()->fetch_object();
    CloseConnection($connection);
    return $result->count;
}
function login($username, $password)
{

    $connection = OpenConnection();
    $query = "SELECT *  FROM administrator where  Administrator_username=? and  Admin_password=?";
    $statement = $connection->prepare($query);
    $statement->bind_param('ss', $username, $password);
    $statement->execute();
    $result = $statement->get_result();
    if ($result->num_rows > 0)
        return true;
    else
        return false;
}
function getlatestOffers()
{
    $connection = OpenConnection();
    $query = "SELECT * FROM offers Limit 5";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $items = array();
    while ($item = $result->fetch_object()) {
        array_push($items, $item);
    }
    CloseConnection($connection);
    return $items;
}
function getLatestFeedbacks()
{
    $connection = OpenConnection();
    $query = "SELECT * FROM feedbacks limit 5";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $items = array();
    while ($item = $result->fetch_object()) {
        array_push($items, $item);
    }
    CloseConnection($connection);
    return $items;
}
function getLatestReservations()
{
    $connection = OpenConnection();
    $query = "SELECT * FROM reservations limit 5";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    $items = array();
    while ($item = $result->fetch_object()) {
        array_push($items, $item);
    }
    CloseConnection($connection);
    return $items;
}
function getReservation($id)
{
    $connection = OpenConnection();
    $query = "SELECT * FROM reservations where Reservation_ID=?";
    $statement = $connection->prepare($query);
    $statement->bind_param('s', $id);
    $statement->execute();
    $result = $statement->get_result()->fetch_object();
    CloseConnection($connection);
    return $result;
}
function getAdministratorById($id)
{
    $connection = OpenConnection();
    $query = "SELECT * FROM administrator where idAdministrator =? ";
    $statement = $connection->prepare($query);
    $statement->bind_param('s', $id,);
    $statement->execute();
    $result = $statement->get_result()->fetch_object();
    CloseConnection($connection);
    return $result;
}