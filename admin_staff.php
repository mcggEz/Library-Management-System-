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

        <!-- This is the table part ------------------------------------------------------------------>
        <div class="dash-content">
            <div class="overview">

                <div class="activity">
                    <div class="title">
                        <i class="uil uil-clock-three"></i>
                        <span class="text">Staffs</span>
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
                            Staff</button>

                        <form action="generate_staff.php" method="post">
                            <button type="submit" name="excel_button" class="navigation-button">Generate Report</button>
                        </form>
                    </div>

                    <!-- table  -->

                    <div class="table-container">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>Admin Number</th>
                                    <th>Email</th>
                                    <th>Date Registration</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Address</th>
                                    <th>Sex</th>
                                    <th>Birthdate</th>
                                    <th>Contact Number</th>
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
                                $query = "SELECT COUNT(*) AS total FROM library_admin";

                                if (!empty($search)) {
                                    $query .= " WHERE name LIKE '%$search%'";
                                    $query .= " OR email LIKE '%$search%'";
                                    $query .= " OR admin_number LIKE '%$search%'";
                                }

                                $result = mysqli_query($db, $query);
                                $row = mysqli_fetch_assoc($result);
                                $totalRecords = $row['total'];
                                $totalPages = ceil($totalRecords / $recordsPerPage);

                                // Get the current page from the URL parameter
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $offset = ($page - 1) * $recordsPerPage;

                                $query = "SELECT * FROM library_admin";

                                if (!empty($search)) {
                                    $query .= " WHERE name LIKE '%$search%'";
                                    $query .= " OR email LIKE '%$search%'";
                                    $query .= " OR admin_number LIKE '%$search%'";
                                }

                                $query .= " LIMIT $offset, $recordsPerPage";
                                $result = mysqli_query($db, $query);

                                // Display the library admin records
                                while ($admin = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $admin['admin_number'] . "</td>";
                                    echo "<td>" . $admin['email'] . "</td>";
                                    echo "<td>" . $admin['date_registration'] . "</td>";
                                    echo "<td>" . $admin['name'] . "</td>";
                                    echo "<td>" . $admin['age'] . "</td>";
                                    echo "<td>" . $admin['address'] . "</td>";
                                    echo "<td>" . $admin['sex'] . "</td>";
                                    echo "<td>" . $admin['birthdate'] . "</td>";
                                    echo "<td>" . $admin['contact_number'] . "</td>";
                                    echo "<td>";
                                    echo "<button class='table-button' onclick='openEditModal(" . $admin['admin_number'] . ", \"" . $admin['email'] . "\", \"" . $admin['name'] . "\", \"" . $admin['age'] . "\", \"" . $admin['address'] . "\", \"" . $admin['sex'] . "\", \"" . $admin['birthdate'] . "\", \"" . $admin['contact_number'] . "\")'>Edit</button>";

                                    echo "<button class='table-button' onclick='openDeleteModal(" . $admin['admin_number'] . ")'>Delete</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }

                                // Pagination links
                                echo "<div class='pagination'>";
                                echo "<ul>";

                                if ($totalPages > 1) {
                                    // Previous page link
                                    if ($page > 1) {
                                        echo "<li><a href='admin_staff.php?page=" . ($page - 1);
                                        if (!empty($search)) {
                                            echo "&search=$search";
                                        }
                                        echo "'>&laquo;</a></li>";
                                    }

                                    // Page links
                                    for ($i = 1; $i <= $totalPages; $i++) {
                                        echo "<li><a href='admin_staff.php?page=$i";
                                        if (!empty($search)) {
                                            echo "&search=$search";
                                        }
                                        echo "'";
                                        if ($i === $page) {
                                            echo " class='active'";
                                        }
                                        echo ">$i</a></li>";
                                    }

                                    // Next page link
                                    if ($page < $totalPages) {
                                        echo "<li><a href='admin_staff.php?page=" . ($page + 1);
                                        if (!empty($search)) {
                                            echo "&search=$search";
                                        }
                                        echo "'>&raquo;</a></li>";
                                    }
                                }

                                echo "</ul>";
                                echo "</div>";
                                ?>

                            </tbody>

                        </table>
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



                    <!-- The Modal -->
                    <div id="addModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Add New Staff</h2>
                            <form id="addForm" method="POST" action="add_staff.php">
                                <!-- Input fields for staff information -->
                                <div class="form-control">
                                    <input type="text" name="name" placeholder="Name" required="">

                                </div>
                                <div class="form-group">

                                    <input type="number" class="form-control" id="age" name="age" min="13" max="120"
                                        placeholder="Enter Age" required>


                                </div>
                                <h3 class="description" style="margin-top:20px">Sex assigned at birth:</h3><br>
                                <div class="form-group">
                                    <label for="sex">Sex assigned at birth:</label>
                                    <select class="form-control" id="sex" name="sex" required>
                                        <option value="" disabled selected>Select Sex</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="birthdate">Birthdate:</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate"
                                        max="<?php echo date('Y-m-d', strtotime('-13 years')); ?>"
                                        placeholder="Enter Birthdate" required>

                                </div>

                                <!-- address -->

                                <div class="form-group">

                                    <select class="form-control" id="city" name="city">
                                        <option value="">Select City/Municipality</option>
                                        <!-- City options will be dynamically populated -->
                                    </select>
                                </div>

                                <div class="form-group">

                                    <select class="form-control" id="district" name="district">
                                        <option value="">Select District</option>
                                        <!-- District options will be dynamically populated -->
                                    </select>
                                </div>

                                <div class="form-group">

                                    <input type="text" class="form-control" id="barangay" name="barangay"
                                        placeholder="Enter Barangay">
                                </div>


                                <div class="form-group">

                                    <input type="text" class="form-control" id="street" name="street"
                                        placeholder="Lot/Block/House/Bldg. No., Subdivision/Village, Street:">
                                </div>
                                <!-- /address -->

                                <div class="form-group">
                                    <input type="tel" id="contact_number" name="contact_number"
                                        placeholder="Enter Contact Number"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11)"
                                        inputmode="numeric">

                                </div>


                                <div class="form-control">
                                    <input type="email" name="email" placeholder="Email">

                                </div>


                                <!-- Password Validation -->
                                <div class="form-control">
                                    <input type="password" name="password" id="password" placeholder="Password"
                                        oninput="checkPassword();">
                                </div>
                                <div class="show_password">
                                    <input type="checkbox" id="show-password" class="checkbox-input"
                                        onchange="togglePasswordVisibility('password', 'show-password');">
                                    <p>Show Password</p>
                                </div>
                                <div id="password_requirements">
                                    <!-- <p id="count">Length: 0</p> -->
                                    <p id="check0">At least 8 characters</p>
                                    <p id="check1">At least one uppercase letter (A-Z)</p>
                                    <p id="check2">At least one lowercase letter (a-z)</p>
                                    <p id="check3">At least one number (0-9)</p>
                                    <p id="check4">At least one special character (_-+!=@%*&":/ and etc.)</p>
                                    <p id="check5">Exceptions: \, ~, &lt;, space, tab</p>
                                </div>

                                <div class="form-control">
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        placeholder="Confirm Password" oninput="checkConfirmPassword();">
                                    <div class="show_password">
                                        <input type="checkbox" id="show-confirm-password" class="checkbox-input"
                                            onchange="togglePasswordVisibility('confirm_password', 'show-confirm-password');">
                                        <p>Show Password</p>
                                    </div>
                                </div>

                                <p id="confirm_password_message"></p>

                                <?php
                                if (isset($error_message)) {
                                    echo $error_message;
                                }
                                ?>
                                <!-- Password Validation and signup -->
                                <div class="submit_button">
                                    <button class="submit" type="submit" name="signup" id="signup-form">Create
                                        Staff Account</button>
                                </div>
                            </form>
                            <script src="password.js"></script>
                            <script src="address_behavior.js"></script>

                        </div>
                    </div>

                    <!-- edit modal -->
                    <div id="editModal" class="modal" action="update_staff.php">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Edit Admin</h2>
                            <form id="editForm" method="POST" action="update_admin.php">
                                <input id="adminNumber" name="adminNumber" value="" readonly />

                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" value="" readonly />

                                <label for="name">Name</label>
                                <input id="name" type="text" name="name" value="" />

                                <label for="age">Age</label>
                                <input id="age" type="number" name="age" value="" min="13" max="120" />


                                <label for="address">Address</label>
                                <input id="address" type="text" name="address" value="" />

                                <label for="sex">Sex</label>
                                <select id="sex" name="sex">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>

                                <label for="birthdate">Birthdate</label>
                                <input id="birthdate" type="date" name="birthdate" value=""
                                    max="<?php echo date('Y-m-d', strtotime('-13 years')); ?>" />


                                <label for="contactNumber">Contact Number</label>
                                <input id="contactNumber" type="tel" name="contactNumber" value="" />


                                <button type="submit">Submit</button>
                            </form>

                        </div>
                    </div>
                    <!-- delete modal -->
                    <div id="deleteModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Delete Admin</h2>
                            <form id="deleteForm" method="POST" action="delete_admin.php">
                                <input type='hidden' id='adminNumberDelete' name='adminNumber' value=''>

                                Are you sure you want to delete this admin? <br><br>

                                <button class='navigation-button' type='submit'>Delete</button>
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
                        function openEditModal(adminNumber, email, name, age, address, sex, birthdate, contactNumber) {
                            document.getElementById('adminNumber').value = adminNumber;
                            document.getElementById('email').value = email;
                            document.getElementById('name').value = name;
                            document.getElementById('age').value = age;
                            document.getElementById('address').value = address;
                            document.getElementById('sex').value = sex;
                            document.getElementById('birthdate').value = birthdate;
                            document.getElementById('contactNumber').value = contactNumber;

                            // Display the edit modal
                            editModal.style.display = 'block';
                        }


                        // Open the delete modal with populated data
                        function openDeleteModal(adminNumber) {
                            // Populate the admin number input field
                            document.getElementById("adminNumberDelete").value = adminNumber;

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