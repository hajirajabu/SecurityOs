<?php
include 'header.php';
include '../db_connection.php';

$query = "SELECT dr.*, CONCAT(hr.first_name, ' ', hr.last_name) AS fullname 
          FROM daily_report dr 
          JOIN hiring_requests hr ON dr.user_id = hr.id 
          ORDER BY dr.report_date DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// coordinates verification
function validate_gps($coordinates) {
    if (empty($coordinates)) return false;
    
    $parts = explode(',', $coordinates);
    if (count($parts) !== 2) return false;
    
    $lat = trim($parts[0]);
    $lng = trim($parts[1]);
    
    return is_numeric($lat) && is_numeric($lng) &&
           $lat >= -90 && $lat <= 90 &&
           $lng >= -180 && $lng <= 180;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Reports Dashboard</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
        }

        .reports-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 30px;
            padding: 40px;
            max-width: 1500px;
            margin: 0 auto;
        }

        .report-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .report-card:hover {
            transform: translateY(-5px);
        }

        .report-header {
            padding: 20px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .report-body {
            padding: 20px;
        }

        .report-meta {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .meta-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        .meta-item strong {
            display: block;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .map-container {
            height: 250px;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
            position: relative;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }
        .map-error {
    background: #ffe6e6;
    color: #cc0000;
    padding: 15px;
    border-radius: 8px;
    margin: 10px 0;
    border-left: 4px solid   #cc0000;
}
        .remark-section {
            margin-top: 20px;
            padding: 15px;
            background: #fff9f9;
            border-left: 4px solid var(--secondary-color);
            border-radius: 4px;
            overflow:auto;
        }

        @media (max-width: 768px) {
            .reports-container {
                grid-template-columns: 1fr;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <h2 style="text-align: center; margin: 30px 0; color: var(--primary-color);"><i class="bi bi-file-earmark-text"></i>Daily Reports Dashboard</h2>
    
    <div class="reports-container">
        <?php while($row = mysqli_fetch_assoc($result)) { 
            $mapUrl = "https://maps.google.com/maps?q={$row['gps_coordinates']}&z=15&output=embed";
            ?>
            <div class="report-card">
                <div class="report-header">
                    <h3><?= htmlspecialchars($row['fullname']) ?></h3>
                    <p><?= date('F j, Y', strtotime($row['report_date'])) ?></p>
                </div>
                
                <div class="report-body">
                    <div class="report-meta">
                        <div class="meta-item">
                            <strong>Job Location</strong>
                            <?= htmlspecialchars($row['job_location']) ?>
                        </div>
                        <div class="meta-item">
                            <strong>Exact Area</strong>
                            <?= htmlspecialchars($row['exact_area']) ?>
                        </div>
                        <div class="meta-item">
                            <strong>Arrival Time</strong>
                            <?= htmlspecialchars($row['arrival_time']) ?>
                        </div>
                        <div class="meta-item">
                            <strong>Leaving Time</strong>
                            <?= htmlspecialchars($row['leaving_time']) ?>
                        </div>
                    </div>

                    <div class="map-container">
                        <?php 
                        if (!empty($row['gps_coordinates'])) {
                            if (validate_gps($row['gps_coordinates'])) {
                                $mapUrl = "https://maps.google.com/maps?q={$row['gps_coordinates']}&z=15&output=embed";
                                ?>
                                <iframe 
                                    src="<?= $mapUrl ?>"
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            <?php } else { ?>
                                <div class="map-error">
                                    Incorrect location parameters: <?= htmlspecialchars($row['gps_coordinates']) ?>
                                </div>
                            <?php }
                        } else { ?>
                            <div class="map-error">
                                No location data available
                            </div>
                        <?php } ?>
                    </div>

                    <?php if(!empty($row['remark'])): ?>
                        <div class="remark-section">
                            <strong>Remark:</strong>
                            <?= htmlspecialchars($row['remark']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>