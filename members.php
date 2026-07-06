<?php
include "config.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM members");
?>

<!DOCTYPE html>
<html>
<head>

<title>View Members</title>

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
    width:90%;
    margin:40px auto;
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

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#1e3c72;
    color:white;
    padding:15px;
}

table td{
    padding:15px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f2f2f2;
}

.btn{
    text-decoration:none;
    padding:8px 14px;
    border-radius:6px;
    color:white;
    font-size:14px;
}

.edit{
    background:#ffc107;
}

.delete{
    background:#dc3545;
}

.back{
    display:inline-block;
    margin-top:20px;
    padding:12px 20px;
    background:#1e3c72;
    color:white;
    text-decoration:none;
    border-radius:8px;
}

.back:hover{
    background:#16325c;
}

</style>

</head>

<body>

<div class="container">

<h2>👥 Society Members</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Flat No.</th>
<th>Phone</th>
<th>Edit</th>
<th>Delete</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td><?php echo htmlspecialchars($row['flat_no']); ?></td>

<td><?php echo htmlspecialchars($row['phone']); ?></td>

<td>
<a href="edit_member.php?id=<?php echo $row['id']; ?>" class="btn edit">Edit</a>
</td>

<td>
<a href="#" class="btn delete"
onclick="confirmDelete(<?php echo $row['id']; ?>)">
Delete
</a>
</td>

</tr>

<?php } ?>

</table>

<a href="dashboard.php" class="back">← Back to Dashboard</a>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(id){

Swal.fire({
title: 'Delete Member?',
text: 'This member will be permanently deleted.',
icon: 'warning',

showCancelButton: true,

confirmButtonColor: '#d33',
cancelButtonColor: '#3085d6',

confirmButtonText: 'Yes, Delete',
cancelButtonText: 'Cancel'

}).then((result)=>{

if(result.isConfirmed){

window.location = "delete_member.php?id=" + id;

}

});

}
</script>

</body>
</html>