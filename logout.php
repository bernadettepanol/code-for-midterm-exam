<?php
session_start();
session_destroy(); // Destroy session to log out the user
header('Location: s/login.php'); // Redirect back to the login page
exit();
?>
