<?php

function OpenConnection()
{
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbName = "mydb";

    $connection = new mysqli($host, $user, $password, $dbName);
    if ($connection->connect_errno) {
        echo "Failed to connect to MySQL: " . $connection->connect_error;
        exit();
    }
    return $connection;
}

function CloseConnection($connection)
{
    $connection->close();
}