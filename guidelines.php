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
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">
    <script src="homepage_animations.js"></script>
    <title>Home Page</title>

</head>

<body>
    <div class="partition_1">
        <h3>GENERAL RULES AND REGULATIONS</h3><br>

        <h3>LOSS OF LIBRARY CARD:</h3>
        <p>Any person who loses his/her library card shall report the loss to the Reference
            Librarian/Assistant
            Reference Librarian for issuance of a duplicate library card after proper validation and
            submission
            of an affidavit of loss.</p>

        <h3>ACCOUNTABILITY:</h3>
        <p>Any person who borrowed a book or periodical shall be held accountable for it until its return.
        </p>
        <p>Failure to return a book or periodical borrowed for photocopying purposes shall result in
            suspension
            of library privileges depending on the gravity of the offense.</p>
        <p>Any person who uses an ID not his/her own or falsifies an ID card shall have his/her library
            privileges suspended.</p>
        </li>
    </div>

    <div class="partition_2">
        <h3>DESTROYING AND STEALING LIBRARY MATERIALS:</h3>
        <p>The following actions are strictly prohibited and subject to disciplinary action:</p>
        <p>Tearing, defacing, mutilating, and injuring any book, pamphlet, periodical, or any library
            property.</p>
        <p>Removing materials from the library without properly checking them out.</p> <br>

        <h3>DISORDERLY BEHAVIOR:</h3>

        <p>Disorderly conduct such as creating loud noises, disruptive behavior, eating inside the library
            premises, etc., shall result in suspension of library privileges.</p>


    </div>


    <div class="partition_4">
        <h3>LOST/DAMAGED BOOKS</h3>

        <p> Lost or damaged books must be replaced with the same author, title, and edition. Newer editions are also
            accepted. In case there are no available stocks of the lost or damaged book, any title with a similar
            subject is accepted.</p>


        <p>Borrowers who find major damage in the books they intend to borrow must report it immediately to the
            librarian; otherwise, they will be held responsible for the damage.</p> <br>

        <h3>USE OF PCs FOR INTERNET ACCESS</h3>

        <p>Proceed to the Computer Section and log in on the provided log book.</p>
        <p>Present your ID or Library Card to the Library Staff.</p>
        <p>Your ID or Library Card will be verified.</p>
        <p>Your time in and time out will be noted in the log book.</p>
        <p>Proceed to use available PCs. Provide copy paper (maximum of 10 pages) for printing.</p>
        <p>Log out on the provided log book.</p>

    </div>
    <script>
        // Function to check if an element is in viewport
        function isElementInViewport(el) {
            var rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        // Function to handle scroll event
        function handleScroll() {
            var animatedElements = document.querySelectorAll('.animate');
            animatedElements.forEach(function (element) {
                if (isElementInViewport(element) && !element.classList.contains('animated')) {
                    element.classList.add('animated');
                } else if (!isElementInViewport(element) && element.classList.contains('animated')) {
                    element.classList.remove('animated');
                }
            });
        }

        // Attach scroll event listener
        window.addEventListener('scroll', handleScroll);

        // Trigger the scroll event on page load
        handleScroll();
    </script>
    </section>

    <!--------------------Footer Section---------------------------------------->

    <?php include "footer.php"; ?>

</body>

</html>