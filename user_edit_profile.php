<?php
session_start();
include "connection.php";

// Redirect user if not logged in
if (!isset($_SESSION['control_number'])) {
    header("Location: index.php");
    exit();
}

include "navbar.php";

// Fetch the user's existing data from the database
$control_number = $_SESSION['control_number'];
$sql = "SELECT * FROM user WHERE control_number = ?";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "s", $control_number);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);

    // Assign the retrieved data to variables
    $name = $userData['name'];
    $sex = $userData['sex'];
    $age = $userData['age'];
    $birthdate = $userData['birthdate'];
    $school_organization = $userData['school_organization'];
    $contact_number = $userData['contact_number'];
    $email = $userData['email'];
    $address = $userData['address'];
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which button was clicked
    if (isset($_POST['edit'])) {
        // Get the updated profile information
        $name = $_POST['name'];
        $sex = $_POST['sex'];
        $age = $_POST['age'];
        $birthdate = $_POST['birthdate'];
        $school_organization = $_POST['school_organization'];
        $address = $_POST['address'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];

        // Validate the updated profile information
        $errors = array();

        if (empty($name)) {
            $errors[] = "Name is required.";
        }

        // If there are no validation errors, update the profile in the database
        if (empty($errors)) {
            $date_profile_update = date("Y-m-d H:i:s");

            // Prepare the update query
            $sql = "UPDATE user SET name = ?, sex = ?, age = ?, birthdate = ?, school_organization = ?, address = ?, contact_number = ?, email = ?, date_profile_update = ? WHERE control_number = ?";
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_bind_param($stmt, "ssisssisss", $name, $sex, $age, $birthdate, $school_organization, $address, $contact_number, $email, $date_profile_update, $control_number);

            // Execute the update query
            if (mysqli_stmt_execute($stmt)) {
                // Profile updated successfully
                $message = "Profile updated successfully.";
                $popup_message[] = $message;
                $message_str = implode('\n', $popup_message);
                echo '<script type="text/javascript">
                    window.onload = function(){
                        alert("' . $message_str . '");
                        window.location.href = "user_profile.php";
                    }
                </script>';
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        }
    } elseif (isset($_POST['cancel'])) {
        // User clicked on the cancel button
        header("Location: user_profile.php");
        exit();
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
</head>

<body>
    <nav class="sidebar">
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="user_dashboard.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="user_profile.php">
                        <i class="uil uil-setting"></i>
                        <span class="link-name">Profile</span>
                    </a></li>
                <li><a href="user_feedbacks.php">
                        <i class="uil uil-comment-dots"></i>
                        <span class="link-name">Feedbacks</span>
                    </a></li>
                <li><a href="user_settings.php">
                        <i class="uil uil-setting"></i>
                        <span class="link-name">Settings</span>
                    </a></li>
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
            <button class="back-button" onclick="window.location.href='user_profile.php'">
                <i class="fas fa-arrow-left"></i> Back
            </button>


        </div>
        <div class="dash-content">

            <div class="overview">
                <div class="title">
                    <i class="fas fa-user-edit"></i>
                    <span class="text">Edit Profile</span>
                </div>

                <div class="profile_information">
                    <!----------------------------------EDIT Profile FORM -->
                    <form class="signup_form" method="post" action="" id="signup-form">
                        <div class="form-control">
                            <label for="name">Your name:</label><br>
                            <input type="text" name="name" placeholder="Name"
                                value="<?php echo isset($_POST['name']) ? $_POST['name'] : $name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Your age:</label><br>
                            <input type="number" class="form-control" id="age" name="age" min="13" max="120"
                                placeholder="Enter Age"
                                value="<?php echo isset($_POST['age']) ? $_POST['age'] : $age; ?>" required>
                        </div>
                        <p>Sex assigned at birth:</p><br>
                        <div class="radio-container">
                            <div class="radio-wrapper">
                                <label class="radio-button">
                                    <input type="radio" name="sex" value="Male" <?php if (isset($_POST['sex']) && $_POST['sex'] === 'Male')
                                        echo 'checked';
                                    elseif ($sex === 'Male')
                                        echo 'checked'; ?> required>
                                    <span class="radio-checkmark"></span>
                                    <span class="radio-label">Male</span>
                                </label>
                            </div>
                            <div class="radio-wrapper">
                                <label class="radio-button">
                                    <input type="radio" name="sex" value="Female" <?php if (isset($_POST['sex']) && $_POST['sex'] === 'Female')
                                        echo 'checked';
                                    elseif ($sex === 'Female')
                                        echo 'checked'; ?> required>
                                    <span class="radio-checkmark"></span>
                                    <span class="radio-label">Female</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Birthdate:</label><br>
                            <input type="date" class="form-control" id="birthdate" name="birthdate"
                                max="<?php echo date('Y-m-d', strtotime('-13 years')); ?>" placeholder="Enter Birthdate"
                                value="<?php echo isset($_POST['birthdate']) ? $_POST['birthdate'] : $birthdate; ?>"
                                required>
                        </div>
                        <div class="form-control">
                            <label for="organization">Your organization:</label><br>
                            <input type="text" name="school_organization" placeholder="Occupation/School"
                                value="<?php echo isset($_POST['school_organization']) ? $_POST['school_organization'] : $school_organization; ?>">
                        </div>
                        <!-- address -->
                        <div class="form-group">
                            <label for="address">Your complete address:</label><br>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Enter your information."
                                value="<?php echo isset($_POST['address']) ? $_POST['address'] : $address; ?>">
                        </div>
                        <!-- /address -->
                        <div class="form-control">
                            <label for="contact">Your Contact Number:</label><br>
                            <div class="form-control">
                                <input type="tel" id="contact_number" name="contact_number"
                                    placeholder="Enter Contact Number"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11)"
                                    inputmode="numeric"
                                    value="<?php echo isset($_POST['contact_number']) ? $_POST['contact_number'] : $contact_number; ?>">
                            </div>
                        </div>
                        <div class="form-control">
                            <label for="email">Your email:</label><br>
                            <input type="email" name="email" placeholder="Email"
                                value="<?php echo isset($_POST['email']) ? $_POST['email'] : $email; ?>">
                        </div>
                        <div class="submit_button">
                            <button class="navigation-button" type="submit" name="edit"
                                id="edit-profile-form">Submit</button>
                            <button class="navigation-button" type="button" name="cancel"
                                onclick="location.href='user_profile.php'">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="address_behavior.js"></script>
    <script src="admin.js"></script>
</body>

</html>