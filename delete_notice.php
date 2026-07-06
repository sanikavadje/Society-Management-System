<?php
include "config.php";
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){

$id=$_GET['id'];

$conn->query("DELETE FROM notices WHERE id=$id");

header("Location: view_notices.php");
exit();
}
?>