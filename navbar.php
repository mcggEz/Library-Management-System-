<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">
    <title>Library User-Manila-Sacramento Friendship Library</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Hover effect
            $('.topbar .links a').hover(
                function () {
                    $(this).addClass('hover');
                },
                function () {
                    $(this).removeClass('hover');
                }
            );

            // Active effect
            var currentPage = '<?php echo basename($_SERVER["PHP_SELF"]); ?>';
            $('.topbar .links a').each(function () {
                var linkHref = $(this).attr('href');
                if (linkHref === currentPage) {
                    $(this).addClass('active');
                }
            });
        });
    </script>

</head>

<body>

    <div class="topbar">
        <input id="nav-toggle" type="checkbox">
        <div class="logo">
            <img src="images/logo.png" alt="logo">
        </div>
        <ul class="links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="sections.php">Resources</a></li>
            <li><a href="guidelines.php">Guidelines</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="announcements.php">Announcements</a></li>
            <?php
            if (isset($_SESSION['control_number'])) {
                $control_number = $_SESSION['control_number'];

                // Retrieve the user's information from the database
                $selectStmt = $db->prepare("SELECT * FROM `user` WHERE `control_number`=?");
                $selectStmt->bind_param("s", $control_number);
                $selectStmt->execute();
                $user = $selectStmt->get_result()->fetch_assoc();
            }

            if (isset($_SESSION["control_number"])) {
                echo '<li><a href="user_dashboard.php">Profile</a></li>';
                ?>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    var idleTime = 0;
                    var sessionTimeout = 300000; //5 min

                    function resetTimer() {
                        idleTime = 0;
                    }

                    function incrementTimer() {
                        idleTime += 1000;
                        if (idleTime >= sessionTimeout) {
                            alert("You have been logged out due to inactivity.");

                            window.location.href = 'logout.php';
                        }
                    }

                    $(document).ready(function () {
                        // Increment the timer every second
                        var idleInterval = setInterval(incrementTimer, 1000);

                        // Reset the timer when the user interacts with the page
                        $(this).mousemove(resetTimer);
                        $(this).keypress(resetTimer);
                        $(this).click(resetTimer);


                    });
                </script>

                <?php
            } else {
                echo '<li><a href="login.php">Login</a></li>';
            }
            ?>
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </div>

</body>

</html>