<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['user_id'];

    // Check if database connection is established
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Handle file upload
    $targetDir = "uploads/ids/";
    $fileName = basename($_FILES["id_image"]["name"]);
    $targetFile = $targetDir . uniqid() . "_" . $fileName;

    if (move_uploaded_file($_FILES["id_image"]["tmp_name"], $targetFile)) {
        // Generate token
        $token = bin2hex(random_bytes(6)); // Generate a 12-character token
        $hashedToken = password_hash($token, PASSWORD_DEFAULT); // Hash token for security

        // Prepare the SQL statement
        $stmt = $conn->prepare("UPDATE hiring_requests SET 
                              first_name = ?, 
                              last_name = ?,
                              email = ?,
                              phone = ?,
                              role = ?,
                              registration_date = ?,
                              id_type = ?,
                              id_number = ?,
                              id_image = ?,
                              `password` = ?, 
                              token_display = ? 
                              WHERE id = ?");

        // Check if statement preparation was successful
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssssssssssi",
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['role'],
            $_POST['registration_date'],
            $_POST['id_type'],
            $_POST['id_number'],
            $targetFile,
            $hashedToken, // Store hashed token in password column
            $token, // Store plain token for user retrieval
            $userId
        );

        if ($stmt->execute()) {
            // Success message with loading animation
            echo '
            <div class="success-overlay">
                <div class="loading-spinner"></div>
                <div class="success-message">Done! Redirecting...</div>
            </div>
            <style>
                .success-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(255, 255, 255, 0.9);
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    z-index: 9999;
                }
                
                .loading-spinner {
                    border: 4px solid #f3f3f3;
                    border-radius: 50%;
                    border-top: 4px solid #3498db;
                    width: 40px;
                    height: 40px;
                    animation: spin 1s linear infinite;
                    margin-bottom: 15px;
                }
                
                .success-message {
                    font-size: 1.2em;
                    color: #2c3e50;
                }
                
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            </style>
            <script>
                setTimeout(function() {
                    window.location.href = "dashboard.php?success=Guide+updated+successfully";
                }, 2000);
            </script>';
            exit();
        } else {
            die("Error updating record: " . $stmt->error);
        }
    } else {
        die("File upload failed");
    }
}
?>
