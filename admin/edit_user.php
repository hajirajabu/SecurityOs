<?php
include 'header.php';
include '../db_connection.php';

// Fetch user details
if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$user_id = intval($_GET['id']);
$sql = "SELECT * FROM hiring_requests WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}

// Handle form submission
if (isset($_POST['update_user'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $update_query = "UPDATE hiring_requests SET 
        first_name = '$first_name', 
        last_name = '$last_name', 
        email = '$email', 
        phone = '$phone', 
        role = '$role' 
        WHERE id = $user_id";

    if (mysqli_query($conn, $update_query)) {
        header("Location: manage_users.php?msg=User Updated Successfully");
        exit();
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}
?>
<style>
.page-title {
            color: #007bff;
            font-size: 24px;
            margin-bottom: 10px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: bold;
            margin: 10px 0 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 15px;
            box-sizing: border-box;
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

        .btn.update {
            background-color: #28a745;
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
    <h2 class="page-title">✏️ Edit User</h2>

    <form method="post">
        <label>First Name:</label>
        <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required>

        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>

        <label>Role:</label>
        <select name="role" required>
            <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="personnel" <?php echo ($user['role'] == 'personnel') ? 'selected' : ''; ?>>Personnel</option>
        </select>

        <button type="submit" name="update_user" class="btn update">Update</button>
        <a href="manage_users.php" class="btn cancel">Cancel</a>
    </form>
</div>


<?php include 'footer.php'; ?>
