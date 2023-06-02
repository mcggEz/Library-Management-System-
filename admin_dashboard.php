<?php
session_start();
include "connection.php";
//kicks user out if not logged in
if (!isset($_SESSION['admin_number'])) {
    header("Location: index.php");
    exit();

}
include "admin_navbar.php";

// Query the attendance table to get the total attendance for the day, total number of male users and female users

$query = "SELECT COUNT(*) AS totalAttendance FROM attendance WHERE DATE(time_in) = CURDATE()";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$totalAttendance = $row['totalAttendance'];



// Get total number of library resources users
$resourcesQuery = "SELECT COUNT(*) AS totalResources FROM library_resources WHERE DATE(time_in) = CURDATE()";
$resourcesResult = mysqli_query($db, $resourcesQuery);
$row = mysqli_fetch_assoc($resourcesResult);
$totalResources = $row['totalResources'];


// Get total number of library spaces
$spaceQuery = "SELECT COUNT(*) AS totalSpaces FROM library_space where DATE(time_in) = CURDATE()";
$spaceResult = mysqli_query($db, $spaceQuery);
$row = mysqli_fetch_assoc($spaceResult);
$totalSpaces = $row['totalSpaces'];
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
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: black;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }

        button {
            margin-bottom: 10px;
            padding: 8px 16px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
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
                <!-- <li><a href="admin_book_donations.php">
                        <i class="uil uil-gift"></i>
                        <span class="link-name">Book Donations</span>
                    </a></li> -->
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
    <!-- Sidebar End -->
    <!-- Main Content -->
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="mode-toggle"></div>


            <!--<img src="images/profile.jpg" alt="">-->
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
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
                        <i class="uil uil-share"></i>
                        <span class="text">Library Space</span>
                        <span class="number" id="spaceNumber">
                            <?php echo $totalSpaces; ?>
                        </span>
                    </div>
                </div>


                <script>
                    // Update the attendance number
                    var attendanceNumber = <?php echo $totalAttendance; ?>; // Replace with actual value from server
                    document.getElementById("attendanceNumber").textContent = attendanceNumber;

                    // Update the library users number
                    var resourcesNumber = <?php echo $totalSpaces; ?>; // Replace with actual value from server
                    document.getElementById("resourcesNumber").textContent = resourcesNumber;

                    // Update the space number
                    var spaceNumber = <?php echo $totalResources; ?>; // Replace with actual value from server
                    document.getElementById("spaceNumber").textContent = spaceNumber;
                </script>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Activity</span>
                </div>

                <!-------------------Table------------------------->


                <div class="filter-container">

                    <form action="">
                        <!-- Date input -->
                        <label for="filter_date">Filter by Date:</label>
                        <input type="date" id="filter_date" name="date">

                        <!-- Filter button -->
                        <button class="navigation-button" type="submit">Filter</button>
                    </form>

                    <form action="generate_user.php" method="post">
                        <button class="navigation-button" type="submit" name="excel_button">Generate Excel File</button>
                    </form>
                </div>

                <?php
                ob_start(); // Start output buffering
                
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    // Handle form submission and filtering
                    $query = isset($_GET['query']) ? $_GET['query'] : 'all';
                    $date = isset($_GET['date']) ? $_GET['date'] : '';

                    // Add the filter conditions to the SQL query
                    $filterConditions = "";

                    if ($query !== 'all') {
                        $filterConditions .= " AND activity = '$query'";
                    }

                    if (!empty($date)) {
                        $filterConditions .= " AND DATE(time_in) = '$date'";
                    }

                    // Calculate the starting row for the current page
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $rowsPerPage = 10;
                    $startingRow = ($currentPage - 1) * $rowsPerPage;

                    // Fetch the filtered activities from all three tables
                    $filteredActivitiesQuery = "(SELECT 'Library Space' AS activity, control_number, age, sex, school_organization, time_in FROM library_space WHERE 1=1 $filterConditions)
    UNION ALL
    (SELECT 'Attendance' AS activity, control_number, age, sex, school_organization, time_in FROM attendance WHERE 1=1 $filterConditions)
    UNION ALL
    (SELECT 'Library Resources' AS activity, control_number, age, sex, school_organization, time_in FROM library_resources WHERE 1=1 $filterConditions)
    ORDER BY time_in DESC
    LIMIT $startingRow, $rowsPerPage";

                    $filteredActivitiesResult = mysqli_query($db, $filteredActivitiesQuery);

                    // Display the filtered table
                    echo '<table>';
                    echo '<tr><th>Activity</th><th>Control Number</th><th>Age</th><th>Sex</th><th>School/Organization</th><th>Time In</th></tr>';

                    while ($row = mysqli_fetch_assoc($filteredActivitiesResult)) {
                        echo '<tr>';
                        echo '<td>' . $row['activity'] . '</td>';
                        echo '<td>' . $row['control_number'] . '</td>';
                        echo '<td>' . $row['age'] . '</td>';
                        echo '<td>' . $row['sex'] . '</td>';
                        echo '<td>' . $row['school_organization'] . '</td>';
                        echo '<td>' . $row['time_in'] . '</td>';
                        echo '</tr>';
                    }

                    echo '</table>';

                    // Pagination links
                    $totalRows = mysqli_num_rows(mysqli_query($db, $filteredActivitiesQuery));
                    $totalPages = ceil($totalRows / $rowsPerPage);

                    echo '<div class="pagination">';
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<a href="?page=' . $i . '">' . $i . '</a>';
                    }
                    echo '</div>';

                    // Output the buffered content
                    ob_end_flush();

                    exit; // Terminate the script after displaying the table
                }
                ?>






                <!-------------------Table------------------------->
            </div>
        </div>

    </section>

    <script src="admin.js"></script>
</body>

</html>