<?php
include "email.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">

    <title>Forgot Password - Manila-Sacramento Friendship Library </title>
</head>

<body>

    <section class="main">
        <div class="side">
        </div>

        <div class="login-container">
            <div class="logo">
                <img src="images/logo.2.png" alt="logo">
                <a href="login.php">Go Back</a>
            </div>
            <div class="form">
                <p class="title"> Forgot Password </p>
                <div class="separator"></div>
                <p class="welcome-message">Please provide the right information for account retrieval or contact us.</p>

                <form class="login-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="form-control">
                        <input type="email" name="email" placeholder="Email" required="">
                    </div>

                    <button class="submit" type="submit" name="submit" value="Login">Submit</button>
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>

                </form>

            </div>
        </div>
    </section>
</body>

</html>