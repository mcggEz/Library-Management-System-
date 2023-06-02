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



    <!--------------------Hero Section---------------------------------------->
    <main>
        <section class="hero-section">
            <div class="text-container">
                <h1>Manila's Premier Library Destination</h1>
                <p>Welcome to our online library, where you
                    can access a vast collection of books,
                    articles, and resources from anywhere at
                    any time. Our goal is to make reading and
                    learning as convenient and accessible as
                    possible. Feel free to browse and discover
                    new perspectives.
                </p>

            </div>
        </section>

        <div class="separator_1"></div>
        <!--------------------History Section---------------------------------------->
        <section class="history-section">
            <div class="history_image_container"><img src="images/library.png" class="library_image"></div>


            <div class="history_text_ctn">
                <p class="history_text">
                    Manila-Sacramento Friendship Library is a historic library located in Manila. It was founded in
                    the
                    early 1900s and offers a wide selection of books, magazines, and periodicals. It has become a
                    landmark
                    in the city and a popular spot for book lovers to browse, borrow, and discuss literature.
                </p>
            </div>
        </section>

        <div class="separator_1"></div>
        <!--------------------Branches Sections---------------------------------------->
        <section class="branches_section">
            <h2>Library Branches</h2>

            <style>
                .branches-container {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                    grid-gap: 20px;
                    padding: 60px;
                }

                /* /Branches Section*/
                .branches_section {
                    background-color: #bccdbc;
                    text-align: center;
                    font-weight: bold;
                    font-size: 20px;
                    padding: 4rem 4rem;
                    /* height: 85vh; */
                }

                @media screen and (max-width: 768px) {
                    .branches_section {
                        padding: 20px;
                    }

                    .branches-container {
                        padding: 0px;
                    }
                }


                .card {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    background-color: #4e6a4e;
                    color: #ffffff;
                    border-radius: 5px;
                    padding: 20px;
                    box-sizing: border-box;
                    text-align: center;
                    text-decoration: none;
                    transition: background-color 0.3s ease, transform 0.3s ease;
                    min-height: 320px;
                }

                .card:hover {
                    background-color: #6aa56c;
                    transform: translateY(-10px);
                }

                .card img {
                    max-width: 100%;
                    height: auto;
                    margin-bottom: 15px;
                }

                .card-title {
                    font-size: 24px;
                    margin-bottom: 10px;
                }

                .card-text {
                    font-size: 16px;
                    margin-bottom: 5px;
                }

                .card-content {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    padding: 20px;
                    box-sizing: border-box;
                    text-align: center;
                    text-decoration: none;
                }

                .card img {
                    max-width: 100%;
                    max-height: 200px;
                    width: auto;
                    height: auto;
                    margin-bottom: 15px;
                }
            </style>
            <title>Card UI</title>
            </head>

            <body>
                <section class="branches-container">
                    <a href="https://sites.google.com/view/manilacitylibrary/home?authuser=0" class="card">
                        <div class="card-content">
                            <img src="images/main_library.png" alt="Main Library">
                            <h3 class="card-title">Manila City Library (Main Library)</h3>

                            <p class="card-text">800 Taft Ave, Ermita, Manila, 1000 Metro Manila</p>
                            <p class="card-text">Contact Number: 02-828-31948</p>
                        </div>
                    </a>

                    <a href="https://www.facebook.com/BacoodPublicLibrary.gov/" class="card">
                        <div class="card-content">
                            <img src="images/bacood_library.png" alt="Bacood Public Library" />
                            <h3 class="card-title">Bacood Public Library</h3>
                            <p class="card-text">3825 Biyaya St., Bacood, Sta. Mesa, Manila</p>
                            <p class="card-text">Contact Number: 02-828-29581</p>
                        </div>
                    </a>

                    <a href="https://www.facebook.com/people/Kapitan-Isidro-Mendoza-Public-Library-MCL/100064583690313/"
                        class="card">
                        <div class="card-content">
                            <img src="images/kapitan_mendoza_library.png" alt="Kapitan Isidro Mendoza Public Library">
                            <h3 class="card-title">Kapitan Isidro Mendoza Public Library</h3>
                            <p class="card-text">T. San Luis St., Pandacan, Manila</p>
                            <p class="card-text">Contact Number: 02-5310-2582</p>
                        </div>
                    </a>

                    <a href="https://www.facebook.com/people/Arsenio-H-lacson-public-library-sta-anamanila/100066297739545/"
                        class="card">
                        <div class="card-content">
                            <img src="images/arsenio_lacson_library.png" alt="Arsenio H. Lacson Public Library">
                            <h3 class="card-title">Arsenio H. Lacson Public Library</h3>
                            <p class="card-text">Calderon cor. Suter St., Sta Ana, Manila</p>
                            <p class="card-text">Contact Number: 02-5310-2674</p>
                        </div>
                    </a>

                    <a href="" class="card">
                        <div class="card-content">
                            <img src="images/manila_sanfrancisco_library.png"
                                alt="Manila-San Francisco Friendship Library">
                            <h3 class="card-title">Manila-San Francisco Friendship Library</h3>
                            <p class="card-text">1559 Alvarez St., Sta Cruz, Manila</p>
                            <p class="card-text">Contact Number: 02-5310-2576</p>
                        </div>
                    </a>

                    <a href="" class="card">
                        <div class="card-content">
                            <img src="images/patricia_public_library.png" alt="Patricia Public Library">
                            <h3 class="card-title">Patricia Public Library</h3>
                            <p class="card-text">Floral cor. Benita St., Gagalangin, Tondo, Manila</p>
                            <p class="card-text">Contact Number: 09750391499/09282604301</p>
                        </div>
                    </a>

                    <a href="" class="card">
                        <div class="card-content">
                            <img src="images/dapitan_library.png" alt="Dapitan Public Library">
                            <h3 class="card-title">Dapitan Public Library</h3>
                            <p class="card-text">Instruccion St., cor. Dapitan St., Sampaloc, Manila</p>
                            <p class="card-text">Contact Number: 02-5310-2674</p>
                        </div>
                    </a>


                </section>







                <!--------------------Footer Section---------------------------------------->


    </main>
    <?php include "footer.php"; ?>
</body>

</html>