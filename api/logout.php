<?php
session_start();
session_destroy(); // destroy all session data
header("Location: ../index.html"); // redirect to login page
exit();
?>
