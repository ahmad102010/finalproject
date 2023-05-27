<?php
include "partials/constants.php";
$id = $_GET['id'];
// Prepare the SQL statement
$sql = "DELETE FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

// Bind parameters to the statement
mysqli_stmt_bind_param($stmt, "i", $id);

// Execute the statement
$del = mysqli_stmt_execute($stmt);

// Check if the deletion was successful
if ($del) {
    echo "Deletion successful";
} else {
    echo "Deletion failed";
}

// Close the statement and the connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

if($del)
{
    $_SESSION['users'] = "<span style='color: #2ed573'>admin is deleted</span>";
    header("location:manage-admin.php");
    exit;
}
else
{
    $_SESSION['users'] = "<span style='color: #2ed573'>admin is not deleted</span>";
    header("location:manage-admin.php");
}
