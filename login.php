<?php 
session_start();
include 'head.php';
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $inputPassword = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, role, password, token_display, first_login FROM hiring_requests WHERE email = ?");
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $userId = $row['id'];
        $storedHashedPassword = $row['password'];
        $tokenDisplay = trim($row['token_display']);
        $firstLogin = $row['first_login'];
        $role = $row['role'];

        if ($firstLogin == 1) {
            // First login with token
            if ($inputPassword === $tokenDisplay) {
                $_SESSION['user_id'] = $userId;
                $_SESSION['role'] = $role;
                header("Location: change_password.php");
                exit();
            } else {
                $error = "Invalid login credentials.";
            }
        } else {
            // Subsequent logins with password
            if (password_verify($inputPassword, $storedHashedPassword)) {
                $_SESSION['user_id'] = $userId;
                $_SESSION['role'] = $role;
                
                // Role-based redirection
                if ($role === 'admin') {
                    header("Location: ./admin/dashboard.php");
                } else {
                    header("Location:dashboard.php");
                }
                exit();
            } else {
                $error = "Invalid login credentials.";
            }
        }
    } else {
        $error = "No account found with that credetials.";
    }
}
?>


    <style>
        .error { color: red; margin-bottom: 15px; }
        form { width: 400px;height:auto; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;background: linear-gradient(135deg,rgba(10, 10, 10, 0.66) 0%,rgba(1, 13, 20, 0.22) 100%); }
        input { display: block; width: 100%; margin: 10px 0; padding: 8px;border-radius:4px; background-color:rgba(1, 13, 20, 0.22); }
        button { background:rgba(14, 23, 32, 0.57); color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        .hero {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
    url('./assents/securityimage.png') center/cover;
   
    /* https://images.unsplash.com/photo-1582738411706-bfc8e691d1c2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80 */
    height: 100%;
    width: 100%;
      display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
}
    </style>
<section class="hero">
        
    <form method="POST" action="">
        <h2>Sign in</h2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Token/Password" required>
        <button type="submit"><i class="bi bi-box-arrow-right"></i></button>
        <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    </form>
    </div>
<?php include 'foot.php' ?>