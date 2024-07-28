<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db = 'projecttododb';

$conn = null;

try {
    $conn = mysqli_connect($host, $username, $password, $db);
} catch (Exception $e) {
    echo "could not connect";
}
