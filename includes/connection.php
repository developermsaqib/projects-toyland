<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'toystore1';

$conn = mysqli_connect($hostname, $username, $password, $database);
global $conn;
if (!$conn) {
    die("Connection Error");
}
