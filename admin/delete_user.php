<?php
include 'header.php';
include '../db_connection.php';

// Check if user ID is provided
if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$user_id = intval($_GET['id']); // Get the user ID securely

// Fetch user details
$sql = "SELECT CONCAT(first_name, ' ', last_name) AS fullname FROM hiring_requests WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}

// Handle delete confirmation
if (isset($_POST['confirm_delete'])) {
    $delete_query = "DELETE FROM hiring_requests WHERE id = $user_id";
    mysqli_query($conn, $delete_query);
    header("Location: manage_users.php?msg=User Deleted Successfully");
    exit();
}
?>
<style>
     .page-title {
            color: #dc3545;
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn.delete {
            background-color: #dc3545;
            color: white;
            margin-right: 10px;
        }

        .btn.cancel {
            background-color: #6c757d;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

</style>
<div class="admin-content">
    <h2 class="page-title">🗑️ Confirm Delete</h2>
    <p>Are you sure you want to delete <strong><?php echo $user['fullname']; ?></strong>?</p>
    
    <form method="post">
        <button type="submit" name="confirm_delete" class="btn delete">Yes, Delete</button>
        <a href="manage_users.php" class="btn cancel">Cancel</a>
    </form>
</div>

<?php include 'footer.php'; ?>
