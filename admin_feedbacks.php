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
            <!--<img src="images/profile.jpg" alt="">-->
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Feedbacks</span>
                </div>
                <form action="" method="get">
                    <div class="search-box">

                        <input type="text" name="search" placeholder="Search here...">
                        <button type="submit" class="navigation-button"> <i class="uil uil-search"></i>
                            Search</button>

                    </div>
                </form>
                <div class="admin_buttons">


                    <form action="generate_feedbacks.php" method="post">
                        <button type="submit" name="excel_button" class="navigation-button">Generate Report</button>
                    </form>
                </div>

                <!-- table  -->

                <div class="table-container">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>Feedback ID</th>
                                <th>Control Number</th>
                                <th>Comment Type</th>
                                <th>Comment Subject</th>
                                <th>Comments</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // Get the search keywords from the form input
                            $search = isset($_GET['search']) ? $_GET['search'] : '';

                            // Define the number of records to display per page
                            $recordsPerPage = 10;

                            // Create the SQL query with search condition
                            $query = "SELECT COUNT(*) AS total FROM user_feedbacks";

                            if (!empty($search)) {
                                $query .= " WHERE comment_subject LIKE '%$search%'";
                                $query .= " OR comments LIKE '%$search%'";
                            }

                            $result = mysqli_query($db, $query);
                            $row = mysqli_fetch_assoc($result);
                            $totalRecords = $row['total'];
                            $totalPages = ceil($totalRecords / $recordsPerPage);

                            // Get the current page from the URL parameter
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $offset = ($page - 1) * $recordsPerPage;

                            $query = "SELECT * FROM user_feedbacks";

                            if (!empty($search)) {
                                $query .= " WHERE comment_subject LIKE '%$search%'";
                                $query .= " OR comments LIKE '%$search%'";
                            }

                            $query .= " LIMIT $offset, $recordsPerPage";
                            $result = mysqli_query($db, $query);

                            // Display the user feedback records
                            while ($feedback = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $feedback['id'] . "</td>";
                                echo "<td>" . $feedback['control_number'] . "</td>";
                                echo "<td>" . $feedback['comment_type'] . "</td>";
                                echo "<td>" . $feedback['comment_subject'] . "</td>";
                                echo "<td>" . $feedback['comments'] . "</td>";
                                echo "<td>" . $feedback['created_at'] . "</td>";
                                echo "<td>";

                                echo "<button class='table-button' onclick='openDeleteModal(" . $feedback['id'] . ")'>Delete</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>



            </div>
            <!-- pagination -->

            <div class="pagination">
                <?php
                // Previous page link
                if ($page > 1) {
                    echo "<a href='admin_staff.php?page=" . ($page - 1);
                    if (!empty($search)) {
                        echo "&search=$search";
                    }
                    echo "'>&laquo;</a>";
                }

                // Page links
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $page) {
                        echo "<a class='active' href='admin_staff.php?page=$i";
                    } else {
                        echo "<a href='admin_staff.php?page=$i";
                    }
                    if (!empty($search)) {
                        echo "&search=$search";
                    }
                    echo "'>$i</a>";
                }

                // Next page link
                if ($page < $totalPages) {
                    echo "<a href='admin_staff.php?page=" . ($page + 1);
                    if (!empty($search)) {
                        echo "&search=$search";
                    }
                    echo "'>&raquo;</a>";
                }
                ?>
            </div>




            <!-- Delete Modal -->
            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Delete Feedback</h2>
                    <p>Are you sure you want to delete this feedback?</p>
                    <form id="deleteForm" action="delete_feedback.php" method="POST">
                        <input type="hidden" id="feedbackIdDelete" name="feedbackIdDelete">
                        <button type="submit" id="deleteButton" class="modal-button">Delete</button>
                    </form>
                </div>
            </div>


            <script>
                // Open the delete modal with populated data
                function openDeleteModal(feedbackId) {
                    // Populate the feedback ID input field
                    document.getElementById("feedbackIdDelete").value = feedbackId;

                    // Display the delete modal
                    deleteModal.style.display = "block";
                }

                // Add event listener to the delete button
                var deleteButton = document.getElementById("deleteButton");
                deleteButton.addEventListener("click", function () {
                    // Get the feedback ID from the input field
                    var feedbackId = document.getElementById("feedbackIdDelete").value;

                    // Perform the delete operation (You can use AJAX or submit a form for this)

                    // Redirect to the page after successful deletion
                    window.location.href = "your_page.php";
                });


            </script>


        </div>
        </div>
        </div>

    </section>

    <script src="admin.js"></script>
</body>

</html>