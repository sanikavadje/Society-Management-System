<?php
include "config.php";
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['save'])){

    $flat_no = $_POST['flat_no'];
    $complaint = $_POST['complaint'];
    $complaint_date = $_POST['complaint_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO complaints(flat_no, complaint, complaint_date, status)
            VALUES('$flat_no','$complaint','$complaint_date','$status')";

    if($conn->query($sql)==TRUE){

        echo "<script>
        alert('Complaint Added Successfully!');
        window.location='view_complaints.php';
        </script>";

    }else{

        echo 'Error : '.$conn->error;

    }

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Add Complaint</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

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

display:block;
font-weight:600;
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

<h2>📝 Add Complaint</h2>

<form method="POST">

<label>Flat Number</label>

<input
type="text"
name="flat_no"
placeholder="Example: A-101"
required>

<label>Complaint</label>

<textarea
name="complaint"
placeholder="Enter Complaint"
required></textarea>

<label>Complaint Date</label>

<input
type="date"
name="complaint_date"
required>

<label>Status</label>

<select name="status" required>

<option value="">Select Status</option>

<option value="Pending">Pending</option>

<option value="In Progress">In Progress</option>

<option value="Resolved">Resolved</option>

</select>

<button
type="submit"
name="save">

Save Complaint

</button>

</form>

<a href="dashboard.php" class="back">
← Back to Dashboard
</a>

</div>

</body>
</html>