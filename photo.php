<?php
include "connection.php";


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the title and description from the form
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Check if a file was uploaded successfully
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = file_get_contents($_FILES['photo']['tmp_name']);

        // Prepare the INSERT statement
        $query = "INSERT INTO library_announcements (title, description, image) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "sss", $title, $description, $photo);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Check if the insertion was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $message = "Photo uploaded successfully.";
        } else {
            $message = "Failed to upload photo.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $message = "No photo selected or upload error occurred.";
    }
}

// Close the database connection
mysqli_close($db);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Upload Photo</title>
</head>

<body>
    <h1>Upload Photo</h1>
    <?php if (isset($message)): ?>
        <p>
            <?php echo $message; ?>
        </p>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="photo">Photo:</label>
        <input type="file" name="photo" accept="image/*" required><br>

        <input type="submit" value="Upload">
    </form>
</body>

</html>