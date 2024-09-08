<?php
// Include the connection file for database connectivity
include("connection.php");

// Validate and sanitize the input parameter
$feedbackId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if feedback ID is valid
if ($feedbackId > 0) {
    // Sanitize the input for the SQL query using mysqli_real_escape_string
    $feedbackId = mysqli_real_escape_string($conn, $feedbackId);

    // Update the feedback status to 'hide' in the database
    $query = "UPDATE tbl_feedback SET status='hide' WHERE id=$feedbackId";
    
    // Execute the query
    mysqli_query($conn, $query);

    // Redirect back to the feedback.php page
    echo "<script>window.location.href='feedback.php'</script>";
} else {
    // Handle invalid or missing feedback ID
    echo "Invalid or missing feedback ID.";
}
?>
