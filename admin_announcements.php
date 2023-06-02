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
                    <span class="text">Announcements</span>
                </div>
                <form action="" method="get">
                    <div class="search-box">

                        <input type="text" name="search" placeholder="Search here...">
                        <button type="submit" class="navigation-button"> <i class="uil uil-search"></i>
                            Search</button>

                    </div>
                </form>
                <div class="admin_buttons">
                    <button onclick="openAddModal()" class="navigation-button"> <i class="fas fa-plus"></i> Add
                        New
                        Announcement</button>


                </div>

                <!-- table  -->

                <div class="table-container">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>Announcement ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date Posted</th>

                                <th>Category</th>
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
                            $query = "SELECT COUNT(*) AS total FROM library_announcements";

                            if (!empty($search)) {
                                $query .= " WHERE title LIKE '%$search%'";
                                $query .= " OR description LIKE '%$search%'";
                                $query .= " OR category LIKE '%$search%'";
                            }

                            $result = mysqli_query($db, $query);
                            $row = mysqli_fetch_assoc($result);
                            $totalRecords = $row['total'];
                            $totalPages = ceil($totalRecords / $recordsPerPage);

                            // Get the current page from the URL parameter
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $offset = ($page - 1) * $recordsPerPage;

                            $query = "SELECT * FROM library_announcements";

                            if (!empty($search)) {
                                $query .= " WHERE title LIKE '%$search%'";
                                $query .= " OR description LIKE '%$search%'";
                                $query .= " OR category LIKE '%$search%'";
                            }

                            $query .= " LIMIT $offset, $recordsPerPage";
                            $result = mysqli_query($db, $query);

                            // Display the announcement records
                            while ($announcement = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $announcement['announcement_id'] . "</td>";
                                echo "<td>" . $announcement['title'] . "</td>";
                                echo "<td>" . $announcement['description'] . "</td>";
                                echo "<td>" . $announcement['date_posted'] . "</td>";

                                echo "<td>" . $announcement['category'] . "</td>";
                                echo "<td>";
                                echo "<button onclick='openEditModal(" . $announcement['announcement_id'] . ")' class='table-button'>Edit</button>";
                                echo "<button onclick='openDeleteModal(" . $announcement['announcement_id'] . ")' class='table-button'>Delete</button>";
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
                        echo "<a href='admin_announcements.php?page=" . ($page - 1);
                        if (!empty($search)) {
                            echo "&search=$search";
                        }
                        echo "'>&laquo;</a>";
                    }

                    // Page links
                    for ($i = 1; $i <= $totalPages; $i++) {
                        if ($i == $page) {
                            echo "<a class='active' href='admin_announcements.php?page=$i";
                        } else {
                            echo "<a href='admin_announcements.php?page=$i";
                        }
                        if (!empty($search)) {
                            echo "&search=$search";
                        }
                        echo "'>$i</a>";
                    }

                    // Next page link
                    if ($page < $totalPages) {
                        echo "<a href='admin_announcements.php?page=" . ($page + 1);
                        if (!empty($search)) {
                            echo "&search=$search";
                        }
                        echo "'>&raquo;</a>";
                    }
                    ?>
                </div>



                <!-- Add Modal -->
                <div id="addModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Add New Announcement</h2>
                        <form action="add_announcements.php" method="POST">
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" required>

                            <label for="description">Description:</label>
                            <textarea id="description" name="description" required></textarea>

                            <label for="datePosted">Date Posted:</label>
                            <input type="date" id="datePosted" name="datePosted" required>

                            <label for="category">Category:</label>
                            <input type="text" id="category" name="category" required>

                            <button type="submit">Add Announcement</button>
                        </form>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div id="editModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Edit Announcement</h2>
                        <form action="edit_announcement.php" method="POST">
                            <input type="hidden" id="announcementId" name="announcementId">

                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" value="" required>

                            <label for="description">Description:</label>
                            <textarea id="description" name="description" required></textarea>

                            <label for="datePosted">Date Posted:</label>
                            <input type="date" id="datePosted" name="datePosted" required>

                            <label for="category">Category:</label>
                            <input type="text" id="category" name="category" required>

                            <button type="submit">Save Changes</button>
                        </form>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div id="deleteModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Delete Announcement</h2>
                        <form action="delete_announcement.php" method="POST">
                            <p>Are you sure you want to delete this announcement?</p><br><br>
                            <input type="hidden" id="announcementIdDelete" name="announcementIdDelete">
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </div>


                <script>
                    // Get the modal elements
                    var editModal = document.getElementById("editModal");
                    var deleteModal = document.getElementById("deleteModal");

                    // Get the close button elements
                    var closeButtons = document.getElementsByClassName("close");


                    // Open the edit modal with populated data
                    function openEditModal(announcementId, title, description, datePosted, category) {
                        // Set the values of the input fields
                        document.getElementById("announcementId").value = announcementId;
                        document.getElementById("title").value = title;
                        document.getElementById("description").value = description;
                        document.getElementById("datePosted").value = datePosted;
                        document.getElementById("category").value = category;

                        // Display the edit modal
                        editModal.style.display = "block";
                    }

                    // Open the delete modal with populated data
                    function openDeleteModal(announcementId) {
                        // Populate the announcement ID input field
                        document.getElementById("announcementIdDelete").value = announcementId;

                        // Display the delete modal
                        deleteModal.style.display = "block";
                    }

                    // Close the modals when the close button is clicked
                    for (var i = 0; i < closeButtons.length; i++) {
                        closeButtons[i].addEventListener("click", function () {
                            editModal.style.display = "none";
                            deleteModal.style.display = "none";
                        });
                    }

                    // Close the modals when the user clicks outside of the modal content
                    window.addEventListener("click", function (event) {
                        var modals = document.getElementsByClassName("modal");
                        for (var i = 0; i < modals.length; i++) {
                            if (event.target == modals[i]) {
                                modals[i].style.display = "none";
                            }
                        }
                    });

                    // Get the modal element
                    var addModal = document.getElementById("addModal");

                    // Open the add modal
                    function openAddModal() {
                        addModal.style.display = "block";
                    }

                    // Close the modal when the close button is clicked
                    var closeButtons = document.getElementsByClassName("close");
                    for (var i = 0; i < closeButtons.length; i++) {
                        closeButtons[i].addEventListener("click", function () {
                            addModal.style.display = "none";
                        });
                    }

                    // Close the modal when the user clicks outside of the modal content
                    window.addEventListener("click", function (event) {
                        if (event.target == addModal) {
                            addModal.style.display = "none";
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