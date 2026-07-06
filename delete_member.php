<?php
include "config.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM members WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: members.php");
        exit();
    } else {
        echo "Error deleting member.";
    }

} else {
    header("Location: members.php");
    exit();
}
?>