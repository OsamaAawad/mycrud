<?php
// $host = "sql104.infinityfree.com";
// $username = "if0_39598990";             
// $password = "bM0dZocwwKXD2";          
// $db = "if0_39598990_myshop";             

$host = "localhost";
$username = "root";             
$password = "";          
$db = "myshop";             

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
