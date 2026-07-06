<?php
include "config.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: view_notices.php");
    exit();
}

$id = (int)$_GET['id'];

if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $message = $_POST['message'];
    $date = $_POST['date'];

    $sql = "UPDATE notices SET
            title='$title',
            message='$message',
            date='$date'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_notices.php");
        exit();
    } else {
        echo "Update Error: " . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM notices WHERE id=$id");

if ($result->num_rows == 0) {
    die("Notice not found.");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Notice</title>

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
background:white;
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
height:120px;
resize:none;
}

button{
width:100%;
padding:14px;
background:#1e3c72;
color:white;
border:none;
border-radius:8px;
font-size:16px;
cursor:pointer;
}

button:hover{
background:#16325c;
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

<h2>✏️ Edit Notice</h2>

<form method="POST">

<label>Notice Title</label>

<input
type="text"
name="title"
value="<?php echo htmlspecialchars($row['title']); ?>"
required>

<label>Notice Message</label>

<textarea
name="message"
required><?php echo htmlspecialchars($row['message']); ?></textarea>

<label>Date</label>

<input
type="date"
name="date"
value="<?php echo $row['date']; ?>"
required>

<button type="submit" name="update">
Update Notice
</button>

</form>

<a href="view_notice.php" class="back">← Back to Notices</a>

</div>

</body>
</html>