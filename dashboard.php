<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
include "config.php";

// Total Members
$members = $conn->query("SELECT COUNT(*) AS total FROM members");
$memberCount = $members->fetch_assoc()['total'];

// Total Notices
$notices = $conn->query("SELECT COUNT(*) AS total FROM notices");
$noticeCount = $notices->fetch_assoc()['total'];

// Total Bills
$bills = $conn->query("SELECT COUNT(*) AS total FROM bills");
$billCount = $bills->fetch_assoc()['total'];

// Total Complaints
$complaints = $conn->query("SELECT COUNT(*) AS total FROM complaints");
$complaintCount = $complaints->fetch_assoc()['total'];

// Latest Notice
$latestNotice = $conn->query("SELECT title, message FROM notices ORDER BY id DESC LIMIT 1");
$latest = $latestNotice->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

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
    display:flex;
}

/* ================= SIDEBAR ================= */

.sidebar{
    width:250px;
    height:100vh;
    background:linear-gradient(180deg,#1e3c72,#2a5298);
    color:white;
    position:fixed;
    padding:20px;
    overflow-y:auto;
}

.sidebar h2{
    text-align:center;
    margin-bottom:30px;
    font-size:28px;
}

.menu-box{
    display:block;
    text-decoration:none;
    color:white;
    background:rgba(255,255,255,.15);
    padding:14px;
    margin:12px 0;
    border-radius:10px;
    text-align:center;
    transition:.3s;
    font-weight:500;
}

.menu-box:hover{
    background:white;
    color:#1e3c72;
    transform:translateX(6px);
}

/* ================= MAIN ================= */

.main{
    margin-left:250px;
    width:100%;
    padding:30px;
}

/* ================= HEADER ================= */

.header{
    background:white;
    border-radius:15px;
    padding:30px 20px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
    margin-bottom:30px;
}

.header h1{
    font-size:32px;
    color:#1e3c72;
    font-weight:700;
    margin:0;
    text-align:center;
}

.dashboard-title{
    margin-top:10px;
    font-size:18px;
    color:#666;
    font-weight:500;
    text-align:center;
}

/* ================= CARDS ================= */

.cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:25px;
}

.card{
    background:white;
    border-radius:15px;
    padding:25px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
    cursor:pointer;
    transition:.3s;
}

.card:hover{
    transform:translateY(-8px);
}

.member{
    border-left:6px solid #00c6ff;
}

.notice{
    border-left:6px solid #ff9800;
}

.bill{
    border-left:6px solid #28a745;
}
.complaint{
border-left:6px solid #dc3545;
}

.card h1{
font-size:42px;
color:#1e3c72;
margin:15px 0;
}

.card h3{
    margin-bottom:10px;
    color:#333;
}

.card p{
    color:#666;
    line-height:1.5;
}

/* ================= RESPONSIVE ================= */

@media(max-width:900px){

.sidebar{
    width:200px;
}

.main{
    margin-left:200px;
}

.cards{
    grid-template-columns:1fr;
}

}

</style>

</head>

<body>

<!-- Sidebar -->

<div class="sidebar">

    <h2>🏢 Society Panel</h2>

<a href="dashboard.php" class="menu-box">🏠 Dashboard</a>

<a href="add_member.php" class="menu-box">➕ Add Member</a>
<a href="members.php" class="menu-box">👥 View Members</a>

<a href="add_notice.php" class="menu-box">➕ Add Notice</a>
<a href="view_notices.php" class="menu-box">📢 View Notices</a>

<a href="add_bill.php" class="menu-box">💰 Add Bill</a>
<a href="view_bill.php" class="menu-box">📄 View Bills</a>

<a href="add_complaint.php" class="menu-box">📝 Add Complaint</a>
<a href="view_complaints.php" class="menu-box">📋 View Complaints</a>

<a href="logout.php" class="menu-box">🚪 Logout</a>
</div>

<!-- Main -->

<div class="main">

    <!-- Welcome Header -->

    <div class="header">

        <h1>Welcome, <?php echo htmlspecialchars($user); ?> 👋</h1>

        <div class="dashboard-title">
         Society Management Dashboard
        </div>
        <div id="datetime" style="margin-top:15px;font-size:18px;color:#555;font-weight:600;"></div>

    </div>

    <!-- Cards -->

    <div class="cards">

<div class="card member" onclick="window.location='members.php'">

<h3>👥 Members</h3>

<h1><?php echo $memberCount; ?></h1>

<p>Total Society Members</p>

</div>


<div class="card notice" onclick="window.location='view_notices.php'">

<h3>📢 Notices</h3>

<h1><?php echo $noticeCount; ?></h1>

<p>Total Notices</p>

</div>


<div class="card bill" onclick="window.location='view_bill.php'">

<h3>💰 Bills</h3>

<h1><?php echo $billCount; ?></h1>

<p>Total Bills</p>

</div>


<div class="card complaint" onclick="window.location='view_complaints.php'">

<h3>📝 Complaints</h3>

<h1><?php echo $complaintCount; ?></h1>

<p>Total Complaints</p>

</div>

</div>

<br><br>

<div class="header">

<h2 style="color:#1e3c72;">📢 Latest Notice</h2>

<?php if($latest){ ?>

<h3><?php echo htmlspecialchars($latest['title']); ?></h3>

<p style="margin-top:10px;">
<?php echo htmlspecialchars($latest['message']); ?>
</p>

<?php } else { ?>

<p>No notices available.</p>

<?php } ?>

</div>

</div>
<script>

function updateDateTime(){

const now = new Date();

const options = {
weekday:'long',
year:'numeric',
month:'long',
day:'numeric'
};

const date = now.toLocaleDateString('en-IN', options);
const time = now.toLocaleTimeString('en-IN');

document.getElementById("datetime").innerHTML =
"📅 " + date + " | 🕒 " + time;

}

setInterval(updateDateTime,1000);

updateDateTime();

</script>

</body>
</html>