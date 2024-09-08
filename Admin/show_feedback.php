<?php
// Include the connection file for database connectivity
include("connection.php");

// Validate and sanitize the input parameter
$feedbackId = isset($_GET['id']) ? intval($_GET['id']) : 0;  //?ternary operaTOR instead of if/else
// if (isset($_GET['id'])) {
//     $feedbackId = intval($_GET['id']);
// } else {
//     $feedbackId = 0;
// }
// Check if feedback ID is valid
if ($feedbackId > 0) {
    // Update the feedback status to 'show' in the database
    $query = "UPDATE tbl_feedback SET status='show' WHERE id=$feedbackId";
    mysqli_query($conn, $query);

    // Redirect back to the feedback.php page
    echo "<script>window.location.href='feedback.php'</script>";
} else {
    // Handle invalid or missing feedback ID
    echo "Invalid or missing feedback ID.";
}
?>
<?php
$a="mahnoor";
$b = "";
if($b){
echo "this is a integer";
}
else{
    echo "this is not a integer";
}

?>