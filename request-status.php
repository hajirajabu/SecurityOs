<?php
include 'head.php'; // Include header file
include 'db_connection.php'; // Include your database connection file

$result = null; // Initialize result variable

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['booknum'])) {
    $booknum = trim($_POST['booknum']);

    // Ensure token_display is included in the SELECT query
    $stmt = $conn->prepare("SELECT first_name, last_name, email, phone, requirement_number, shift, gender, address, requested_date, status, token_display FROM hiring_requests WHERE BookingNumber = ?");
    $stmt->bind_param("s", $booknum);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>
<style>
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
    /* body { font-family: Arial, sans-serif; text-align: center; } */
    .container { max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;background: linear-gradient(135deg,rgba(10, 10, 10, 0.66) 0%,rgba(1, 13, 20, 0.22) 100%); }
    input { display: block; width: 100%; margin: 10px 0; padding: 8px;border-radius:4px; background-color:rgba(1, 13, 20, 0.22); }
    table { width: 100%; border-collapse: collapse;border-radius:4px; margin-top: 20px; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    .status { padding: 5px 10px; border-radius: 5px; font-weight: bold; }
    .pending { background: orange; color: white; }
    .approved { background: green; color: white; }
    .rejected { background: red; color: white; }
   

</style>
<section class="hero">
<div class="container">
    <h2>Check Your Hiring Request</h2>
    <form method="POST" action="">
        <input type="text" name="booknum" placeholder="Enter Your Booking Number" required>
        <button type="submit" >Search</button>
    </form>

    <?php if (isset($result) && $result->num_rows > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Requested Date</th>
                    <th>Status</th>
                    <th>Token</th> <!-- Always Show Token -->
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['requested_date']) ?></td>
                        <td>
                            <span class="status <?= strtolower($row['status']) ?>">
                                <?= htmlspecialchars($row['status']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($row['token_display'] ?? 'N/A') ?></td> <!-- Display Token -->
                    </tr>

                   
                <?php } ?>
            </tbody>
        </table>
    <?php } elseif (isset($result)) { ?>
        <p style="color:red;">No records found for the given booking number.</p>
    <?php } ?>
    </div>
    </section>
<?php include 'foot.php'; // Include footer ?>
