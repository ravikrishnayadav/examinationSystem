<?php
// Step 1: Connect to your database
include 'conn.php';

// Step 2: Retrieve the serial number from the URL
$sno = $_GET['sno'];

// Step 3: Delete the record from the database
$sql = "DELETE FROM registrations WHERE sno=$sno";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
