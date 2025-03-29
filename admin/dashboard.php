<?php include 'header.php'; ?>
<?php include '../db_connection.php'; ?>
<style>
    /* General Styles */


.dashboard-title {
    text-align: center;
    font-size: 26px;
    width: 75vw;
    color: #333;
    margin: 20px 0;
}

.dashboard {
    width: 100%;
    margin: auto;
}

/* Stats Container */
.stats-container {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 20px;
}

.stat-card {
    flex: 1;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    font-size: 18px;
    font-weight: bold;
}

.stat-card.total {
    border-left: 5px solid #007bff;
}

.stat-card.approved {
    border-left: 5px solid #28a745;
}

.stat-card.pending {
    border-left: 5px solid #ff9800;
}

/* Table Styles */
.section-title {
    font-size: 22px;
    color: #444;
    margin-bottom: 10px;
}

.request-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

.request-table th, 
.request-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.request-table th {
    background:  #3498db;
    color: white;
}

.request-table tr:hover {
    background: #f1f1f1;
}

.status {
    padding: 6px 12px;
    border-radius: 5px;
    font-weight: bold;
}

.status.Approved {
    background: #28a745;
    color: white;
}

.status.Pending {
    background: #ff9800;
    color: white;
}

/* Quick Actions */
.quick-actions {
    display: flex;
    gap: 15px;
    width:100;
    justify-content:space-between;
    margin: 20px auto;
}

.btn {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    padding: 12px 20px;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
}

.btn:hover {
    background: #0056b3;
}

</style>

<h2 class="dashboard-title">Admin Dashboard</h2>

<div class="dashboard">
     <!-- Quick Actions -->
      <p style="color:grey;font-family:times-new-roman">Quick Access |</p>
     <div class="quick-actions">
        <a href="daily_report.php" class="btn">Daily Report</a>
        <a href="add_security_guide.php" class="btn">Add Security Guide</a>
        <a href="booking_requests.php" class="btn">View All Requests</a>
        <a href="manage_users.php" class="btn">Manage Users</a>
        <a href="reports.php" class="btn">Generate Reports</a>
    </div>
    <!-- Cards for Statistics -->
    <div class="stats-container">
        <div class="stat-card total">
            <h3>Total Requests 📈</h3>
            <p>
                <?php
                $query = mysqli_query($conn, "SELECT COUNT(*) FROM hiring_requests");
                $total_requests = mysqli_fetch_array($query)[0];
                echo $total_requests;
                ?>
            </p>
        </div>

        <div class="stat-card approved">
            <h3>Approved Requests ✅</h3>
            <p>
                <?php
                $query = mysqli_query($conn, "SELECT COUNT(*) FROM hiring_requests WHERE status='Approved'");
                $approved_requests = mysqli_fetch_array($query)[0];
                echo $approved_requests;
                ?>
            </p>
        </div>

        <div class="stat-card pending">
            <h3>Pending Requests 💱</h3>
            <p>
                <?php
                $query = mysqli_query($conn, "SELECT COUNT(*) FROM hiring_requests WHERE status='Pending'");
                $pending_requests = mysqli_fetch_array($query)[0];
                echo $pending_requests;
                ?>
            </p>
        </div>
    </div>

    <!-- Recent Requests Table -->
    <h3 class="section-title">Recent Requests</h3>
    <table class="request-table">
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Requested Date</th>
        </tr>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM hiring_requests where status = 'pending' ORDER BY requested_date DESC LIMIT 5");
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>
                    <td>{$row['first_name']} {$row['last_name']}</td>
                    <td>{$row['phone']}</td>
                    <td><span class='status {$row['status']}'>{$row['status']}</span></td>
                    <td>{$row['requested_date']}</td>
                  </tr>";
        }
        ?>
    </table>

   
</div>

<?php include 'footer.php'; ?>
