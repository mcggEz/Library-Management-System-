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
                    <span class="text">Borrowed Books</span>
                </div>
                <form action="" method="get">
                    <div class="search-box">

                        <input type="text" name="search" placeholder="Search here...">
                        <button type="submit" class="navigation-button"> <i class="uil uil-search"></i>
                            Search</button>

                    </div>
                </form>
                <div class="admin_buttons">



                    <form action="generate_book_reservations.php" method="post">
                        <button type="submit" name="excel_button" class="navigation-button">Generate Report</button>
                    </form>
                </div>

                <!-- table  -->

                <div class="table-container">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Control Number</th>
                                <th>Accession Number</th>
                                <th>Borrow Date</th>
                                <th>Return Date</th>
                                <th>Date Book Returned</th>
                                <th>Is Returned</th>
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
                            $query = "SELECT COUNT(*) AS total FROM borrowed_books";

                            if (!empty($search)) {
                                $query .= " WHERE control_number LIKE '%$search%'";
                                $query .= " OR acc_number LIKE '%$search%'";
                                $query .= " OR borrow_date LIKE '%$search%'";
                            }

                            $result = mysqli_query($db, $query);
                            $row = mysqli_fetch_assoc($result);
                            $totalRecords = $row['total'];
                            $totalPages = ceil($totalRecords / $recordsPerPage);

                            // Get the current page from the URL parameter
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $offset = ($page - 1) * $recordsPerPage;

                            $query = "SELECT * FROM borrowed_books";

                            if (!empty($search)) {
                                $query .= " WHERE control_number LIKE '%$search%'";
                                $query .= " OR acc_number LIKE '%$search%'";
                                $query .= " OR borrow_date LIKE '%$search%'";
                            }

                            $query .= " LIMIT $offset, $recordsPerPage";
                            $result = mysqli_query($db, $query);

                            // Display the borrowed book records
                            while ($book = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $book['id'] . "</td>";
                                echo "<td>" . $book['control_number'] . "</td>";
                                echo "<td>" . $book['acc_number'] . "</td>";
                                echo "<td>" . $book['borrow_date'] . "</td>";
                                echo "<td>" . $book['return_date'] . "</td>";
                                echo "<td>" . $book['date_book_returned'] . "</td>";
                                echo "<td>" . $book['is_returned'] . "</td>";
                                echo "<td>";
                                // Add your actions buttons here (Edit, Delete, etc.)
                                echo "<button class='table-button' onclick='openDeleteModal(\"" . $book['id'] . "\")'>Delete</button>";

                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- pagination -->

                <div class="pagination">
                    <?php
                    // Previous page link
                    if ($page > 1) {
                        echo "<a href='admin_borrowed_books.php?page=" . ($page - 1);
                        if (!empty($search)) {
                            echo "&search=$search";
                        }
                        echo "'>&laquo;</a>";
                    }

                    // Page links
                    for ($i = 1; $i <= $totalPages; $i++) {
                        if ($i == $page) {
                            echo "<a class='active' href='admin_borrowed_books.php?page=$i";
                        } else {
                            echo "<a href='admin_borrowed_books.php?page=$i";
                        }
                        if (!empty($search)) {
                            echo "&search=$search";
                        }
                        echo "'>$i</a>";
                    }

                    // Next page link
                    if ($page < $totalPages) {
                        echo "<a href='admin_borrowed_books.php?page=" . ($page + 1);
                        if (!empty($search)) {
                            echo "&search=$search";
                        }
                        echo "'>&raquo;</a>";
                    }
                    ?>
                </div>
                <!-- delete modal -->

                <div id="deleteModal" class="modal">
                    <div class="modal-content">
                        <span id="deleteClose" class="close">&times;</span>
                        <h2>Delete Book</h2>
                        <form id="deleteForm" method="POST" action="delete_book_borrowed.php">
                            <input type="hidden" id="bookID" name="bookID" value="">
                            <p>Are you sure you want to delete this row?</p><br><br>
                            <button class="navigation-button" type="submit">Delete</button>
                        </form>
                    </div>
                </div>

                <script>
                    // Get the modal elements
                    var deleteModal = document.getElementById("deleteModal");

                    // Open the delete modal with the specified book ID
                    function openDeleteModal(bookID) {
                        // Set the value of the bookID input field in the delete form
                        document.getElementById("bookID").value = bookID;

                        // Display the delete modal
                        deleteModal.style.display = "block";
                    }

                    // Close the delete modal when the close button is clicked
                    document.getElementById("deleteClose").addEventListener("click", function () {
                        deleteModal.style.display = "none";
                    });

                    // Close the delete modal when the user clicks outside of the modal content
                    window.addEventListener("click", function (event) {
                        if (event.target == deleteModal) {
                            deleteModal.style.display = "none";
                        }
                    });
                </script>



            </div>
        </div>
        </div>

    </section>

    <script src="admin.js"></script>
</body>

</html>