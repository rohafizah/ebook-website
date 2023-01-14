<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "madad";

$connect = mysqli_connect($hostname, $username, $password, $db_name);