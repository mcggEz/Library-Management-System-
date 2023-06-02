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


        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Notifications</span>

                </div>
                <style>
                    /* Responsive table */
                    .notifications-container {
                        padding: 20px;
                    }

                    .table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    .table th,
                    .table td {
                        padding: 10px;
                        border: 1px solid #ccc;
                    }

                    .table th {
                        background-color: #82ca86;
                        color: #ffffff;
                    }

                    .table td {
                        background-color: #f2f2f2;
                    }
                </style>

                <section class="notifications-container">
                    <h2>Notifications</h2>
                    <?php
                    $control_number = $_SESSION['control_number'];

                    // Query to retrieve notifications
                    $sql = "SELECT * FROM borrowed_books WHERE control_number = '$control_number' AND return_date = CURDATE()";
                    $result = mysqli_query($db, $sql);

                    // Check if query was successful
                    if ($result && mysqli_num_rows($result) > 0) {
                        echo '<table class="table">';
                        echo '<tr>';
                        echo '<th>Control Number</th>';
                        echo '<th>Accession Number</th>';
                        echo '<th>Borrow Date</th>';
                        echo '<th>Return Date</th>';
                        echo '<th>Date Book Returned</th>';
                        echo '<th>Returned</th>';
                        echo '</tr>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['control_number'] . '</td>';
                            echo '<td>' . $row['acc_number'] . '</td>';
                            echo '<td>' . $row['borrow_date'] . '</td>';
                            echo '<td>' . $row['return_date'] . '</td>';
                            echo '<td>' . $row['date_book_returned'] . '</td>';
                            echo '<td>' . $row['is_returned'] . '</td>';
                            echo '</tr>';
                        }

                        echo '</table>';
                    } else {
                        echo 'No notifications found.';
                    }

                    // Close database connection
                    mysqli_close($db);
                    ?>
                </section>




            </div>
    </section>

    <script src="admin.js"></script>
</body>

</html>