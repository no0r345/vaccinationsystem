<?php
// Include the connection file for database connectivity
include("connection.php");

// Validate and sanitize the input parameter (hospital ID from the URL)
$hospitalId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if the hospital ID is valid
if ($hospitalId > 0) {
    // Sanitize the input for the SQL query using intval (since we're using prepared statement)
    $hospitalId = intval($hospitalId);

    // Use a prepared statement to update the hospital status
    $query = "UPDATE tbl_hospital SET status='deactivate' WHERE id=?";//? placeholder for parameters
    
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $hospitalId); //i stand for integer(data type)

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Redirect back to the hospital.php page after the update
    echo "<script>window.location.href='hospital.php'</script>";
} else {
    // Handle invalid or missing hospital ID
    // For example, you could redirect to an error page or show a user-friendly message
    echo "Invalid or missing hospital ID.";
}
?>
