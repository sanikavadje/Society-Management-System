<?php
include "config.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$message = "";

if (isset($_POST['add_member'])) {

    $name = $_POST['name'];
    $flat_no = $_POST['flat_no'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO members(name, flat_no, phone)
            VALUES('$name','$flat_no','$phone')";

    if ($conn->query($sql) === TRUE) {
        $message = "Member added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Member</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Inter',sans-serif;
}

body{
    background:#f4f6f9;
}

.container{
    width:500px;
    margin:60px auto;
    background:#fff;
    padding:35px;
    border-radius:15px;
    box-shadow:0 8px 20px rgba(0,0,0,.1);
}

h2{
    text-align:center;
    color:#1e3c72;
    margin-bottom:25px;
}

label{
    font-weight:600;
}

input{
    width:100%;
    padding:12px;
    margin-top:8px;
    margin-bottom:20px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:15px;
}

button{
    width:100%;
    padding:14px;
    border:none;
    background:#1e3c72;
    color:white;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#16325c;
}

.success{
    background:#d4edda;
    color:#155724;
    padding:12px;
    border-radius:8px;
    margin-bottom:20px;
    text-align:center;
}

.back{
    display:block;
    margin-top:20px;
    text-align:center;
    text-decoration:none;
    color:#1e3c72;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h2>👥 Add Member</h2>

<?php
if($message!=""){
    echo "<div class='success'>$message</div>";
}
?>

<form method="POST">

<label>Member Name</label>
<input type="text" name="name" required>

<label>Flat Number</label>
<input type="text" name="flat_no" required>

<label>Phone Number</label>
<input type="text" name="phone" required>

<button type="submit" name="add_member">
Add Member
</button>

</form>

<a href="dashboard.php" class="back">← Back to Dashboard</a>

</div>

</body>
</html>