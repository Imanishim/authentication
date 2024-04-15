<?php 

session_start();
session_destroy();
header("Location: ../sign_in.php");
exit(); // Terminate script execution after redirection

?>
