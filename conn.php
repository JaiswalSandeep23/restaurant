<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restro";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: ");
}

