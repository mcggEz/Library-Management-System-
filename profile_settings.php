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
    <link rel="stylesheet" href="user.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">

    <title>Admin_dashboard</title>
</head>

<body>


    <section class="dashboard">
        <div class="side">
            <div class="side_navigation">
                <a href="user_dashboard.php">
                    <h3>Dashboard</h3>
                </a>
                <a href="profile_settings.php">
                    <h3>Profile Settings</h3>
                </a>
                <a href="notifications.php">
                    <h3>Notifications </h3>
                </a>
                <a href="history.php">
                    <h3>History</h3>
                </a>
                <a href="settings.php">
                    <h3>Settings</h3>
                </a>
                <a href="logout.php">
                    <h3>Logout</h3>
                </a>


            </div>
        </div>
        <main>
            <?php
            // Check if the user is logged in
            if (isset($_SESSION['control_number'])) {
                $control_number = $_SESSION['control_number'];

                // Retrieve the user's information from the database
                $selectStmt = $db->prepare("SELECT * FROM `user` WHERE `control_number`=?");
                $selectStmt->bind_param("i", $control_number);
                $selectStmt->execute();

                $result = $selectStmt->get_result();

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();

                    // Display the user's information
                    echo "<h2>User Profile</h2>";
                    echo "<p>Control Number: " . $row['control_number'] . "</p>";
                    echo "<p>Name: " . $row['name'] . "</p>";
                    echo "<p>Sex: " . $row['sex'] . "</p>";
                    echo "<p>Age: " . $row['age'] . "</p>";
                    echo "<p>Birthdate: " . $row['birthdate'] . "</p>";
                    echo "<p>School/Organization: " . $row['school_organization'] . "</p>";
                    echo "<p>Address: " . $row['address'] . "</p>";
                    echo "<p>Contact Number: " . $row['contact_number'] . "</p>";
                    echo "<p>Email: " . $row['email'] . "</p>";
                } else {
                    // Display an error message
                    echo "<p>Error: User not found.</p>";
                }
            }
            ?>


        </main>

    </section>

</body>

</html>