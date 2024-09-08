<?php
// Start the session
session_start();

// Destroy the session data
session_destroy();

// Redirect to the index.php page
header("location:index.php");
?>
