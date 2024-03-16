<?php
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="data_export.xls"');

// Step 1: Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lokesh";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Fetch data from the database
$sql = "SELECT sno, reg_no, name, fname, intermediate_hallticket, gender, dob, district, category, email, mobile FROM registrations";
$result = $conn->query($sql);

// Step 3: Generate Excel file content
echo "Sno\tReg No\tName\tFather's Name\tIntermediate Hallticket\tGender\tDate of Birth\tDistrict\tCategory\tEmail\tMobile\n";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row["sno"] . "\t" . $row["reg_no"] . "\t" . $row["name"] . "\t" . $row["fname"] . "\t" . $row["intermediate_hallticket"] . "\t" . $row["gender"] . "\t" . $row["dob"] . "\t" . $row["district"] . "\t" . $row["category"] . "\t" . $row["email"] . "\t" . $row["mobile"] . "\n";
    }
}

$conn->close();
?>
