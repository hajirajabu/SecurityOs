<?php
include '../db_connection.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $result = $conn->query("SELECT * FROM hiring_requests WHERE id = $userId");
    $user = $result->fetch_assoc();
    header('Content-Type: application/json');
    echo json_encode($user);
}