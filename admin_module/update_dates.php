<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection (replace with your own credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lokesh";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $openingDate = $_POST["openingDate"];
    $closingDate = $_POST["closingDate"];
    $hallTicketDate = $_POST["hallTicketDate"];
    $resultsDate = $_POST["resultsDate"];

    // Prepare SQL statement to update the important_dates table
    $sql = "UPDATE important_dates SET 
            registration_opening_date = '$openingDate',
            registration_closing_date = '$closingDate',
            hall_ticket_release_date = '$hallTicketDate',
            results_release_date = '$resultsDate'
            WHERE id = 1"; // Assuming there is only one record in the table

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Important dates updated successfully.";
    } else {
        echo "Error updating important dates: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
