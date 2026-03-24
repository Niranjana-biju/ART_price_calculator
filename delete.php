<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "art_pricing_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get ID from URL
if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Prepare statement for safety
    $stmt = $conn->prepare("DELETE FROM price_records WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

// Redirect back to gallery
header("Location: history.php");
exit();
?>

