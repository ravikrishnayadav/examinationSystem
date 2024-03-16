<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Schedule</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Enhanced CSS for styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2; /* Alternate row color */
        }
        tbody tr:hover {
            background-color: #e0e0e0; /* Hover color */
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .edit-btn, .delete-btn {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Exam Schedule</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Registration Number</th>
                <th>Ht_no</th>
                <th>Name</th>
                <th>District</th>
                <th>Exam Date</th>
                <th>Exam Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
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

            // SQL query to fetch all data from exam_schedule table
            $sql = "SELECT id, reg_no,ht_no, name, district, exam_date, exam_time FROM exam_schedule";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["id"]."</td>
                            <td>".$row["reg_no"]."</td>
                            <td>".$row["ht_no"]."</td>
                            <td>".$row["name"]."</td>
                            <td>".$row["district"]."</td>
                            <td>".$row["exam_date"]."</td>
                            <td>".$row["exam_time"]."</td>
                            <td class='action-buttons'>
                                <button class='edit-btn' onclick='editRecord(".$row["id"].")'><i class='fas fa-edit'></i> Edit</button>
                                <button class='delete-btn' onclick='deleteRecord(".$row["id"].")'><i class='fas fa-trash-alt'></i> Delete</button>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No results found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        function editRecord(id) {
            // Redirect to edit page with record ID
            window.location.href = "edit_record.php?id=" + id;
        }

        function deleteRecord(id) {
            // Here you can implement deletion logic using AJAX or redirect to delete page with record ID
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = "delete_record.php?id=" + id;
            }
        }
    </script>
</body>
</html>
