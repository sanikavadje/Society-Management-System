<?php
include "config.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$message = "";

if (isset($_POST['add_notice'])) {

    $title = $_POST['title'];
    $notice = $_POST['message'];
    $date = $_POST['date'];

   $sql = "INSERT INTO notices(title, message, date)
VALUES('$title', '$notice', '$date')";
    if ($conn->query($sql) === TRUE) {
        $message = "Notice added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Notice</title>

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
    width:550px;
    margin:50px auto;
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

input,
textarea{
    width:100%;
    padding:12px;
    margin-top:8px;
    margin-bottom:20px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:15px;
}

textarea{
    resize:none;
    height:130px;
}

button{
    width:100%;
    padding:14px;
    background:#1e3c72;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
}

button:hover{
    background:#16325c;
}

.success{
    background:#d4edda;
    color:#155724;
    padding:12px;
    border-radius:8px;
    text-align:center;
    margin-bottom:20px;
}

.back{
    display:block;
    text-align:center;
    margin-top:20px;
    text-decoration:none;
    color:#1e3c72;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h2>📢 Add Notice</h2>

<?php
if($message!=""){
    echo "<div class='success'>$message</div>";
}
?>

<form method="POST">

<label>Notice Title</label>

<input
type="text"
name="title"
placeholder="Enter Notice Title"
required>

<label>Notice Message</label>

<textarea
name="message"
placeholder="Write your notice here..."
required></textarea>

<label>Date</label>

<input
type="date"
name="date"
required>

<button type="submit" name="add_notice">
Add Notice
</button>

</form>

<a href="dashboard.php" class="back">← Back to Dashboard</a>

</div>

</body>
</html>