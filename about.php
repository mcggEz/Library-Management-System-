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

    <style>
        .fade {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .fade.animated {
            opacity: 1;
        }
    </style>
</head>

<body>


    <!-- Contacts Section -->
    <div class="partition_1">

        <h2 class="animate fade">Brief History</h2> <br>
        <p class="animate fade">The New Manila-Sacramento Friendship Library was initially known as the Paco Branch
            Library and opened in 1931 at Trece de Agosto Street. On account of World War II, the library
            transferred to various locations until a newly constructed library building was built at the corner
            of
            Canonigo and Zamora Streets on October 6, 1958. On May 21, 1965, the name Paco Public Library was
            changed to Manila Sacramento Friendship Library to symbolize the sister-city relationship between
            the
            City of Manila and the City of Sacramento, California, U.S.A. As part of the "Buhayin ang Maynila"
            program of Mayor Jose L. Atienza Jr., the Manila-Sacramento Friendship Library has undergone major
            renovation, restoration, and development to provide modern facilities and convenience for the
            ever-growing reading public. A marker is installed on this site this 21st day of August 2004.</p>

    </div>
    <div class="partition_2">

        <h2 class="animate fade">Mission</h2><br>
        <p class="animate fade">The Manila City Library provides residents of the City of Manila free and equitable
            access to library services. It preserves and promotes universal access to a broad range of human
            knowledge, experience, information, and ideas in a convivial and caring environment.</p><br>

        <h2 class="animate fade">Vision</h2><br>
        <p class="animate fade">Manila City Library aspires to spearhead the intellectual development of the
            residents of
            the City of Manila so as to make them more resilient, knowledgeable, connected with a wide range of
            information, and successful.</p>

    </div>
    <div class="partition_3">
        <h2 class="animate fade">Objectives</h2><br>
        <ol class="animate fade">
            To promote the aesthetic expressions and exercise the appreciation of the arts to generate
            talent
            and capabilities.<br><br>
            To develop and encourage personal inquiry to enable individuals to discover a more meaningful
            life.<br><br>

            To provide library users with the necessary materials for intellectual development and success.<br><br>

            To establish diverse and significant interests to develop awareness of a modern outlook on life.

        </ol>

    </div>
    <div class="partition_4">


        <h2 class="animate fade">Contact Us</h2><br>
        <p class="animate fade">Monday - Friday (No Noon Break)</p><br>
        <p class="animate fade">8:00 AM - 4:00 PM</p><br>
        <p class="animate fade">Manila-Sacramento Friendship Library Zamora cor.</p>
        <p class="animate fade">Canonigo St., Paco, Manila.</p>
        <p class="animate fade">Mylene C. Villanueva, Officer-In-Charge</p><br>
        <p class="animate fade">Email manila-library@gmail.com</p>
        <p class="animate fade">Cellphone Number: 09999999999</p>
        <p class="animate fade">Tel. No. (02) 5xxx-2xxx</p>
    </div>


    <!-- Footer Section -->
    <?php include "footer.php"; ?>

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
</body>

</html>