<?php
include "config.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: members.php");
    exit();
}

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM members WHERE id=$id");

if ($result->num_rows == 0) {
    die("Member not found.");
}

$row = $result->fetch_assoc();

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $flat_no = $_POST['flat_no'];
    $phone = $_POST['phone'];

    $sql = "UPDATE members
            SET name='$name',
                flat_no='$flat_no',
                phone='$phone'
            WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: members.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Member</title>

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
margin:50px auto;
background:white;
padding:30px;
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

<h2>✏️ Edit Member</h2>

<form method="POST">

<label>Name</label>

<input
type="text"
name="name"
value="<?php echo htmlspecialchars($row['name']); ?>"
required>

<label>Flat Number</label>

<input
type="text"
name="flat_no"
value="<?php echo htmlspecialchars($row['flat_no']); ?>"
required>

<label>Phone Number</label>

<input
type="text"
name="phone"
value="<?php echo htmlspecialchars($row['phone']); ?>"
required>

<button type="submit" name="update">
Update Member
</button>

</form>

<a href="members.php" class="back">← Back to Members</a>

</div>

</body>

</html>