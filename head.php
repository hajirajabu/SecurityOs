<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecurityOS</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ensure styles.css exists -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    
</head>

<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}
    /* Header */
.admin-header {
    background: linear-gradient(135deg,rgba(7, 7, 7, 0.29) 0%,rgba(0, 0, 0, 0.94) 100%);

     color: rgb(233, 244, 248);
    /* box-shadow: 0 6px 20px rgba(0,0,0,0.06); Softer shadow */
    display: flex;
    align-items: center;
    padding: 15px;
    position: fixed;
    width: 100%;
    height: auto;
    top: 0;
    left: 0;
    z-index: 1000;
}

.logo {max-height:40px;
    /* font-size: 20px; */
    font-weight: bold;
    margin-left: 10px;
    margin-top:-10px;
}
nav{
    display: flex;
    align-items: center;
    /* gap: 25px; */
    margin-left: auto;
}
nav ul {
    display: flex;
    gap: 50px;
    list-style: none;
    margin-right:30px;
}

nav a {
    text-decoration: none;
    color: #ffffff;
    font-weight: 500;
    transition: color 0.3s;
    text-transform: uppercase;
    font-size: 0.9em;
}

nav a:hover {
    color: #d6e73c;
}
/* Content Area */
.user-content {
    height:100vh;
    width:100vw;
    transition: 0.3s;
     /* display:flex; */
    align-items:center;
    text-align:center;
}
</style>
<body>

<!-- Top Navigation Bar -->
<header class="admin-header">
        <button class="menu-toggle" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
        <span class="logo"><img src="./assents/osgs.png" alt="logo"></span>
        
       <nav>
                    <ul>
            <li><a href="index.php">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="hiring-request.php">Hiring Request</a></li>
                <!-- <li><a href="#contact">Contact</a></li> -->
                <li><a href="request-status.php">Request Status</a></li>
                <li><a href="login.php">Login <i class="bi bi-box-arrow-right"></i></a></li>
            </ul>
</nav>
    </header>
    <div class="user-content">