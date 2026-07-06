<?php
include "config.php";
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM complaints ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>View Complaints</title>

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
margin-bottom:30px;
}

.top{
display:flex;
justify-content:space-between;
margin-bottom:20px;
}

.top a{
text-decoration:none;
background:#1e3c72;
color:white;
padding:10px 18px;
border-radius:8px;
font-weight:600;
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
text-align:center;
border-bottom:1px solid #ddd;
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
font-weight:bold;
}

.delete{
background:#dc3545;
color:white;
padding:8px 15px;
border-radius:6px;
text-decoration:none;
font-weight:bold;
}

.pending{
color:#ff9800;
font-weight:bold;
}

.progress{
color:#2196f3;
font-weight:bold;
}

.resolved{
color:green;
font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h2>📝 Society Complaints</h2>

<div class="top">

<a href="dashboard.php">🏠 Dashboard</a>

<a href="add_complaint.php">➕ Add Complaint</a>

</div>

<table>

<tr>

<th>ID</th>
<th>Flat No</th>
<th>Complaint</th>
<th>Date</th>
<th>Status</th>
<th>Edit</th>
<th>Delete</th>

</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['flat_no']); ?></td>

<td><?php echo htmlspecialchars($row['complaint']); ?></td>

<td><?php echo $row['complaint_date']; ?></td>

<td>

<?php
if($row['status']=="Pending"){
echo "<span class='pending'>Pending</span>";
}
elseif($row['status']=="In Progress"){
echo "<span class='progress'>In Progress</span>";
}
else{
echo "<span class='resolved'>Resolved</span>";
}
?>

</td>

<td>
<a class="edit" href="edit_complaint.php?id=<?php echo $row['id']; ?>">Edit</a>
</td>

<td>
<a class="delete" href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</a>
</td>

</tr>

<?php } ?>

</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function confirmDelete(id){

Swal.fire({

title:'Delete Complaint?',
text:'This complaint will be permanently deleted.',
icon:'warning',

showCancelButton:true,

confirmButtonColor:'#d33',
cancelButtonColor:'#3085d6',

confirmButtonText:'Yes, Delete',
cancelButtonText:'Cancel'

}).then((result)=>{

if(result.isConfirmed){

window.location="delete_complaint.php?id="+id;

}

});

}

</script>

</body>
</html>