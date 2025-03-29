<?php
include ('head.php');
include ('db_connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booknum=mt_rand(100000000, 999999999);
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $requirement_number = $_POST["requirement_number"];
    $shift = $_POST["shift"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO hiring_requests (BookingNumber, first_name, last_name, email, phone, requirement_number, shift, gender, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssissss",$booknum, $first_name, $last_name, $email, $phone, $requirement_number, $shift, $gender, $address);

    if ($stmt->execute()) {
        echo '<script>alert("Hiring request has been book successfully. Booking Number is "+"'.$booknum.' "+" please remember")</script>';
echo "<script>window.location.href ='index.php'</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
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
    .form-container {
        
        margin-top:100px;
        border-radius: 5px;background: linear-gradient(135deg,rgba(10, 10, 10, 0.66) 0%,rgba(1, 13, 20, 0.22) 100%);         padding: 20px;
    width: 100%;
    color:white;
    max-width: 600px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
} 
h2 {

    text-align: center;
    margin-bottom: 10px;
}
.form-group {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}
.form-group div {
    flex: 1;
}
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}
input, select, textarea {
    width: 100%;
    padding: 10px;
    border-radius:4px; background-color:rgba(1, 13, 20, 0.22);
    border-radius: 5px;
    color: #c0392b;
}
textarea {
    resize: none;
    height: 100px;
}
.submit-btn {
    width: 100%;
    padding: 10px;
    background: #e74c3c;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}
.submit-btn:hover {
    background: #d6e73c;
}
 /* Desktop Adjustments */
 @media (min-width: 1024px) {
        .form-container{
            /* margin:40px 0 0 30% ; */
        }
        
    }

</style>
   <section class="hero">
   <div class="form-container">
    <h2>Security Hiring Request</h2>
    <form action="#" method="POST">
    <div class="form-group">
        <div>
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" name="first_name" required>
        </div>
        <div>
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" name="last_name" required>
        </div>
    </div>

    <div class="form-group">
        <div>
            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
    </div>

    <label for="requirement-number">Requirement Number <span style="color: red;">(Number of Guards)</span></label>
    <input type="number" id="requirement-number" name="requirement_number" required>

    <div class="form-group">
        <div>
            <label for="shift">Shift Requirement</label>
            <select id="shift" name="shift" required>
                <option>Choose Shift</option>
                <option>Day Shift</option>
                <option>Night Shift</option>
                <option>24/7 Protection</option>
            </select>
        </div>
        <div>
            <label for="gender">Gender Preference</label>
            <select id="gender" name="gender" required>
                <option>Choose Gender</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>
    </div>

    <label for="address">Address</label>
    <textarea id="address" name="address" required></textarea>

    <button type="submit" class="submit-btn">Send</button>
</form>

</div>
    </section>
<?php include ('foot.php') ?>