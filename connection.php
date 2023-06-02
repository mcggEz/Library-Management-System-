<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'library');

$db = mysqli_connect("localhost", "root", "", "library");
/* server name, username, passwor, database name */

/* check connection */
if ($db === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

date_default_timezone_set('Asia/Manila');
?>