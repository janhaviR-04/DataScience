<?php
session_start();

$host = 'localhost';
$user = 'root';    // your MySQL username
$pass = '';        // your MySQL password
$db = 'grocery_shop';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
