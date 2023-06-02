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
    <!--------------------Hero Section---------------------------------------->


    <div class="partition_1">
        <h1>READING ROOM SERVICE</h1> <br>
        <p>Reading Rooms are open on Mondays - Fridays (except holidays and special non-working holidays) at
            9:00 AM- 4:00 PM. Reserve a seat at least 1 day ahead of your
            intended library visit.
        </p>
        <br>
        <?php
        if (isset($_SESSION['control_number'])) {
            $control_number = $_SESSION['control_number'];

            // Retrieve the user's information from the database
            $selectStmt = $db->prepare("SELECT * FROM `user` WHERE `control_number`=?");
            $selectStmt->bind_param("i", $control_number);
            $selectStmt->execute();
            $user = $selectStmt->get_result()->fetch_assoc();
        }

        if (isset($_SESSION["control_number"])) {
            echo '<button class="navigation-button"><a href="reservation.php">Reserve for a seat now!</a></button>';
        } else {
            echo '<button class="navigation-button"><a href="login.php">Login to reserve a seat.</a></button>';
        }
        ?>
    </div>
    </section>
    <!--------------------Borrowing-Section---------------------------------------->
    <div class="partition_2">
        <h2>BORROWING AND RETURNING</h2> <br>


        <p> Any person may borrow books in the library by clicking this link and make sure you sign up on your
            google account to open this link: Click here to request a book.
        </p><br>


        <button class="navigation-button"><a href="sections.php">Borrow A Book
                Now!</a></button>
    </div>
    <div class="partition_3">
        <h3>CHECKING-IN / RETURNING BOOKS</h3> <br>
        <p>Present books to be returned.</p>

        <p> Place the books on the book truck or reading table.</p>

        <p>Library Card will be returned once transaction is completed.</p>

    </div>


    <div class="partition_4">
        <h3>LIBRARY READERS SERVICE SECTION</h3> <br>
        <p>
            Child Friendly Activities:
        <ul>
            <p>Board Games</p>
            <p>Drawing and Coloring Activity Library Orientation</p>
            <p>Educational Film Showing</p>
            <p>Puppet Show</p>
            <p>Storytelling Sessions</p>
        </ul>

        Reference Services:
        <ul>
            <p>Comp and Internet Access Services</p>
            <p>Makerspace</p>
            <p>Manila Irma on Reference Online Services (MIROS)</p>
            <p>Periodicals, Books, and E-resources</p>
            <p>Reading, Writing, Arts, and Math tutorials</p>
        </ul>
    </div>

    <div class="partition_5">
        <h3> The MANILA CITY LIBRARY (MCL) Computer and Internet Section offers the following services:</h3> <br>
        <p>

        <ul>
            <p>Research Purposes</p>
            <p>Computer Tutorials (Digital Literacy Programs for Children and Senior Citizens)</p>
            <p>Do-It-Yourself (DIY) Video Tutorials</p>
            <p>E-Government Services (SSS, Pag-ibig, DFA/PSA/PRC Appointment, GSIS, and others)</p>
        </ul>

        Library Sections:
        <ul>
            <p>Children’s Section</p>
            <p>Circulation Section</p>
            <p>Computer Section</p>
            <p>E-Books Section (Fiction Books)</p>
            <p>Filipiniana Section</p>
            <p>General Reference Section</p>
            <p>Mailaniana Section</p>
            <p>Periodical Section</p>
            <p>Space User (for students who conduct activity outside the library)</p>
        </ul>

    </div>
    <?php include "footer.php"; ?>


</body>

</html>