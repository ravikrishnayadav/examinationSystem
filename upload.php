<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lokesh";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["submit"])) {
    // Check if file was uploaded without errors
    if ($_FILES["fileToUpload"]["error"] == 0) {
        $file = $_FILES["fileToUpload"]["tmp_name"];
        $handle = fopen($file, "r");
        // Loop through the file line-by-line
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Assuming the CSV structure: sno, hallticket, maths, physics, chemistry, total_marks
            $sno = $data[0];
            $hallticket = $data[1];
            $maths = $data[2];
            $physics = $data[3];
            $chemistry = $data[4];
            $total_marks = $data[5];

            // Insert data into database
            $sql = "INSERT INTO results ( hallticket, maths, physics, chemistry, total_marks) VALUES ( '$hallticket', '$maths', '$physics', '$chemistry', '$total_marks')";
            if ($conn->query($sql) === TRUE) {
                echo "Record inserted successfully.<br>";
            } else {
                echo "Error inserting record: " . $conn->error . "<br>";
            }
        }
        fclose($handle);
        echo "CSV file data imported successfully.";
    } else {
        echo "Error uploading file.";
    }
}

// Close connection
$conn->close();
?>
