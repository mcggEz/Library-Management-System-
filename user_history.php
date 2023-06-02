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

                <li>
                    <a href="user_notifications.php">
                        <i class="uil uil-bell"></i>
                        <span class="link-name">Notifications</span>
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

            <li class="mode">


                <div class="mode-toggle">

                </div>
            </li>
            <!--<img src="images/profile.jpg" alt="">-->
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">History</span>

                </div>
                <form action="" method="get">
                    <div class="search-box">

                        <input type="text" name="search" placeholder="Search here...">
                        <button type="submit" class="navigation-button"> <i class="uil uil-search"></i>
                            Search</button>
                    </div>
                </form>

                <div class="activity">




                    <div class="activity-data">

                        <div class="activity-data">
                            <div class="data names">
                                <span class="data-title">Control Number</span>
                                <span class="data-list">0023</span>
                                <span class="data-list">1220</span>
                                <span class="data-list">1231</span>
                                <span class="data-list">0523</span>
                                <span class="data-list">0231</span>
                                <span class="data-list">2123</span>
                                <span class="data-list">0121</span>
                            </div>
                            <div class="data email">
                                <span class="data-title">Email</span>
                                <span class="data-list">JuandlCruz@gmail.com</span>
                                <span class="data-list">user123@gmail.com</span>
                                <span class="data-list">1231@gmail.com</span>
                                <span class="data-list">1112d@gmail.com</span>
                                <span class="data-list">user12@gmail.com</span>
                                <span class="data-list">useremail1@gmail.com</span>
                                <span class="data-list">user231@gmail.com</span>
                            </div>
                            <div class="data joined">
                                <span class="data-title">Time Joined</span>
                                <span class="data-list">11:01 a.m.</span>
                                <span class="data-list">2:00 p.m.</span>
                                <span class="data-list">2:21 p.m.</span>
                                <span class="data-list">2:53 p.m.</span>
                                <span class="data-list">3:21 p.m.</span>
                                <span class="data-list">3:32 p.m.</span>
                                <span class="data-list">4:21 p.m.</span>
                            </div>
                            <div class="data type">
                                <span class="data-title">Type</span>
                                <span class="data-list">M</span>
                                <span class="data-list">M</span>
                                <span class="data-list">F</span>
                                <span class="data-list">M</span>
                                <span class="data-list">F</span>
                                <span class="data-list">M</span>
                                <span class="data-list">M</span>
                            </div>
                        </div>
                    </div>
                </div>
    </section>

    <script src="admin.js"></script>
</body>

</html>