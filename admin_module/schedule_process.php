<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "lokesh";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract exam date and time from the form
    $exam_date = $_POST["exam_date"];
    $exam_time = $_POST["exam_time"];

    // Insert selected candidates into the exam schedule table
    if (isset($_POST['candidates']) && is_array($_POST['candidates'])) {
        foreach ($_POST['candidates'] as $candidate) {
            // Fetch candidate details from the registrations table
            $fetch_candidate_sql = "SELECT reg_no, name, address FROM registrations WHERE reg_id = $candidate";
            $candidate_result = $conn->query($fetch_candidate_sql);
            if ($candidate_result->num_rows > 0) {
                $row = $candidate_result->fetch_assoc();
                $reg_no = $row['reg_no'];
                $name = $row['name'];
                $district = $row['address'];

                // Insert candidate details into the exam schedule table
                $insert_sql = "INSERT INTO exam_schedule (reg_no, name, district, exam_date, exam_time) 
                    VALUES ('$reg_no', '$name', '$district', '$exam_date', '$exam_time')";
                $conn->query($insert_sql);
            }
        }
        echo "Exam schedule assigned successfully!";
    } else {
        echo "No candidates selected!";
    }
}

$conn->close();
?>
