<?php
include "config.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: view_complaints.php");
    exit();
}

$id = (int)$_GET['id'];

if (isset($_POST['update'])) {

    $flat_no = $_POST['flat_no'];
    $complaint = $_POST['complaint'];
    $complaint_date = $_POST['complaint_date'];
    $status = $_POST['status'];

    $sql = "UPDATE complaints SET
            flat_no='$flat_no',
            complaint='$complaint',
            complaint_date='$complaint_date',
            status='$status'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_complaints.php");
        exit();
    } else {
        echo "Update Error: " . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM complaints WHERE id=$id");

if ($result->num_rows == 0) {
    die("Complaint not found.");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Complaint</title>

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
display:block;
margin-top:15px;
}

input,
textarea,
select{
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

<h2>✏️ Edit Complaint</h2>

<form method="POST">

<label>Flat Number</label>

<input
type="text"
name="flat_no"
value="<?php echo htmlspecialchars($row['flat_no']); ?>"
required>

<label>Complaint</label>

<textarea
name="complaint"
required><?php echo htmlspecialchars($row['complaint']); ?></textarea>

<label>Complaint Date</label>

<input
type="date"
name="complaint_date"
value="<?php echo $row['complaint_date']; ?>"
required>

<label>Status</label>

<select name="status" required>

<option value="Pending" <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>

<option value="In Progress" <?php if($row['status']=="In Progress") echo "selected"; ?>>In Progress</option>

<option value="Resolved" <?php if($row['status']=="Resolved") echo "selected"; ?>>Resolved</option>

</select>

<button type="submit" name="update">
Update Complaint
</button>

</form>

<a href="view_complaints.php" class="back">
← Back to Complaints
</a>

</div>

</body>
</html>