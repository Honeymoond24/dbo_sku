<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dbo';
$connect = mysqli_connect($host, $username, $password, $database);
if (!$connect) {
    die('Error connect to DataBase');
}
function query($connect, $query)
{
    return $connect->query($query);
}
