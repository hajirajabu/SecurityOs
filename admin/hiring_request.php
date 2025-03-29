<?php include 'header.php'; ?>
<?php include '../db_connection.php'; ?>

<style>
 
    .page-title {
        color: #2c3e50;
        margin-bottom: 30px;
        font-size: 2em;
        display: flex;
        align-items: center;
        gap: 10px;
        
    }

    .table-container {
        width: 100%;
        /* overflow-x: scroll; */
        -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
    }

    table {
        width: 100%;
        min-width: 1500px; /* Minimum width for the table */
    }
    /* Table Styles */
    .request-table {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px;
        text-align: left;
    }

    th {
        background:#3498db;
        color: white;
        font-weight: 500;
    }

    tr:nth-child(even) {
        background: #f8f9fa;
    }

    tr:hover {
        background: #ecf0f1;
    }

    /* Status Badges */
    .status {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9em;
        font-weight: 500;
        text-transform: capitalize;
    }

    .status.pending {
        background: #fff3e0;
        color: #f39c12;
    }

    .status.approved {
        background: #e8f5e9;
        color: #2ecc71;
    }

    .status.rejected {
        background: #ffebee;
        color: #e74c3c;
    }

    /* Action Buttons */
    .btn {
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9em;
        text-decoration: none;
        transition: all 0.3s;
        margin-right: 5px;
    }

    .btn.approve {
        background: #2ecc71;
        color: white;
    }

    .btn.approve:hover {
        background: #27ae60;
    }

    .btn.reject {
        background: #e74c3c;
        color: white;
    }

    .btn.reject:hover {
        background: #c0392b;
    }

    @media (max-width: 768px) {
        .admin-content {
            margin:20px 0;
            padding: 20px;
            width: 100%;
        }

        table {
            min-width: 100%;
            display: block;
            overflow: scroll;
        }
        .table-container {
            overflow-x: visible;
        }
    }
 /* Desktop Adjustments */
 @media (min-width: 1024px) {
        .request-table, .page-title{
            margin-left:6%;
        }
        
    }

  
</style>
<!-- <div class="admin-content"> -->
    <h2 class="page-title">📌 Hiring Requests</h2>
    
    <div class="request-table">
        <div class="table-container">  <!-- New container for scrollable table -->
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Requested Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id, CONCAT(first_name, ' ', last_name) AS fullname, phone, email, requested_date, status FROM hiring_requests ORDER BY requested_date DESC";
                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        die("Database Query Failed: " . mysqli_error($conn));
                    }

                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status_class = ($row['status'] == 'pending') ? 'pending' : 
                                        (($row['status'] == 'approved') ? 'approved' : 'rejected');
                        
                        echo "<tr>
                                <td>{$count}</td>
                                <td>{$row['fullname']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['requested_date']}</td>
                                <td><span class='status {$status_class}'>{$row['status']}</span></td>
                                <td>
                                    <a href='approve_request.php?id={$row['id']}' class='btn approve'>Approve</a>
                                    <a href='reject_request.php?id={$row['id']}' class='btn reject'>Reject</a>
                                </td>
                              </tr>";
                        $count++;
                    }
                    ?>
                </tbody>
            </table>
        </div>  <!-- End of table container -->
    </div>
<!-- </div> -->

<?php include 'footer.php'; ?>