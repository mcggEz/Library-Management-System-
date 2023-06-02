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

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="mode-toggle"></div>

        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Reservations</span>
                </div>
                <form action="" method="get">
                    <div class="search-box">

                        <input type="text" name="search" placeholder="Search here...">
                        <button type="submit" class="navigation-button"> <i class="uil uil-search"></i>
                            Search</button>

                    </div>
                </form>
                <div class="admin_buttons">

                    <form action="generate_excel.php" method="post">
                        <button type="submit" name="excel_button" class="navigation-button">Generate Report</button>
                    </form>
                </div>

                <!-- table  -->

                <div class="table-container">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>Reservation ID</th>
                                <th>Control Number</th>
                                <th>Visit Date</th>
                                <th>Reason for Visit</th>
                                <th>Submission Date</th>
                                <th>Table Source</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Get the search keywords from the form input
                            $search = isset($_GET['search']) ? $_GET['search'] : '';

                            // Define the number of records to display per page
                            $recordsPerPage = 10;

                            // Create the SQL query with search condition
                            $query = "SELECT COUNT(*) AS total FROM book_reservations";

                            if (!empty($search)) {
                                $query .= " WHERE control_number LIKE '%$search%'";
                                $query .= " OR acc_number LIKE '%$search%'";
                                $query .= " OR reservation_date LIKE '%$search%'";
                                $query .= " OR book_borrowing_date LIKE '%$search%'";
                            }

                            $result = mysqli_query($db, $query);
                            $row = mysqli_fetch_assoc($result);
                            $totalRecords = $row['total'];
                            $totalPages = ceil($totalRecords / $recordsPerPage);

                            // Get the current page from the URL parameter
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $offset = ($page - 1) * $recordsPerPage;

                            $query = "SELECT * FROM book_reservations";

                            if (!empty($search)) {
                                $query .= " WHERE control_number LIKE '%$search%'";
                                $query .= " OR acc_number LIKE '%$search%'";
                                $query .= " OR reservation_date LIKE '%$search%'";
                                $query .= " OR book_borrowing_date LIKE '%$search%'";
                            }

                            $query .= " LIMIT $offset, $recordsPerPage";
                            $result = mysqli_query($db, $query);

                            // Display the reservation records
                            while ($reservation = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $reservation['id'] . "</td>";
                                echo "<td>" . $reservation['control_number'] . "</td>";
                                echo "<td>" . $reservation['book_borrowing_date'] . "</td>";
                                echo "<td>" . $reservation['acc_number'] . "</td>";
                                echo "<td>" . $reservation['reservation_date'] . "</td>";
                                echo "<td>reservations</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <?php
                    // Previous page link
                    if ($page > 1) {
                        echo "<a href='admin_book_reservations.php?page=" . ($page - 1);
                        if (!empty($search)) {
                            echo "&search=$search";
                        }
                        echo "'>&laquo;</a>";
                    }

                    // Page links
                    for ($i = 1; $i <= $totalPages; $i++) {
                        if ($i == $page) {
                            echo "<a class='active' href=''admin_book_reservations.php?page=$i";
                        } else {
                            echo "<a href=''admin_book_reservations.php?page=$i";
                        }
                        if (!empty($search)) {
                            echo "&search=$search";
                        }
                        echo "'>$i</a>";
                    }

                    // Next page link
                    if ($page < $totalPages) {
                        echo "<a href=''admin_book_reservations.php?page=" . ($page + 1);
                        if (!empty($search)) {
                            echo "&search=$search";
                        }
                        echo "'>&raquo;</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script src="admin.js"></script>
</body>

</html>