
<style>
/* User Table Styling */
.user-table {
    width: 100%;
    margin-left:0px;
    background: #fff;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.user-table table {
    width: 100%;
    border-collapse: collapse;
}

.user-table th, .user-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.user-table th {
    background:  #3498db ;
    color: white;
}

.user-table tr:hover {
    background: #f1f1f1;
}

/* Buttons */
.btn {
    padding: 8px 12px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
}

.btn.edit {
    background: #28a745;
    color: white;
}

.btn.delete {
    background: #dc3545;
    color: white;
}
 /* Desktop Adjustments */
 @media (min-width: 1024px) {
        .user-table, .page-title{
            margin-left:13%;
        }
        
    }
</style>
<?php
include 'header.php'; 
include '../db_connection.php';  // Ensure correct DB connection

// Handle user deletion
if (isset($_GET['delete'])) {
    $user_id = intval($_GET['delete']);
    $delete_query = "DELETE FROM users WHERE id = $user_id";
    mysqli_query($conn, $delete_query);
    header("Location: manage_users.php");
    exit();
}

// Fetch users from the database
$sql = "SELECT id, CONCAT(first_name, ' ', last_name) AS fullname, email, phone, role FROM hiring_requests  ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!-- <div class="admin-content"> -->
    <h2 class="page-title">👥 Manage Users</h2>
    
    <div class="user-table">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$count}</td>
                                <td>{$row['fullname']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['role']}</td>
                                <td>
                                    <a href='edit_user.php?id={$row['id']}' class='btn edit'>Edit</a>
                                    <a href='delete_user.php?id={$row['id']}' class='btn delete'>Delete</a>

                                    </td>
                              </tr>";
                        $count++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<!-- </div> -->

<?php include 'footer.php'; ?>
