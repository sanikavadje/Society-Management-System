<?php
include "config.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {

    $id = (int)$_GET['id'];

    $conn->query("DELETE FROM complaints WHERE id=$id");
}

header("Location: view_complaints.php");
exit();
?>