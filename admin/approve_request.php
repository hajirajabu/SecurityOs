<?php
include '../db_connection.php';

if (isset($_GET['id'])) {
    $request_id = $_GET['id'];

    $query = "UPDATE hiring_requests SET status='Approved' WHERE id='$request_id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('successful');</script>";
        header("Location: hiring_request.php?success=Request approved successfully!");
        exit();
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}
?>
