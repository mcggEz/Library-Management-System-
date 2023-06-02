<?php
session_start();
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">
    <script src="homepage_animations.js"></script>
</head>

<body>


    <!-- brief histiry
vision and mission
objectives
contact us
location
 -->

    <!--------------------Contacts Section---------------------------------------->
    <div class="partition_7">
        <div class="contact-details">
            <h1>Library Management System Help</h1><br>

            <div class="help">
                <h3>1. How do I search for a book?</h3><br>
                <p>To search for a book, navigate to the search bar on the resources page of the website. You can
                    enter
                    the title,
                    author, or any relevant keywords related to the book you are looking for. Click the "Search"
                    button
                    or press Enter. The system will display a list of matching books based on your search criteria.
                </p><br>
            </div>
            <div class="help">
                <h3>2. How do I reserve for a book I want to borrow?</h3><br>
                <p>To reserve for a book, first, make sure you have logged into your library account. Search for the
                    book
                    you want to reserve using the search function. Once you have found the desired book, click on
                    the
                    borrow button and answer the form. Input the date of when you want to borrow the book and that
                    is it
                    you have reserved for a book.</p><br>
            </div>

            <div class="help">
                <h3>3. How can I answer the feedbacks form and what is it?</h3><br>
                <p>Feedback form is a way of communication your thoughts on the library itself. If you have some
                    recommendations or concers you can answer our feedback forms. To answer a feedback form , simply
                    login into your library account and head into the feedbacks page in your profile. Once there,
                    simply fill up the form and click submit when done.Review your feedback for clarity,
                    conciseness, and accuracy, and then submit the form.By following these steps, you can
                    effectively communicate your feedback to the library and contribute to its ongoing improvement
                    and development.</p><br>
            </div>

            <div class="help">
                <h3> 4. What should I do if I've lost a book or it gets damaged?</h3><br>

                <p>If you have lost a book or it has been damaged while in your possession, it's important to
                    contact
                    the library staff immediately. They will guide you on the necessary steps to resolve the issue,
                    such
                    as paying for a replacement or discussing possible repairs. For more information you can visit
                    our
                    Guidlines page where we ellaborate more on the steps and processes of such cases.</p><br>
            </div>

            <div class="help">
                <h3>5. How do I reserve a room?</h3><br>

                <p> To reserve a room, please follow these steps: Log into your library account, navigate to the
                    services page, Click on the "Reserve for a seat now" link. This would redirect you to a form
                    that
                    you would need to fill up. Provide
                    the required information, such as the purpose of the reservation and the date when you are going
                    to
                    visit. Review the reservation details and confirm your
                    booking.</p><br>
            </div>



            <div class="help">
                <h3>6. How can I see the latest announcements?</h3><br>
                <p> To see the announcements or news, follow these steps: Navigate to
                    the announcements or news section of the website. Scroll through the list of announcements to
                    see
                    the most recent ones. If you find an announcement that interests you, click on it to view the
                    full
                    details. Stay updated with the latest news and announcements from your
                    library by regularly checking this section.</p><br>
            </div>
            <div class="help_bottom">
                <p>If you have any further questions or need assistance with specific features, please reach out to
                    the
                    library staff for more detailed instructions.</p><br>
            </div>



        </div>
    </div>


    <!--------------------Footer Section---------------------------------------->
    <?php include "footer.php"; ?>


</body>

</html>