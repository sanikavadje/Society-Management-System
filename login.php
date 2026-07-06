<?php
include "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user['name'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid login credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Society Login</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Inter', sans-serif;

    /* 🌆 Background */
    background: url("images/society.jpg") no-repeat center center fixed;
    background-size: cover;

    height: 100vh;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    position: relative;
}

/* DARK OVERLAY */
body::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.55);
    top: 0;
    left: 0;
}

/* TITLE */
.title {
    position: relative;
    z-index: 1;
    color: white;

    font-size: 42px;
    font-weight: 700;

    margin-bottom: 30px;
    text-align: center;
}

/* LOGIN BOX */
.login-box {
    position: relative;
    z-index: 1;

    width: 340px;
    padding: 35px;

    background: rgba(255,255,255,0.95);
    border-radius: 16px;

    box-shadow: 0 20px 50px rgba(0,0,0,0.4);

    text-align: center;
}

/* LOGIN TEXT INSIDE BOX */
.login-box h2 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #111;
    text-align: center;
}

/* INPUTS */
.login-box input {
    width: 100%;
    padding: 12px;

    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 10px;

    font-size: 14px;
    outline: none;
}

.login-box input:focus {
    border-color: #0072ff;
    box-shadow: 0 0 5px rgba(0,114,255,0.3);
}

/* BUTTON */
.login-box button {
    width: 100%;
    padding: 12px;

    margin-top: 15px;

    background: #ff9900;
    border: none;
    border-radius: 10px;

    color: white;
    font-size: 16px;
    font-weight: 600;

    cursor: pointer;
    transition: 0.3s;
}

.login-box button:hover {
    background: #e68a00;
    transform: translateY(-2px);
}

/* ERROR */
.error {
    color: red;
    font-size: 13px;
    margin-bottom: 10px;
}

/* SMALL TEXT */
.small {
    margin-top: 12px;
    font-size: 12px;
    color: #555;
}

/* RESPONSIVE */
@media (max-width: 600px) {
    .title {
        font-size: 28px;
    }
    .login-box {
        width: 85%;
    }
}
</style>
</head>

<body>

<!-- TITLE AT CENTER TOP -->
<div class="title">
    🏢 Society Management System
</div>

<!-- LOGIN BOX CENTER -->
<div class="login-box">

    <h2>Login</h2>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Sign In</button>
    </form>

    <div class="small">
        Secure access for society members
    </div>

</div>

</body>
</html>