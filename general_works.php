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
</head>

<body>
    <main>
        <section class="section">
            <div class="search">
                <h1>Sections</h1>
                <div class="group">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                        <g>
                            <path
                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                            </path>
                        </g>
                    </svg>
                    <input placeholder="Search" type="search" class="input">
                </div>
            </div>
            <p class="">Welcome to our Section page!
                Here, you can browse our extensive catalog
                of books with ease. Simply use the search bar or
                browse through the categories to find your next
                great read. We also provide detailed descriptions
                and reviews for each book, making it easy for you
                to decide which one to pick. Happy reading!</p>

            <style>
                /* Responsive grid system */
                .sections-container {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                    grid-gap: 20px;
                    padding: 20px;
                }

                .card {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: #82ca86;
                    color: #ffffff;
                    height: 250px;
                    border-radius: 5px;
                    padding: 20px;
                    box-sizing: border-box;
                    text-align: center;
                    text-decoration: none;
                    transition: background-color 0.3s ease, transform 0.3s ease;
                }

                .card:hover {
                    background-color: #6aa56c;
                    transform: translateY(-10px);
                }
            </style>
            <section class="sections-container">
                <a href="general_works.php" class="card">General Works</a>
                <a href="philosophy.php" class="card">Philosophy</a>
                <a href="religion.php" class="card">Religion</a>
                <a href="social_sciences.php" class="card">Social Sciences</a>
                <a href="language.php" class="card">Language</a>
                <a href="science.php" class="card">Science</a>
                <a href="useful_arts.php" class="card">Useful Arts</a>
                <a href="fine_arts.php" class="card">Fine Arts</a>
                <a href="literature.php" class="card">Literature</a>
                <a href="history.php" class="card">History</a>
            </section>


        </section>

        <!--------------------Footer Section---------------------------------------->
        <?php include "footer.php"; ?>

</body>

</html>