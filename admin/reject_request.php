<?php
include '../db_connection.php';

if (isset($_GET['id'])) {
    $request_id = $_GET['id'];

    $query = "UPDATE hiring_requests SET status='Rejected' WHERE id='$request_id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('failed');</script>";
        header("Location: hiring_request.php?success=Request rejected successfully!");
        exit();
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}
?>
