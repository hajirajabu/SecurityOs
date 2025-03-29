<?php 
session_start();
include '../db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch user details (email and profile image)
$stmt = $conn->prepare("SELECT email, id_image FROM hiring_requests WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$profileImage = !empty($user['id_image']) ? $user['id_image'] : "default-avatar.jpg";

// Count pending requests
$pendingStmt = $conn->prepare("SELECT COUNT(*) as pending_count FROM hiring_requests WHERE status = 'pending'");
$pendingStmt->execute();
$pendingResult = $pendingStmt->get_result();
$pendingRequests = $pendingResult->fetch_assoc()['pending_count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ensure styles.css exists -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    
</head>
<body>

<!-- Top Navigation Bar -->
<header class="admin-header">
    <button class="menu-toggle" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
    <span class="logo">OSGS</span>
    
    <div class="header-right">
        <div class="notification-icon">
            <i class="bi bi-chat-dots"></i>
            <span class="badge"><?php echo $pendingRequests; ?></span>
        </div>
        
        <div class="user-profile">
            <img src="<?php echo $profileImage; ?>" alt="User" class="user-image">
            <span class="user-email"><?php echo htmlspecialchars($user['email']); ?></span>
        </div>
        
        <div class="mobile-menu-trigger" onclick="toggleMobileMenu()">
            <i class="bi bi-three-dots-vertical"></i>
        </div>
    </div>
</header>

<!-- Sidebar Navigation -->
<nav class="admin-sidebar">
<ul>
        <li><a href="dashboard.php"><i class="bi bi-bar-chart"></i> Dashboard</a></li>
        <li><a href="daily_report.php"><i class="bi bi-file-earmark-text"></i>  Personnel's Daily Report</a></li>
        <li><a href="hiring_request.php"><i class="bi bi-clipboard-check"></i> Manage Requests</a></li>
        <li><a href="add_security_guide.php"><i class="bi bi-plus-circle"></i> Add Security Guide</a></li>
        <li>
            <a href="#"><i class="bi bi-people"></i> Users <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="view_guides.php"><i class="bi bi-book"></i> View All Guides</a></li>
                <li><a href="view_admins.php"><i class="bi bi-people"></i> View Admins</a></li>
                <li><a href="manage_users.php"><i class="bi bi-person-gear"></i> Manage Users</a></li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="bi bi-gear"></i> Settings <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#" onclick="toggleDarkMode()"><i class="bi bi-moon"></i> Dark Mode</a></li>
                <li><a href="#" onclick="toggleLightMode()"><i class="bi bi-sun"></i> Default</a></li>
            </ul>
        </li>
        <li><a href="reports.php"><i class="bi bi-file-earmark-text"></i> Reports</a></li>
        <li><a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
    </ul>
</nav>

<!-- Page Content -->
<div class="admin-content">
<script>
function toggleSidebar() {
    var sidebar = document.querySelector('.admin-sidebar');
    if (sidebar.style.width === "250px") {
        sidebar.style.width = "0";
    } else {
        sidebar.style.width = "250px";
    }
}
// sidebar 
        function toggleSidebar() {
            var sidebar = document.querySelector('.admin-sidebar');
            sidebar.style.width = sidebar.style.width === "250px" ? "0" : "250px";
        }

        function toggleMobileMenu() {
            document.querySelector('.header-right').classList.toggle('show');
        }

        function toggleDarkMode() {
            document.body.style.backgroundColor = "#121212";
            document.body.style.color = "#ffffff";
        }

        function toggleLightMode() {
            document.body.style.backgroundColor = "#ffffff";
            document.body.style.color = "#000000";
        }
    
</script>
