<?php
// Start the session
session_start();

// Include the database connection file
include 'connection.php';

// Check if the form has been submitted
if (isset($_POST['submit'])) {

    // Retrieve the control number from the form
    $control_number = $_POST['control_number'];

    // Query the user table to retrieve the user's information
    $query = "SELECT * FROM user WHERE control_number = '$control_number'";
    $result = mysqli_query($db, $query);

    // Check if the query returned any result
    if (mysqli_num_rows($result) > 0) {

        // Fetch the user's information
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $age = $row['age'];
        $sex = $row['sex'];

        // Store the user's information in session variables
        $_SESSION['name'] = $name;
        $_SESSION['age'] = $age;
        $_SESSION['sex'] = $sex;

        // Insert the user's information into the attendance table
        $query = "INSERT INTO attendance (control_number, age, sex) VALUES ('$control_number', '$age', '$sex')";
        mysqli_query($db, $query);

        // Redirect the user back to the form page with a success message
        header('Location: index.php?success=1');
        exit;

    } else {
        // If no result is returned, redirect the user back to the form page with an error message
        header('Location: index.php?error=1');
        exit;
    }
}