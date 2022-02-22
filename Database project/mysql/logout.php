<?php 

session_start(); // <- in order to log out we need to start a session
session_unset(); // <- we deleting sesion information 
session_destroy(); // <- closes the session
header("Location: ../mysql/carrent.page.php?logout=success"); // <- send you tou main page as log out
?>