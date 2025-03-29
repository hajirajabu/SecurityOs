<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();    
}
include ('db_connection.php');
include ('userheader.php');
// Get user details
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT first_name, last_name, id_image FROM hiring_requests WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($firstName, $lastName, $userImage);
$stmt->fetch();
$stmt->close();
$fullName = trim($firstName . " " . $lastName);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobLocation = trim($_POST['job_location']);
    $arrivalTime = trim($_POST['arrival_time']);
    $leavingTime = !empty($_POST['leaving_time']) ? trim($_POST['leaving_time']) : NULL;
    $exactArea = !empty($_POST['exact_area']) ? trim($_POST['exact_area']) : NULL;
    $remark = !empty($_POST['remark']) ? trim($_POST['remark']) : NULL;
    $gpsCoordinates = !empty($_POST['gps_coordinates']) ? trim($_POST['gps_coordinates']) : NULL;
    $reportDate = date("Y-m-d");

    // Validate GPS coordinates
    if (empty($gpsCoordinates) || !preg_match('/^-?\d{1,2}\.\d{6,},\s?-?\d{1,3}\.\d{6,}$/', $gpsCoordinates)) {
        $error = "Invalid GPS Coordinates. Please enable location services.";
    } else {
        // Insert report
        $stmt = $conn->prepare("INSERT INTO daily_report (user_id, report_date, job_location, arrival_time, leaving_time, exact_area, remark, gps_coordinates) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $userId, $reportDate, $jobLocation, $arrivalTime, $leavingTime, $exactArea, $remark, $gpsCoordinates);

        if ($stmt->execute()) {
            header("Location: dashboard.php?success=1");
            exit();
        } else {
            $error = "Error submitting report: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>
<style>
   body{background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
    url('./assents/securityimage.png') center/cover;}
</style>
<section class = "hero">
    <!-- Main Content -->
    <main class="dashboard-main">
       

        <!-- Report Form -->
        <form method="POST" action="#" class="report-form" onsubmit="return validateGPS()">
       <center> <h2>Fill today's work descriptions</h2></center>   
        <?php if(isset($_GET['success'])): ?>
                <div class="alert alert-success">Report submitted successfully!</div>
            <?php elseif(isset($error)): ?>
                <div class="alert alert-error"><?= $error ?></div>
            <?php endif; ?>

            <div class="form-row">
                <div class="form-group form-row-full">
                    <label for="job_location">Job Location</label>
                    <input type="text" name="job_location" placeholder="Enter job location" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="arrival_time">Arrival Time</label>
                    <input type="time" name="arrival_time" required>
                </div>
                
                <div class="form-group">
                    <label for="leaving_time">Leaving Time</label>
                    <input type="time" name="leaving_time">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group ">
                    <label for="exact_area">Exact Area</label>
                    <input type="text" name="exact_area" placeholder="Enter exact area">
                </div>
            
            <div class="form-row">
                <div class="form-group form-row-full">
                    <label for="gps_coordinates">GPS Coordinates</label>
                    <input type="text" id="gps_coordinates" name="gps_coordinates" readonly required>
                    <div class="gps-status" id="gps_status">
                        <i class="fas fa-map-marker-alt gps-icon"></i>
                        <span>Fetching location...</span>
                    </div>
                   </div>
                 </div>
            </div>
            <div class="form-row">
                <div class="form-group form-row-full">
                    <label for="remark">Remarks</label>
                    <textarea name="remark" rows="3" placeholder="Enter any remarks"></textarea>
                </div>
            </div>

           

            <button type="submit">Submit Daily Report</button>
        </form>
    </main>
            </section>
    <script>
   function toggleProfile() {
        const dropdown = document.getElementById('profileDropdown');
        const profile = document.querySelector('.user-profile');
        dropdown.classList.toggle('active');
        profile.classList.toggle('active');
    }

    document.addEventListener('click', (e) => {
        const dropdown = document.getElementById('profileDropdown');
        const profile = document.querySelector('.user-profile');
        const navItems = document.querySelector('.nav-main-items');

        if (!navItems.contains(e.target)) {
            dropdown.classList.remove('active');
            profile.classList.remove('active');
        }
    });

    // Geolocation handling
    function getLocation() {
        const gpsStatus = document.getElementById('gps_status');
        const gpsIcon = gpsStatus.querySelector('.gps-icon');
        
        if (navigator.geolocation) {
            gpsStatus.innerHTML = '<i class="fas fa-spinner fa-spin gps-icon"></i> <span>Locating...</span>';
            
            navigator.geolocation.getCurrentPosition(
                position => {
                    const lat = position.coords.latitude.toFixed(6);
                    const lon = position.coords.longitude.toFixed(6);
                    document.getElementById('gps_coordinates').value = `${lat}, ${lon}`;
                    gpsStatus.innerHTML = '<i class="fas fa-check-circle gps-icon" style="color: #2ecc71;"></i> <span>Location acquired!</span>';
                },
                error => {
                    gpsStatus.innerHTML = '<i class="fas fa-times-circle gps-icon" style="color: #e74c3c;"></i> <span>Please Enable location service!</span>';
                    document.getElementById('gps_coordinates').value = '';
                },
                { timeout: 10000 }
            );
        } else {
            gpsStatus.innerHTML = '<i class="fas fa-times-circle gps-icon" style="color: #e74c3c;"></i> <span>Geolocation not supported</span>';
        }
    }

    function validateGPS() {
        const gpsField = document.getElementById('gps_coordinates').value;
        if (!gpsField) {
            alert('Please enable location services to submit the report.');
            return false;
        }
        return true;
    }

    // Initial location fetch
    getLocation();
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>