<?php
include "config.php";
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['save'])){

    $flat_no = $_POST['flat_no'];
    $amount = $_POST['amount'];
    $bill_month = $_POST['bill_month'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO bills(flat_no, amount, bill_month, due_date, status)
            VALUES('$flat_no','$amount','$bill_month','$due_date','$status')";

    if($conn->query($sql)==TRUE){
        echo "<script>
        alert('Bill Added Successfully!');
        window.location='view_bill.php';
        </script>";
    }else{
        echo "Error : ".$conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Bill</title>

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
width:500px;
margin:40px auto;
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
select{
width:100%;
padding:12px;
margin-top:8px;
border:1px solid #ccc;
border-radius:8px;
font-size:15px;
}

button{
width:100%;
padding:14px;
margin-top:25px;
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

<h2>💰 Add Maintenance Bill</h2>

<form method="POST">

<label>Flat Number</label>
<input type="text" name="flat_no" placeholder="Example: A-101" required>

<label>Amount (₹)</label>
<input type="number" name="amount" placeholder="Enter Amount" required>

<label>Bill Month</label>
<input type="text" name="bill_month" placeholder="Example: July 2026" required>

<label>Due Date</label>
<input type="date" name="due_date" required>

<label>Status</label>

<select name="status" required>
<option value="">Select Status</option>
<option value="Pending">Pending</option>
<option value="Paid">Paid</option>
</select>

<button type="submit" name="save">
Save Bill
</button>

</form>

<a href="dashboard.php" class="back">
← Back to Dashboard
</a>

</div>

</body>
</html>