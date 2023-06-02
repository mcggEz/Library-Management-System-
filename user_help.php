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
            <div class="mode-toggle"></div>

        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Library Management System Help</span>
                </div>

                <div class="help">
                    <h3>1. How do I search for a book?</h3>
                    <p>To search for a book, navigate to the search bar on the resources page of the website. You can
                        enter
                        the title,
                        author, or any relevant keywords related to the book you are looking for. Click the "Search"
                        button
                        or press Enter. The system will display a list of matching books based on your search criteria.
                    </p>
                </div>
                <div class="help">
                    <h3>2. How do I reserve for a book I want to borrow?</h3>
                    <p>To reserve for a book, first, make sure you have logged into your library account. Search for the
                        book
                        you want to reserve using the search function. Once you have found the desired book, click on
                        the
                        borrow button and answer the form. Input the date of when you want to borrow the book and that
                        is it
                        you have reserved for a book.</p>
                </div>

                <div class="help">
                    <h3>3. How can I answer the feedbacks form and what is it?</h3>
                    <p>Feedback form is a way of communication your thoughts on the library itself. If you have some
                        recommendations or concers you can answer our feedback forms. To answer a feedback form , simply
                        login into your library account and head into the feedbacks page in your profile. Once there,
                        simply fill up the form and click submit when done.Review your feedback for clarity,
                        conciseness, and accuracy, and then submit the form.By following these steps, you can
                        effectively communicate your feedback to the library and contribute to its ongoing improvement
                        and development.</p>
                </div>

                <div class="help">
                    <h3> 4. What should I do if I've lost a book or it gets damaged?</h3>

                    <p>If you have lost a book or it has been damaged while in your possession, it's important to
                        contact
                        the library staff immediately. They will guide you on the necessary steps to resolve the issue,
                        such
                        as paying for a replacement or discussing possible repairs. For more information you can visit
                        our
                        Guidlines page where we ellaborate more on the steps and processes of such cases.</p>
                </div>

                <div class="help">
                    <h3>5. How do I reserve a room?</h3>

                    <p> To reserve a room, please follow these steps: Log into your library account, navigate to the
                        services page, Click on the "Reserve for a seat now" link. This would redirect you to a form
                        that
                        you would need to fill up. Provide
                        the required information, such as the purpose of the reservation and the date when you are going
                        to
                        visit. Review the reservation details and confirm your
                        booking.</p>
                </div>



                <div class="help">
                    <h3>6. How can I see the latest announcements?</h3>
                    <p> To see the announcements or news, follow these steps: Navigate to
                        the announcements or news section of the website. Scroll through the list of announcements to
                        see
                        the most recent ones. If you find an announcement that interests you, click on it to view the
                        full
                        details. Stay updated with the latest news and announcements from your
                        library by regularly checking this section.</p>
                </div>
                <div class="help_bottom">
                    <p>If you have any further questions or need assistance with specific features, please reach out to
                        the
                        library staff for more detailed instructions.</p>
                </div>

            </div>
        </div>
    </section>

    <script src="admin.js"></script>
</body>

</html>