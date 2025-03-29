<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>User Dashboard</title>
    <style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #3498db;
        --accent-color: #e74c3c;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', sans-serif;
    }
    body{background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
        url('./assents/securityimage.png') center/cover;}
    /* Navigation */
    .dashboard-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        border-radius:4px; background-color:rgba(1, 13, 20, 0.55);
        color: white;
        position: fixed;
        width: 100%;
        height:50px;
        top: 0;
        z-index: 1000;
    }
    .logo{margin-top:10px;}
    .nav-brand {
        font-size: 1.5rem;
        font-weight: bold;
        color: white;
        text-decoration: none;
    }

    .nav-links {
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .nav-main-items {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .nav-link {
        color: white;
        text-decoration: none;
        transition: opacity 0.3s;
    }

    .nav-link:hover {
        opacity: 0.8;
    }

    /* User Profile */
    .user-profile {
        position: relative;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .profile-arrow {
        transition: transform 0.3s;
        font-size: 0.8rem;
    }

    .user-profile.active .profile-arrow {
        transform: rotate(180deg);
    }

    .profile-dropdown {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        color:white;
        background: linear-gradient(135deg,rgba(10, 10, 10, 0.66) 0%,rgba(1, 13, 20, 0.22) 100%);        min-width: 200px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border-radius: 6px;
        padding: 1rem;
        z-index: 1000;
    }
    .profile-dropdown a{
        text-decoration:none;
        color:white;
        font-size:1rem;
    }
    .profile-dropdown a:hover{font-size:1.1rem;color:yellow;}
    .profile-dropdown.active {
        display: block;
        animation: slideDown 0.3s ease;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }

    .user-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .dropdown-logout {
        display: block;
        padding: 0.5rem;
        color: var(--primary-color);
        text-decoration: none;
        transition: background 0.3s;
    }

    .dropdown-logout:hover {
        font-size:1.2rem;color:yellow;
    }

    /* Main Content */
    .dashboard-main {
        padding: 2rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        
    }
/* 
    .welcome-card {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .welcome-title {
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    } */

    /* Report Form */
    .report-form {
        border: 1px solid #ddd; border-radius: 5px;background: linear-gradient(135deg,rgba(10, 10, 10, 0.66) 0%,rgba(1, 13, 20, 0.22) 100%); 
        padding: 2rem;color:#fff;
        margin-top: 60px;
        
    }

    .form-row {
        display: grid;
        gap: 1.5rem;
        grid-template-columns: 1fr;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 0;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        color:  #fff;
        font-weight: 500;
    }

    input, textarea {
        width: 100%;
        color:yellow;
        padding: 0.8rem;
        border: 2px solidrgb(159, 253, 37);
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.3s;
        border-radius:4px; background-color:rgba(1, 13, 20, 0.22);
   
    }

    input:focus, textarea:focus {
        outline: none;
        border-color: yellow;
    }

    .gps-status {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    button {
        background:  #e74c3c;
        color: white;
        padding: 1rem 2rem;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s;
        width: 100%;
    }

    button:hover {
        background:rgb(247, 190, 3);
        color:black;
    }

    .alert {
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
    }

    /* Animations */
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive Design */
    @media (min-width: 768px) {
        .form-row {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .form-row-full {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 768px) {
        .dashboard-nav {
            padding: 1rem;
        }
        
        .nav-main-items {
            gap: 1rem;
        }
        
        .user-profile span {
            display: none;
        }
        
        .dashboard-main {
            padding: 1rem;
        }
    }
</style>
</head>
<body>
<?php 
// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header("Location: ../login.php");
//     exit();
// }
include ('db_connection.php');

// Get user details
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT first_name, last_name, id_image FROM hiring_requests WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($firstName, $lastName, $userImage);
$stmt->fetch();
$stmt->close();
$fullName = trim($firstName . " " . $lastName);

?>
    <!-- Navigation -->
    <nav class="dashboard-nav">
   <img src="./assents/OSGS.png" alt="logo"width="90px"height="auto" class="logo">
    
    <div class="nav-links">
        <div class="nav-main-items">
            <a href="index.php" class="nav-link">Home</a>
            <a href="dashboard.php" class="nav-link">Dashboard</a>

            <div class="user-profile" onclick="toggleProfile()">
                <span>My Profile</span>
                <i class="fas fa-chevron-down profile-arrow"></i>
                <div class="profile-dropdown" id="profileDropdown">
                   <a href="update_profile.php">
                     <div class="profile-header">
                        <img src="./admin/<?= htmlspecialchars($userImage) ?>" 
                             alt="Profile" 
                             class="user-image">
                        <div>
                            <div class="dropdown-fullname"><?= htmlspecialchars($fullName) ?></div>
                        </div>
                            </a>
                    </div>
                    <a href="logout.php" class="dropdown-logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>
