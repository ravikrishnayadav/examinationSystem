<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search by Reg No</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 8px;
            font-size: 16px;
        }
        button {
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            position: relative;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 80px;
            max-height: 80px;
            position: absolute;
            top: 5px;
            right: 5px;
        }
    </style>
</head>
<body>


    <?php
    // Step 1: Connect to your database
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

    // Check if form is submitted and reg_no is provided
    if (isset($_POST['reg_no']) && !empty($_POST['reg_no'])) {
        $reg_no = $_POST['reg_no'];

        // Step 2: Execute a query to fetch the desired data based on reg_no
        $sql = "SELECT reg_id, reg_no, name, fname, intermediate_hallticket, gender, dob, address, category, image, sign, email, mobile FROM registrations WHERE reg_no = '$reg_no'";
        $result = $conn->query($sql);

        // Step 3: Output the fetched data
        if ($result->num_rows > 0) {
            echo "<h3>Search Results</h3>";
            echo "<p>Below are the details for the provided registration number:</p>";
            echo "<table>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><th colspan='2'>Student Details</th></tr>";
                echo "<tr><th>Reg ID</th><td>" . $row["reg_id"] . "</td></tr>";
                echo "<tr><th>Reg No</th><td>" . $row["reg_no"] . "</td></tr>";
                echo "<tr><th>Name</th><td>" . $row["name"] . "</td></tr>";
                echo "<tr><th>Father's Name</th><td>" . $row["fname"] . "</td></tr>";
                echo "<tr><th>Mother's Name</th><td>" . $row["intermediate_hallticket"] . "</td></tr>";
                echo "<tr><th>Gender</th><td>" . $row["gender"] . "</td></tr>";
                echo "<tr><th>Date of Birth</th><td>" . $row["dob"] . "</td></tr>";
                echo "<tr><th>Address</th><td>" . $row["address"] . "</td></tr>";
                echo "<tr><th>Category</th><td>" . $row["category"] . "</td></tr>";
                echo "<tr><th>Image</th><td><img src='admin_module/uploads/" . $row["image"] . "' alt='Image'></td></tr>";
                echo "<tr><th>Signature</th><td><img src='admin_module/uploads/" . $row["sign"] . "' alt='Signature'></td></tr>";
                echo "<tr><th>Email</th><td>" . $row["email"] . "</td></tr>";
                echo "<tr><th>Mobile</th><td>" . $row["mobile"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No results found for reg_no: $reg_no</p>";
        }
    }

    $conn->close();
    ?>

</body>
</html>
