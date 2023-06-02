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
    <main>
        <section class="announcements_section">
            <div>
                <div class="back_button">
                    <a href="announcements.php">Go Back</a>
                </div>
                <?php
                // Check if the announcement ID is provided in the URL
                if (isset($_GET['announcement_id'])) {
                    // Get the announcement ID from the URL
                    $announcementId = $_GET['announcement_id'];

                    // Fetch the announcement data from the database
                    $query = "SELECT * FROM library_announcements WHERE announcement_id = $announcementId";
                    $result = mysqli_query($db, $query);

                    // Check if the announcement exists
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);

                        $title = $row['title'];
                        $description = $row['description'];
                        $datePosted = $row['date_posted'];

                        $category = $row['category'];

                        // Display the announcement details
                        echo "<div class='announcement-details'>";
                        echo "<h2>$title</h2>";
                        if (!empty($image)) {

                        }
                        echo "<p>Date Posted: $datePosted</p>";
                        echo "<p class='category'>Category: $category</p>";
                        echo "<p>$description</p>";
                        echo "</div>";
                    } else {
                        echo "Announcement not found.";
                    }

                    // Close the database connection
                    mysqli_close($db);
                } else {
                    echo "Invalid announcement ID.";
                }
                ?>
            </div>
        </section>





        <!--------------------Footer-Section---------------------------------------->
        <?php include "footer.php"; ?>

    </main>
</body>

</html>