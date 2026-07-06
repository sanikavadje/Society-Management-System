<?php
include "config.php";
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM notices ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>View Notices</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

body{
    font-family:'Inter',sans-serif;
    background:#f4f6f9;
    margin:0;
}

.container{
    width:90%;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

h2{
    text-align:center;
    color:#1e3c72;
    margin-bottom:30px;
}

.top{
    display:flex;
    justify-content:space-between;
    margin-bottom:20px;
}

.top a{
    text-decoration:none;
    color:white;
    background:#1e3c72;
    padding:10px 18px;
    border-radius:8px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#1e3c72;
    color:white;
    padding:15px;
}

td{
    padding:15px;
    border-bottom:1px solid #ddd;
    text-align:center;
}

tr:hover{
    background:#f5f5f5;
}

.edit{
    background:#ffc107;
    color:black;
    padding:8px 15px;
    border-radius:6px;
    text-decoration:none;
}

.delete{
    background:#dc3545;
    color:white;
    padding:8px 15px;
    border-radius:6px;
    text-decoration:none;
}

</style>

</head>

<body>

<div class="container">

<h2>📢 Society Notices</h2>

<div class="top">

<a href="dashboard.php">🏠 Dashboard</a>

<a href="add_notice.php">➕ Add Notice</a>

</div>

<table>

<tr>

<th>ID</th>
<th>Title</th>
<th>Message</th>
<th>Date</th>
<th>Edit</th>
<th>Delete</th>

</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['message']; ?></td>

<td><?php echo $row['date']; ?></td>

<td>

<a class="edit"
href="edit_notice.php?id=<?php echo $row['id']; ?>">
Edit
</a>

</td>

<td>

<a class="delete"
href="#"
onclick="confirmDelete(<?php echo $row['id']; ?>)">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function confirmDelete(id){

Swal.fire({

title:'Delete Notice?',
text:'This notice will be permanently deleted.',
icon:'warning',

showCancelButton:true,

confirmButtonColor:'#d33',
cancelButtonColor:'#3085d6',

confirmButtonText:'Yes, Delete',
cancelButtonText:'Cancel'

}).then((result)=>{

if(result.isConfirmed){

window.location="delete_notice.php?id="+id;

}

});

}

</script>

</body>
</html>