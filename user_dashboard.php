<?php
session_start();
include "connection.php";
//kicks user out if not logged in
if (!isset($_SESSION['control_number'])) {
    header("Location: index.php");
    exit();
}
include "navbar.php";

// Get the user's control number from the session
$controlNumber = $_SESSION['control_number'];

// Query to retrieve the number of attendances
$attendanceQuery = "SELECT COUNT(*) AS total_attendance FROM attendance WHERE control_number = '$controlNumber'";
$attendanceResult = mysqli_query($db, $attendanceQuery);
$attendanceRow = mysqli_fetch_assoc($attendanceResult);
$totalAttendance = $attendanceRow['total_attendance'];

// Query to retrieve the number of library resources
$resourcesQuery = "SELECT COUNT(*) AS total_resources FROM library_resources WHERE control_number = '$controlNumber'";
$resourcesResult = mysqli_query($db, $resourcesQuery);
$resourcesRow = mysqli_fetch_assoc($resourcesResult);
$totalResources = $resourcesRow['total_resources'];

// Query to retrieve the number of books borrowed
$booksQuery = "SELECT COUNT(*) AS total_books_borrowed FROM borrowed_books WHERE control_number = '$controlNumber' AND is_returned = '0'";
$booksResult = mysqli_query($db, $booksQuery);
$booksRow = mysqli_fetch_assoc($booksResult);
$totalBooks_borrowed = $booksRow['total_books_borrowed'];

// Query to retrieve the number of books borrowed
$booksQuery = "SELECT COUNT(*) AS total_books_returned FROM borrowed_books WHERE control_number = '$controlNumber' AND is_returned = '1'";
$booksResult = mysqli_query($db, $booksQuery);
$booksRow = mysqli_fetch_assoc($booksResult);
$totalBooks_returned = $booksRow['total_books_returned'];



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
            <div class="mode-toggle"></div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">User Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="text">Attendance</span>
                        <span class="number" id="attendanceNumber">
                            <?php echo $totalAttendance; ?>
                        </span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Library Resources</span>
                        <span class="number" id="resourcesNumber">
                            <?php echo $totalResources; ?>
                        </span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-comments"></i>
                        <span class="text">Borrowed Books</span>
                        <span class="number" id="resourcesNumber">
                            <?php echo $totalBooks_borrowed; ?>
                        </span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-comments"></i>
                        <span class="text"> Returned Books</span>
                        <span class="number" id="resourcesNumber">
                            <?php echo $totalBooks_returned; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="admin.js"></script>
</body>

</html>