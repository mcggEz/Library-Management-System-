<?php
session_start();
include "connection.php";

// Redirect user if not logged in
if (!isset($_SESSION['control_number'])) {
    header("Location: login.php");
    exit();
}

include "navbar.php";

// Check if submit button is clicked
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controlNumber = $_SESSION['control_number'];
    $commentType = $_POST['comment_type'];
    $commentSubject = $_POST['comment_subject'];
    $comments = $_POST['comments'];
    $created_at = date('Y-m-d H:i:s');

    // Sanitize inputs
    $commentType = mysqli_real_escape_string($db, $commentType);
    $commentSubject = mysqli_real_escape_string($db, $commentSubject);
    $comments = mysqli_real_escape_string($db, $comments);

    // Insert the feedback into the database
    $insertQuery = "INSERT INTO user_feedbacks (control_number, comment_type, comment_subject, comments, created_at) VALUES (?, ?, ?, ?, ?)";
    $insertStmt = mysqli_prepare($db, $insertQuery);
    mysqli_stmt_bind_param($insertStmt, "sssss", $controlNumber, $commentType, $commentSubject, $comments, $created_at);
    mysqli_stmt_execute($insertStmt);

    if (mysqli_stmt_affected_rows($insertStmt) > 0) {
        // Feedback submitted successfully

        $message = "Thank you for your feedback! Rest assured that we will take action on your feedback.";
        $msg = true;
    } else {
        // Error occurred while inserting feedback
        $message = "Error submitting feedback. Please try again";
        $msg = true;
    }
    if ($msg) {
        $popup_message[] = $message;
        $message_str = implode('\n', $popup_message);
        echo '<script type="text/javascript">
            window.onload = function(){
                alert("' . $message_str . '");
                window.location.href = "user_dashboard.php";
            }
        </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user_dashboard.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">

    <title>User Dashboard Panel</title>
    <style>
        .feedbacks_container {
            max-width: 400px;
            ;
            padding: 20px;
        }

        .feedbacks_container label,
        .feedbacks_container select,
        .feedbacks_container textarea {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: 400;
            white-space: nowrap;
            color: var(--text-color);
        }

        .feedbacks_container textarea {
            height: 100px;
            width: 347px;
            margin-bottom: 30px;
        }

        .feedbacks_container button {
            padding: 10px;
        }
    </style>
</head>

<body>

    <nav class="sidebar">
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="user_dashboard.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li>
                    <a href="user_profile.php">
                        <i class="uil uil-setting"></i>
                        <span class="link-name">Profile</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="user_notifications.php">
                        <i class="uil uil-bell"></i>
                        <span class="link-name">Notifications</span>
                    </a>
                </li> -->
                <li><a href="user_feedbacks.php">
                        <i class="uil uil-comment-dots"></i>
                        <span class="link-name">Feedbacks</span>
                    </a></li>
                <li>
                    <a href="user_settings.php">
                        <i class="uil uil-setting"></i>
                        <span class="link-name">Settings</span>
                    </a>
                </li>
            </ul>
            <li><a href="user_help.php">
                    <i class="uil uil-question-circle"></i>
                    <span class="link-name">Help</span>
                </a></li>

            <ul class="logout-mode">
                <li><a href="logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>


            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="mode-toggle"></div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Library Feedback Form</span>

                </div>

                <div class="activity">
                    <div class="feedbacks_container">

                        <form action="" method="POST">
                            <label for="comment_type">What kind of comment would you like to send?</label>
                            <select id="comment_type" name="comment_type" required>
                                <option value="">Select an option</option>
                                <option value="Complaint">Complaint</option>
                                <option value="Problem">Problem</option>
                                <option value="Suggestion">Suggestion</option>
                                <option value="Praise">Praise</option>
                            </select>

                            <label for="comment_subject">What about the library do you want to comment on?</label>
                            <select id="comment_subject" name="comment_subject" required>
                                <option value="">Select an option</option>
                                <option value="Book Collection">Book Collection</option>
                                <option value="Facilities">Facilities</option>
                                <option value="Staff">Staff</option>
                                <option value="Services">Services</option>
                                <option value="Other">Other</option>
                            </select>

                            <label for="comments">Enter your comments in the space provided below:</label>
                            <textarea id="comments" name="comments" required></textarea>

                            <button class="navigation-button" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
    </section>

    <script src="admin.js"></script>
</body>

</html>