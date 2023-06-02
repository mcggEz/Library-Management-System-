<?php
session_start();
include "connection.php";
//kicks user out if not logged in
if (!isset($_SESSION['control_number'])) {
    header("Location: index.php");
    exit();
}
include "navbar.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user_dashboard.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">

    <title>User Dashboard Panel</title>
</head>

<body>

    <nav class="sidebar">
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="user_dashboard.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li>
                    <a href="user_profile.php">
                        <i class="uil uil-setting"></i>
                        <span class="link-name">Profile</span>
                    </a>
                </li>
                <li><a href="user_feedbacks.php">
                        <i class="uil uil-comment-dots"></i>
                        <span class="link-name">Feedbacks</span>
                    </a></li>
                <li>
                    <a href="user_settings.php">
                        <i class="uil uil-setting"></i>
                        <span class="link-name">Settings</span>
                    </a>
                </li>
            </ul>
            <li><a href="user_help.php">
                    <i class="uil uil-question-circle"></i>
                    <span class="link-name">Help</span>
                </a></li>

            <ul class="logout-mode">
                <li><a href="logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>


            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>




            <div class="mode-toggle">

            </div>

            <!--<img src="images/profile.jpg" alt="">-->
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Profile Information</span>

                    <a href="user_edit_profile.php">Edit</a>

                </div>
                <div class="profile_information">
                    <?php

                    $control_number = $_SESSION['control_number'];
                    // Query to retrieve user information
                    $sql = "SELECT * FROM user WHERE control_number = '$control_number'";
                    $result = mysqli_query($db, $sql);

                    // Check if query was successful
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $control_number = $row['control_number'];
                        $name = $row['name'];
                        $sex = $row['sex'];
                        $age = $row['age'];
                        $birthdate = $row['birthdate'];
                        $school_organization = $row['school_organization'];
                        $address = $row['address'];
                        $contact_number = $row['contact_number'];
                        $email = $row['email'];
                        $date_registration = $row['date_registration'];
                        $date_profile_update = $row['date_profile_update'];
                        $date_password_update = $row['date_password_update'];

                        // Display user information
                        echo "Control Number: $control_number<br>";
                        echo "Name: $name<br>";
                        echo "Sex: $sex<br>";
                        echo "Age: $age<br>";
                        echo "Birthdate: $birthdate<br>";
                        echo "School/Organization: $school_organization<br>";
                        echo "Address: $address<br>";
                        echo "Contact Number: $contact_number<br>";
                        echo "Email: $email<br>";
                        echo "Date of Registration: $date_registration<br>";
                        echo "Last Time You Update Your Profile: $date_profile_update<br>";
                        echo "Last Time You Update Your Password: $date_password_update<br>";
                    } else {
                        echo "Error: " . mysqli_error($db);
                    }

                    // Close database connection
                    mysqli_close($db);
                    ?>
                </div>


                <button class="navigation-button" onclick="window.location.href='user_reset_password.php'">
                    </i> Reset Password
                </button>

    </section>

    <script src="admin.js"></script>
</body>

</html>