<?php
include "config.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: view_bill.php");
    exit();
}

$id = (int)$_GET['id'];

if (isset($_POST['update'])) {

    $flat_no = $_POST['flat_no'];
    $amount = $_POST['amount'];
    $bill_month = $_POST['bill_month'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $sql = "UPDATE bills SET
            flat_no='$flat_no',
            amount='$amount',
            bill_month='$bill_month',
            due_date='$due_date',
            status='$status'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_bill.php");
        exit();
    } else {
        echo "Update Error: " . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM bills WHERE id=$id");

if ($result->num_rows == 0) {
    die("Bill not found.");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Bill</title>

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
select{
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

<h2>✏️ Edit Bill</h2>

<form method="POST">

<label>Flat Number</label>

<input
type="text"
name="flat_no"
value="<?php echo htmlspecialchars($row['flat_no']); ?>"
required>

<label>Amount (₹)</label>

<input
type="number"
name="amount"
value="<?php echo $row['amount']; ?>"
required>

<label>Bill Month</label>

<input
type="text"
name="bill_month"
value="<?php echo htmlspecialchars($row['bill_month']); ?>"
required>

<label>Due Date</label>

<input
type="date"
name="due_date"
value="<?php echo $row['due_date']; ?>"
required>

<label>Status</label>

<select name="status" required>

<option value="Pending" <?php if($row['status']=="Pending") echo "selected"; ?>>
Pending
</option>

<option value="Paid" <?php if($row['status']=="Paid") echo "selected"; ?>>
Paid
</option>

</select>

<button type="submit" name="update">
Update Bill
</button>

</form>

<a href="view_bill.php" class="back">
← Back to Bills
</a>

</div>

</body>
</html>