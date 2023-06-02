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
                    <span class="text">Books</span>
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
                        Book</button>

                    <form action="generate_books.php" method="post">
                        <button type="submit" name="excel_button" class="navigation-button">Generate Report</button>
                    </form>
                </div>

                <!-- table  -->

                <div class="table-container">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Acc_Number</th>
                                <th>Date Received</th>
                                <th>Class Number</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Edition</th>
                                <th>Volume</th>
                                <th>Pages</th>
                                <th>Publisher</th>
                                <th>Year Availability</th>
                                <th>Section</th>
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
                            $query = "SELECT COUNT(*) AS total FROM library_books";

                            if (!empty($search)) {
                                $query .= " WHERE acc_number LIKE '%$search%'";
                                $query .= " OR author LIKE '%$search%'";
                                $query .= " OR title LIKE '%$search%'";
                            }

                            $result = mysqli_query($db, $query);
                            $row = mysqli_fetch_assoc($result);
                            $totalRecords = $row['total'];
                            $totalPages = ceil($totalRecords / $recordsPerPage);

                            // Get the current page from the URL parameter
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $offset = ($page - 1) * $recordsPerPage;

                            $query = "SELECT * FROM library_books";

                            if (!empty($search)) {
                                $query .= " WHERE acc_number LIKE '%$search%'";
                                $query .= " OR section LIKE '%$search%'";
                                $query .= " OR title LIKE '%$search%'";
                            }

                            $query .= " LIMIT $offset, $recordsPerPage";
                            $result = mysqli_query($db, $query);

                            // Display the library books records
                            while ($book = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $book['id'] . "</td>";
                                echo "<td>" . $book['acc_number'] . "</td>";
                                echo "<td>" . $book['date_received'] . "</td>";
                                echo "<td>" . $book['class_number'] . "</td>";
                                echo "<td>" . $book['author'] . "</td>";
                                echo "<td>" . $book['title'] . "</td>";
                                echo "<td>" . $book['edition'] . "</td>";
                                echo "<td>" . $book['volume'] . "</td>";
                                echo "<td>" . $book['pages'] . "</td>";
                                echo "<td>" . $book['publisher'] . "</td>";
                                echo "<td>" . $book['year_availability'] . "</td>";
                                echo "<td>" . $book['section'] . "</td>";
                                echo "<td>";
                                echo "<button class='table-button' onclick='openEditModal(" . $book['id'] . ", \"" . $book['acc_number'] . "\", \"" . $book['date_received'] . "\", \"" . $book['class_number'] . "\", \"" . $book['author'] . "\", \"" . $book['title'] . "\", \"" . $book['edition'] . "\", \"" . $book['volume'] . "\", \"" . $book['pages'] . "\", \"" . $book['publisher'] . "\", \"" . $book['year_availability'] . "\", \"" . $book['section'] . "\")'>Edit</button>";
                                echo "<button class='table-button' onclick='openDeleteModal(" . $book['id'] . ")'>Delete</button>";
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
                        echo "<a href='admin_books.php?page=" . ($page - 1);
                        if (!empty($search)) {
                            echo "&search=$search";
                        }
                        echo "'>&laquo;</a>";
                    }

                    // Page links
                    for ($i = 1; $i <= $totalPages; $i++) {
                        if ($i == $page) {
                            echo "<a class='active' href='admin_books.php?page=$i";
                        } else {
                            echo "<a href='admin_books.php?page=$i";
                        }
                        if (!empty($search)) {
                            echo "&search=$search";
                        }
                        echo "'>$i</a>";
                    }

                    // Next page link
                    if ($page < $totalPages) {
                        echo "<a href='admin_books.php?page=" . ($page + 1);
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
                        <h2>Add New Book</h2>
                        <form id="addForm" method="POST" action="add_book.php">
                            <div class="form-group">
                                <label for="acc_number">Acc_Number:</label>
                                <input type="text" id="acc_number" name="acc_number" placeholder="Acc_Number" required>
                            </div>
                            <div class="form-group">
                                <label for="date_received">Date Received:</label>
                                <input type="date" id="date_received" name="date_received" placeholder="Date Received"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="class_number">Class Number:</label>
                                <input type="text" id="class_number" name="class_number" placeholder="Class Number"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="author">Author:</label>
                                <input type="text" id="author" name="author" placeholder="Author" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" id="title" name="title" placeholder="Title" required>
                            </div>
                            <div class="form-group">
                                <label for="edition">Edition:</label>
                                <input type="text" id="edition" name="edition" placeholder="Edition" required>
                            </div>
                            <div class="form-group">
                                <label for="volume">Volume:</label>
                                <input type="text" id="volume" name="volume" placeholder="Volume" required>
                            </div>
                            <div class="form-group">
                                <label for="pages">Pages:</label>
                                <input type="number" id="pages" name="pages" placeholder="Pages" required>
                            </div>
                            <div class="form-group">
                                <label for="publisher">Publisher:</label>
                                <input type="text" id="publisher" name="publisher" placeholder="Publisher" required>
                            </div>
                            <div class="form-group">
                                <label for="year_availability">Year Availability:</label>
                                <input type="number" id="year_availability" name="year_availability"
                                    placeholder="Year Availability" required>
                            </div>
                            <label for="year_availability">Section:</label>
                            <select id="section" name="section" required>
                                <option value="" disabled selected>Select Section</option>
                                <option value="General Works">General Works</option>
                                <option value="Phillosophy">Philosophy</option>
                                <option value="Religion">Religion</option>
                                <option value="Social Sciences">Social Sciences</option>
                                <option value="Languages">Languages</option>
                                <option value="Sciencess">Sciences</option>
                                <option value="Useful Arts">Useful Arts</option>
                                <option value="Fine Arts">Fine Arts</option>
                                <option value="Literature">Literature</option>
                                <option value="history">history</option>
                                <!-- Add more specific section options as needed -->
                            </select>

                            <button class="submit" type="submit" name="add_book">Add Book</button>
                        </form>
                    </div>
                </div>


                <!-- edit modal -->
                <div id="editModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Edit Admin</h2>
                        <form id="editForm" method="POST" action="update_books.php">
                            <input id="bookId" name="bookId" value="" />

                            <label for="accNumber">Acc_Number</label>
                            <input id="accNumber" type="text" name="accNumber" value="" readonly />

                            <label for="dateReceived">Date Received</label>
                            <input id="dateReceived" type="text" name="dateReceived" value="" readonly />

                            <label for="classNumber">Class Number</label>
                            <input id="classNumber" type="text" name="classNumber" value="" />

                            <label for="author">Author</label>
                            <input id="author" name="author" value="" />

                            <label for="title">Title</label>
                            <input id="title" type="text" name="title" value="" />

                            <label for="edition">Edition</label>
                            <input id="edition" type="text" name="edition" value="" />

                            <label for="volume">Volume</label>
                            <input id="volume" type="text" name="volume" value="" />

                            <label for="pages">Pages</label>
                            <input id="pages" name="pages" value="" />

                            <label for="publisher">Publisher</label>
                            <input id="publisher" type="text" name="publisher" value="" />

                            <label for="yearAvailability">Year Availability</label>
                            <input id="yearAvailability" type="text" name="yearAvailability" value="" />

                            <label for="section">Section</label>
                            <select id="section" name="section" required>
                                <option value="" disabled selected>Select Section</option>
                                <option value="General Works">General Works</option>
                                <option value="Phillosophy">Philosophy</option>
                                <option value="Religion">Religion</option>
                                <option value="Social Sciences">Social Sciences</option>
                                <option value="Languages">Languages</option>
                                <option value="Sciencess">Sciences</option>
                                <option value="Useful Arts">Useful Arts</option>
                                <option value="Fine Arts">Fine Arts</option>
                                <option value="Literature">Literature</option>
                                <option value="history">history</option>
                                <!-- Add more specific section options as needed -->
                            </select>

                            <button type="submit">Submit</button>
                        </form>

                    </div>
                </div>


                <!-- delete modal -->
                <div id="deleteModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Delete Book</h2>
                        <form id="deleteForm" method="POST" action="delete_books.php">
                            <input type="hidden" id="bookIdDelete" name="bookId" value="">

                            <p>Are you sure you want to delete this book?</p><br><br>

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

                    function openEditModal(id, accNumber, dateReceived, classNumber, author, title, edition, volume, pages, publisher, yearAvailability, section) {
                        document.getElementById('bookId').value = id;
                        document.getElementById('accNumber').value = accNumber;
                        document.getElementById('dateReceived').value = dateReceived;
                        document.getElementById('classNumber').value = classNumber;
                        document.getElementById('author').value = author;
                        document.getElementById('title').value = title;
                        document.getElementById('edition').value = edition;
                        document.getElementById('volume').value = volume;
                        document.getElementById('pages').value = pages;
                        document.getElementById('publisher').value = publisher;
                        document.getElementById('yearAvailability').value = yearAvailability;
                        document.getElementById('section').value = section;

                        // Display the edit modal
                        editModal.style.display = 'block';
                    }



                    // Open the delete modal with populated data
                    function openDeleteModal(id) {
                        // Populate the ID input field
                        document.getElementById("bookIdDelete").value = id;

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
                    var addCloseButtons = document.getElementsByClassName("add-close");
                    for (var i = 0; i < addCloseButtons.length; i++) {
                        addCloseButtons[i].addEventListener("click", function () {
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