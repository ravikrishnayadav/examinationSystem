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

    // Initialize flag variable
    $insertion_success = false;

    // Check if candidates are selected
    if (isset($_POST['candidates']) && is_array($_POST['candidates'])) {
        foreach ($_POST['candidates'] as $candidate) {
            // Fetch candidate details from the registrations table
            $fetch_candidate_sql = "SELECT reg.sno, reg.reg_no, reg.name, reg.district 
                                    FROM registrations reg
                                    LEFT JOIN exam_schedule es ON reg.reg_no = es.reg_no
                                    WHERE reg.sno = $candidate AND es.reg_no IS NULL";
            $candidate_result = $conn->query($fetch_candidate_sql);
            if ($candidate_result->num_rows > 0) {
                $row = $candidate_result->fetch_assoc();
                $reg_no = $row['reg_no'];
                $name = $row['name'];
                $district = $row['district'];

                // Insert candidate details into the exam schedule table
                $insert_sql = "INSERT INTO exam_schedule (reg_no, name, district, exam_date, exam_time) 
                    VALUES ('$reg_no', '$name', '$district', '$exam_date', '$exam_time')";
                if ($conn->query($insert_sql) === TRUE) {
                    $insertion_success = true;
                }
            }
        }
        
        // Display success message if at least one insertion was successful
        if ($insertion_success) {
            echo "Exam schedule assigned successfully!";
        } else {
            echo "No candidates were inserted into the exam schedule!";
        }
    } else {
        echo "No candidates selected!";
    }
}

$conn->close();
?>
