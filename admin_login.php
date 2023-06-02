<?php
session_start();
include "connection.php";
//redirect admin to admin dashboard if already logged in
if (isset($_SESSION['admin_number'])) {
    header("Location: admin_dashboard.php");
    exit();
}
if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $db->prepare("SELECT * FROM `library_admin` WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {


                session_start(); // Starting Session
                $_SESSION['admin_number'] = $row['admin_number'];
                header("Location: admin_dashboard.php");
                exit();
            } else {
                $error = "Invalid credentials";
                ?>
                <script>

                    alert("Invalid credentials");
                </script>
                <?php

            }
        } else {
            $error = "Invalid credentials";
            ?>
            <script>

                alert("Invalid credentials");
            </script>
            <?php
        }
    } else {
        $error = "Please fill in all fields";
        ?>
        <script>

            alert("Please fill in all fields");
        </script>
        <?php
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">

    <title>Admin Login landing page- Manila-Sacramento Friendship Library </title>

</head>

<body>

    <section class="main">
        <div class="side">
        </div>

        <div class="login-container">
            <div class="logo">
                <img src="images/logo.2.png" alt="logo">
                <a href="login.php">Go Back</a>
            </div>
            <div class="form">
                <p class="title"> Admin Log In </p>
                <div class="separator"></div>
                <p class="welcome-message">Please provide the right information in logging in your account.</p>

                <form class="login-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="form-control">
                        <input type="email" name="email" placeholder="Email" required="">

                    </div>
                    <div class="form-control">
                        <input type="password" name="password" id="password" placeholder="Password"
                            oninput="checkPassword();">
                    </div>
                    <div class="show_password">
                        <input type="checkbox" id="show-password" class="checkbox-input"
                            onchange="togglePasswordVisibility('password', 'show-password');">
                        <p>Show Password</p>
                    </div>
                    <button class="submit" type="submit" name="submit" value="Login">Login</button>


                </form>

            </div>
    </section>

    <script src="password.js"></script>
</body>

</html>