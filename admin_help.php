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
                    <i class="uil uil-question-circle"></i>
                    <span class="text">Admin Help</span>
                </div>
                <div class="content">
                    <div class="help">
                        <h3>1. How do I record library user activities?</h3>
                        <p>To record library user activities, navigate to the User
                            library forms section.
                            Here, you can answer the form for the specfic services the library user used. </p>
                    </div>

                    <div class="help">
                        <h3>2. How can I view library members?</h3>
                        <p>To view the library members, access the Members section in the admin panel. This section
                            will display a list
                            of registered library members along with their basic details, such as names, contact
                            information, and
                            status. You may have options to search for specific members.</p>
                    </div>

                    <div class="help">
                        <h3>3. How can I add staff members?</h3>
                        <p>To add staff members, go to the Staffs section in the admin panel. Here, you can add new
                            staff members by
                            providing their details such as name, email, and role. Submit the form to add the staff
                            member to the
                            system.</p>
                    </div>

                    <div class="help">
                        <h3>4. How can I manage book inventory?</h3>
                        <p>To manage the book inventory, navigate to the Books section in the admin panel. Here, you
                            can add new books,
                            update existing book details and delete books that are already unavailable. Make use of the
                            provided forms or buttons to perform inventory management tasks
                            effectively.</p>
                    </div>

                    <div class="help">
                        <h3>5. How can I view borrowed books?</h3>
                        <p>To view the borrowed books, access the Borrowed Books section in the admin panel. This
                            section will display a
                            list of books that are currently borrowed by library members. You can see the details of
                            the borrowers, due
                            dates, and any fines associated with the borrowed books.</p>
                    </div>

                    <div class="help">
                        <h3>6. How can I manage reservations?</h3>
                        <p>You can manage them in the Reservations which could be a book reservation or a room
                            reservation. You can go to the Reservation section
                            of the admin panel.
                            Here, you can view the list of book reservations and room reservations and process them. The
                            information in the reservation section could help cater the library user needs</p>
                    </div>

                    <div class="help">
                        <h3>7. How can I create announcements?</h3>
                        <p>To create announcements for library users, go to the Announcements section in the admin
                            panel. Here, you can
                            compose announcements regarding library events, new book arrivals, or any other
                            important information.
                            Publish the announcements to make them visible to library members.</p>
                    </div>

                    <div class="help">
                        <h3>8. How can I manage feedbacks?</h3>
                        <p>In the Feedbacks section of the admin panel, you can view and respond to feedback
                            provided by library
                            members. This section allows you to review feedback, address any concerns or inquiries,
                            and maintain
                            communication with library users.</p>

                    </div>
    </section>

    <script src="admin.js"></script>
</body>

</html>