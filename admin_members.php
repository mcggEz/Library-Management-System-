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
            <div class="mode-toggle"></div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="activity">
                    <div class="title">
                        <i class="uil uil-clock-three"></i>
                        <span class="text">Members</span>
                    </div>

                    <form action="" method="get">
                        <div class="search-box">

                            <input type="text" name="search" placeholder="Search here...">
                            <button type="submit" class="navigation-button"> <i class="uil uil-search"></i>
                                Search</button>

                        </div>
                    </form>
                    <div class="admin_buttons">
                        <form action="generate_user.php" method="post">
                            <button type="submit" name="excel_button" class="navigation-button">Generate Report</button>
                        </form>
                    </div>

                    <!-- table  --------------------------------->

                    <div class="table-container">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>Control Number</th>
                                    <th>Email</th>
                                    <th>Date Registration</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Address</th>
                                    <th>Sex</th>
                                    <th>Birthdate</th>
                                    <th>Contact Number</th>
                                    <th>User access</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- ... Rest of the HTML code ... -->

                                <?php
                                // Get the search keywords from the form input
                                $search = isset($_GET['search']) ? $_GET['search'] : '';

                                // Define the number of records to display per page
                                $recordsPerPage = 10;

                                // Create the SQL query with search condition
                                $query = "SELECT COUNT(*) AS total FROM user";

                                if (!empty($search)) {
                                    $query .= " WHERE name LIKE '%$search%'";
                                    $query .= " OR email LIKE '%$search%'";
                                    $query .= " OR control_number LIKE '%$search%'";
                                }

                                $result = mysqli_query($db, $query);
                                $row = mysqli_fetch_assoc($result);
                                $totalRecords = $row['total'];
                                $totalPages = ceil($totalRecords / $recordsPerPage);

                                // Get the current page from the URL parameter
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $offset = ($page - 1) * $recordsPerPage;

                                $query = "SELECT * FROM user";

                                if (!empty($search)) {
                                    $query .= " WHERE name LIKE '%$search%'";
                                    $query .= " OR email LIKE '%$search%'";
                                    $query .= " OR control_number LIKE '%$search%'";
                                }

                                $query .= " LIMIT $offset, $recordsPerPage";
                                $result = mysqli_query($db, $query);

                                // Display the library admin records
                                while ($admin = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $admin['control_number'] . "</td>";
                                    echo "<td>" . $admin['email'] . "</td>";
                                    echo "<td>" . $admin['date_registration'] . "</td>";
                                    echo "<td>" . $admin['name'] . "</td>";
                                    echo "<td>" . $admin['age'] . "</td>";
                                    echo "<td>" . $admin['address'] . "</td>";
                                    echo "<td>" . $admin['sex'] . "</td>";
                                    echo "<td>" . $admin['birthdate'] . "</td>";
                                    echo "<td>" . $admin['contact_number'] . "</td>";
                                    echo "<td>" . $admin['user_access'] . "</td>";
                                    echo "<td>";
                                    echo "<button class='table-button' onclick='openEditModal(\"" . $admin['email'] . "\", \"" . $admin['user_access'] . "\")'>Set Access</button>";
                                    echo "<button class='table-button' onclick='openDeleteModal(\"" . $admin['email'] . "\")'>Delete</button>";


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
                            echo "<a href='admin_members.php?page=" . ($page - 1);
                            if (!empty($search)) {
                                echo "&search=$search";
                            }
                            echo "'>&laquo;</a>";
                        }

                        // Page links
                        for ($i = 1; $i <= $totalPages; $i++) {
                            if ($i == $page) {
                                echo "<a class='active' href='admin_members.php?page=$i";
                            } else {
                                echo "<a href='admin_members.php?page=$i";
                            }
                            if (!empty($search)) {
                                echo "&search=$search";
                            }
                            echo "'>$i</a>";
                        }

                        // Next page link
                        if ($page < $totalPages) {
                            echo "<a href='admin_members.php?page=" . ($page + 1);
                            if (!empty($search)) {
                                echo "&search=$search";
                            }
                            echo "'>&raquo;</a>";
                        }
                        ?>
                    </div>

                    <!-- Edit modal -->
                    <div id="editModal" class="modal" action="block_user.php">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Block User</h2>
                            <form id="editForm" method="POST" action="block_user.php">
                                <input type="hidden" id="email" name="email" value="">
                                <label for="userAccess">User Access:</label>
                                <select id="userAccess" name="userAccess">
                                    <option value="block">Block</option>
                                    <option value="unblock">Unblock</option>
                                </select>
                                Are you sure you want to block/unblock this user? <br><br>
                                <button class="navigation-button" type="submit">Confirm</button>
                            </form>
                        </div>
                    </div>


                    <!-- Delete modal -->
                    <div id="deleteModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Delete User</h2>
                            <form id="deleteForm" method="POST" action="delete_user.php">
                                <input type="hidden" id="emailDelete" name="email" value="">

                                Are you sure you want to delete this user? <br><br>

                                <button class="navigation-button" type="submit">Delete</button>
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
                        function openEditModal(email, userAccess) {
                            document.getElementById("email").value = email;

                            // Set the selected option in the userAccess dropdown
                            var selectElement = document.getElementById("userAccess");
                            for (var i = 0; i < selectElement.options.length; i++) {
                                if (selectElement.options[i].value === userAccess) {
                                    selectElement.selectedIndex = i;
                                    break;
                                }
                            }

                            // Display the edit modal
                            editModal.style.display = "block";
                        }

                        // Open the delete modal with populated data
                        function openDeleteModal(email) {
                            // Populate the email input field
                            document.getElementById("emailDelete").value = email;

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