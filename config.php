<?php
$conn = new mysqli("localhost", "root", "", "society_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>