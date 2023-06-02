<?php
session_start();
include "connection.php";
//kicks user out if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();

}
include "admin_navbar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_dashboard.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">

    <title>Admin Dashboard Panel</title>
</head>

<body>

    <nav class="sidebar">
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="admin_dashboard.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="admin_staff.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Staffs</span>
                    </a></li>
                <li><a href="admin_members.php">
                        <i class="uil uil-users-alt"></i>
                        <span class="link-name">Members</span>
                    </a></li>
                <li><a href="admin_books.php">
                        <i class="uil uil-book"></i>
                        <span class="link-name">Books</span>
                    </a></li>
                <li><a href="admin_borrowed_books.php">
                        <i class="uil uil-folder-check"></i>
                        <span class="link-name">Borrowed Books</span>
                    </a></li>
                <li><a href="admin_reservations.php">
                        <i class="uil uil-calendar-alt"></i>
                        <span class="link-name">Reservations</span>
                    </a></li>
                <li><a href="admin_book_reservations.php">
                        <i class="uil uil-book"></i>
                        <span class="link-name">Book Reservations</span>
                    </a></li>
                <li><a href="admin_announcements.php">
                        <i class="uil uil-megaphone"></i>
                        <span class="link-name">Announcements</span>
                    </a></li>
                <li><a href="admin_feedbacks.php">
                        <i class="uil uil-comment-dots"></i>
                        <span class="link-name">Feedbacks</span>
                    </a></li>
                <li><a href="admin_help.php">
                        <i class="uil uil-question-circle"></i>
                        <span class="link-name">Help</span>
                    </a></li>
                <li><a href="admin_settings.php">
                        <i class="uil uil-setting"></i>
                        <span class="link-name">Settings</span>
                    </a></li>
            </ul>


            <ul class="logout-mode">
                <li><a href="logout_admin.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>


            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>


        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Settings</span>
                </div>
                <li class="mode">

                    <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>


                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>

    </section>

    <script src="admin.js"></script>
</body>

</html>