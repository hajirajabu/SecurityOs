<?php include 'header.php'; ?>
<?php include '../db_connection.php'; ?>

<style>
/* Main Content Styles */
/* .admin-content {
    padding: 30px;
    max-width: 1400px;
    margin: 0 auto;
} */

/* Guide Table Styles */
.guide-table {
    padding: 30px;
    max-width: 1400px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    overflow: hidden;
}

.table-header {
    padding: 25px;
    border-bottom: 1px solid #ecf0f1;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-header h2 {
    color: #2c3e50;
    margin: 0;
}
.table-container th{
    background: #3498db ;
    color:white;

}
.table-container th, td{
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
.table-container tr:hover{
    background: #f1f1f1;
}
.phone{color: #3498db ;margin-top:5px;}
/* Add Guide Modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    overflow:scroll;

}

.modal-content {
    background: white;
    width: 90%;
    max-width: 700px;
    margin: 50px auto;
    border-radius: 10px;
    padding: 30px;
    animation: slideDown 0.3s ease;
}

/* Form Styles */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #2c3e50;
    font-weight: 500;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}

.upload-container {
    border: 2px dashed #ddd;
    padding: 25px;
    text-align: center;
    border-radius: 8px;
    cursor: pointer;
}

.upload-container:hover {
    border-color: #3498db;
}

/* Buttons */
.btn-primary {
    background: #3498db;
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-primary:hover {
    background: #2980b9;
    transform: translateY(-2px);
}

@keyframes slideDown {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
</style>

<!-- <div class="admin-content"> -->
    <div class="guide-table">
        <div class="table-header">
            <h2>📋 Approved Security Personnel</h2>
            <div class="table-actions">
                <input type="text" placeholder="Search personnel..." class="search-input">
            </div>
        </div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Booking No</th>
                        <th>Full Name</th>
                        <th>Contacts</th>
                        <th>Registration Date</th>
                        <th>ID Type</th>
                        <th>Register</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM hiring_requests WHERE status='Approved'";
                    $result = mysqli_query($conn, $query);
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['BookingNumber']}</td>
                                <td>{$row['first_name']} {$row['last_name']}</td>
                                <td>
                                    <div>📩{$row['email']}</div>
                                    <div class='phone'>📞{$row['phone']}</div>
                                </td>
                                <td>".($row['registration_date'] ?? 'N/A')."</td>
                                <td>".($row['id_type'] ?? 'Not set')."</td>
                                <td>
                                    <button class='btn-primary' onclick='openModal({$row['id']})'>
                                        <i class='fas fa-plus'></i> Add Guide
                                    </button>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<!-- </div> -->

<!-- Add Guide Modal -->
<div class="modal" id="guideModal">
    <div class="modal-content">
        <form id="guideForm" enctype="multipart/form-data" method="POST" action="update_guide.php">
            <input type="hidden" name="user_id" id="userId">
            
            <h2 style="margin-bottom: 15px;">➕ Add Security Guide</h2>
            
            <div class="form-grid">
                <!-- Personal Info -->
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" required>
                </div>
                
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" required>
                </div>
                
                <!-- Contact Info -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label>Phone</label>
                    <input type="tel" name="phone" required>
                </div>
                <div class="form-group">
                    <label>role</label>
                    <select name="role" id=""required>
                    <option value="personnel">Personnel</option>
                    <option value="admin">Supervisor/admin</option>
                    </select>
                </div>
                
                <!-- New Fields -->
                <div class="form-group">
                    <label>Registration Date</label>
                    <input type="date" name="registration_date" required>
                </div>
                
                <div class="form-group">
                    <label>ID Type</label>
                    <select name="id_type" required>
                        <option value="National ID">National ID</option>
                        <option value="Passport">Passport</option>
                        <option value="Driving License">Driving License</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>ID Number</label>
                    <input type="text" name="id_number" required>
                </div>
                
                <!-- Image Upload -->
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Upload ID Image</label>
                    <div class="upload-container">
                        <input type="file" name="id_image" accept="image/*" required>
                        <p>Click to upload ID image (JPEG/PNG, max 2MB)</p>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 25px; text-align: right;">
                <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-primary">Save Guide</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(userId) {
    // Fetch user data via AJAX
    fetch(`get_user.php?id=${userId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('userId').value = userId;
            document.querySelector('[name="first_name"]').value = data.first_name;
            document.querySelector('[name="last_name"]').value = data.last_name;
            document.querySelector('[name="email"]').value = data.email;
            document.querySelector('[name="phone"]').value = data.phone;
            document.querySelector('[name="role"]').value = data.role;
            document.getElementById('guideModal').style.display = 'block';
        });
}

function closeModal() {
    document.getElementById('guideModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        closeModal();
    }
}
</script>

<?php include 'footer.php'; ?>