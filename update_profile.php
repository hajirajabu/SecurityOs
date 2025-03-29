<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include ('db_connection.php');
include ('userheader.php');
$userId = $_SESSION['user_id'];
$error = '';
$success = '';

// Fetch current user data
$stmt = $conn->prepare("SELECT address, shift, email, phone FROM hiring_requests WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = trim($_POST['address']);
    $shift = trim($_POST['shift']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Validation
    if (empty($address) || empty($shift) || empty($email)) {
        $error = "Required fields cannot be empty";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        // Update database
        $stmt = $conn->prepare("UPDATE hiring_requests SET address = ?, shift = ?, email = ?, phone = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $address, $shift, $email, $phone, $userId);
        
        if ($stmt->execute()) {
            $success = "Profile updated successfully!";
            // Refresh user data
            $userData = ['address' => $address, 'shift' => $shift, 
                       'email' => $email, 'phone' => $phone];
        } else {
            $error = "Error updating profile: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>
<style>
        /* Reuse dashboard styles */
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
        }
        body{ background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
            url('./assents/securityimage.png') center/cover;}
        .profile-container {
            max-width: 800px;
            margin: 80px auto 2rem;
            padding: 2rem;
            
        }

        .profile-card {
            background: linear-gradient(135deg,rgba(10, 10, 10, 0.66) 0%,rgba(1, 13, 20, 0.22) 100%);        min-width: 200px;
            padding: 2rem;
            color:white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(247, 244, 244, 0.25);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-title {
            color: white;
            margin-bottom: 1rem;
        }

        .profile-form {
            display: grid;
            gap: 1.5rem;
        }

        .form-row {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(2, 1fr);
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: white;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 1rem;
        }

        .form-actions {
            margin-top: 1.5rem;
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .btn-primary {
            background: : #e74c3c;
            color: white;
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .alert {
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .profile-container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>

    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <h1 class="profile-title">Update Your Profile</h1>
                <?php if($success): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php elseif($error): ?>
                    <div class="alert alert-error"><?= $error ?></div>
                <?php endif; ?>
            </div>

            <form class="profile-form" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="address">Current Address</label>
                        <input type="text" id="address" name="address" 
                               value="<?= htmlspecialchars($userData['address']) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="shift">Job shift</label>
                        <input type="text" id="shift" name="shift" 
                               value="<?= htmlspecialchars($userData['shift']) ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" 
                               value="<?= htmlspecialchars($userData['email']) ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" 
                               value="<?= htmlspecialchars($userData['phone']) ?>"
                               pattern="[0-9]{10,15}" 
                               title="Phone number (10-15 digits)">
                    </div>
                </div>

                <div class="form-actions">
                    <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>