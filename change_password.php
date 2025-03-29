<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = trim($_POST['new_password']);
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT); // Hash password
    $userId = $_SESSION['user_id'];

    // Ensure SQL statement is correct
    $stmt = $conn->prepare("UPDATE hiring_requests SET password = ?, first_login = 0 WHERE id = ?");
    
    if ($stmt === false) {
        die("SQL Error: " . $conn->error); // Debugging help
    }

    $stmt->bind_param("si", $hashedPassword, $userId);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<p style='color: red;'>Error updating password.</p>";
    }
}
?>

<form method="POST" action="">
    <input type="password" name="new_password" placeholder="Enter New Password" required>
    <button type="submit">Change Password</button>
</form>
