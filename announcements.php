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
    <style>
        .announcement {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 10px;
            background-color: #d0e1d7;
        }

        .announcement h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .announcement p {
            margin-bottom: 10px;
        }

        .announcement .category {
            font-style: italic;
        }

        .announcement .see-more {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
            text-align: center;
        }

        .announcement .see-more:hover {
            background-color: #45a049;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: black;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
            border: 1px solid #ddd;
        }

        .pagination a.active-page {
            background-color: #4CAF50;
            color: white;
        }

        .pagination a:hover:not(.active-page) {
            background-color: #ddd;
        }


        /* header */
        .announcement-container_header {
            overflow-x: scroll;
            white-space: nowrap;
        }

        .image-container_header {
            display: inline-block;
        }

        .announcement_header {
            display: inline-block;
            margin-right: 10px;
        }

        .announcement_header img {
            max-width: 100%;
            height: auto;
        }

        .announcement-title_header {
            margin-top: 5px;
            text-align: center;
        }

        .announcement_title {
            margin-bottom: 50px;
        }
    </style>

</head>

<body>
    <!--------------------Hero Section---------------------------------------->
    <main>

        <!--------------------Borrowing-Section---------------------------------------->
        <section class="announcements_body_section">
            <!-- <h2>Body</h2> -->

            <h2 class="announcement_title">Announcements</h2>
            <?php
            // Number of announcements to display per page
            $announcementsPerPage = 5;

            // Get the current page number from the query string
            if (isset($_GET['page'])) {
                $currentPage = $_GET['page'];
            } else {
                $currentPage = 1;
            }

            // Calculate the starting announcement index for the current page
            $startingAnnouncement = ($currentPage - 1) * $announcementsPerPage;

            // Fetch the announcement data from the database with pagination
            $query = "SELECT * FROM library_announcements ORDER BY date_posted DESC LIMIT $startingAnnouncement, $announcementsPerPage";
            $result = mysqli_query($db, $query);

            // Check if any announcements were found
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row['title'];
                    $description = $row['description'];
                    $datePosted = $row['date_posted'];

                    $category = $row['category'];

                    // Truncate the description
                    $truncatedDescription = $description;
                    if (strlen($description) > 20) {
                        $truncatedDescription = substr($description, 0, 20) . "...";
                    }

                    // Display the announcement
                    echo "<div class='announcement'>";
                    echo "<h2>$title</h2>";
                    if (!empty($image)) {

                    }
                    echo "<p>$truncatedDescription</p>";
                    echo "<p class='category'>Category: $category</p>";
                    echo "<a href='announcement_details.php?announcement_id={$row['announcement_id']}' class='see-more'>See More</a>";
                    echo "</div>";
                }
            } else {
                echo "No announcements found.";
            }

            // Pagination links
            $queryCount = "SELECT COUNT(*) AS total FROM library_announcements";
            $resultCount = mysqli_query($db, $queryCount);
            $rowCount = mysqli_fetch_assoc($resultCount);
            $totalAnnouncements = $rowCount['total'];
            $totalPages = ceil($totalAnnouncements / $announcementsPerPage);

            echo "<div class='pagination'>";
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $currentPage) {
                    echo "<a href='announcements.php?page=$i' class='active-page'>$i</a>";
                } else {
                    echo "<a href='announcements.php?page=$i'>$i</a>";
                }
            }
            echo "</div>";


            // Close the database connection
            mysqli_close($db);
            ?>



        </section>


        <?php include "footer.php"; ?>

    </main>
</body>

</html>