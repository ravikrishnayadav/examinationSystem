<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Schedule</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <style>
        /* Enhanced CSS for styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
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
        /* Styling for colorful icons */
        .filter-icon {
            color: #007bff; /* Blue */
            margin-right: 5px;
        }
        .download-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
    <?php include 'header1.php' ?>
    </div>
    <h2>Exam Schedule</h2>

    <!-- Filter Form -->
    <form id="filterForm">
        <label for="dateFilter"><i class="fas fa-calendar-alt filter-icon"></i> Filter by Date:</label>
        <input type="date" id="dateFilter" onchange="filterTable()">
        <label for="timeFilter"><i class="fas fa-clock filter-icon"></i> Filter by Time:</label>
        <select id="timeFilter" onchange="filterTable()">
            <option value="">All Times</option>
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

            // SQL query to fetch unique exam times
            $sql = "SELECT DISTINCT exam_time FROM exam_schedule";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["exam_time"]."'>".$row["exam_time"]."</option>";
                }
            }

            $conn->close();
            ?>
        </select>
    </form>

    <br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Registration Number</th>
                <th>Ht_no</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>District</th>
                <th>Exam Date</th>
                <th>Exam Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <?php
            // Database connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Initialize counter variable
            $counter = 1;

            // SQL query to fetch all data from exam_schedule table
            $sql = "SELECT id, reg_no, ht_no, name, DATE_FORMAT(dob, '%d-%m-%Y') as dob, district, DATE_FORMAT(exam_date,'%d-%m-%Y') as exam_date, exam_time FROM exam_schedule";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$counter."</td>
                            <td>".$row["reg_no"]."</td>
                            <td>".$row["ht_no"]."</td>
                            <td>".$row["name"]."</td>
                            <td>".$row["dob"]."</td>
                            <td>".$row["district"]."</td>
                            <td>".$row["exam_date"]."</td>
                            <td>".$row["exam_time"]."</td>
                            <td class='action-buttons'>
                                <button class='edit-btn' onclick='editRecord(".$row["id"].")'><i class='fas fa-edit'></i> Edit</button>
                                <button class='delete-btn' onclick='deleteRecord(".$row["id"].")'><i class='fas fa-trash-alt'></i> Delete</button>
                            </td>
                        </tr>";
                    // Increment counter for the next row
                    $counter++;
                }
            } else {
                echo "<tr><td colspan='8'>No results found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Download Button -->
    <button class="download-btn" onclick="downloadSchedule()">Download Schedule</button>

    <script>
        // Function to filter table rows based on date and time
        function filterTable() {
            var dateFilterValue = document.getElementById("dateFilter").value;
            var timeFilterValue = document.getElementById("timeFilter").value;

            var rows = document.querySelectorAll("#tableBody tr");

            rows.forEach(function(row) {
                var examDate = row.querySelector("td:nth-child(7)").textContent;
                var examTime = row.querySelector("td:nth-child(8)").textContent;

                var formattedExamDate = formatDate(examDate); // Format date
                var formattedExamTime = examTime;

                // Show row if both date and time match, or if filters are empty
                if ((formattedExamDate === dateFilterValue || dateFilterValue === "") &&
                    (formattedExamTime === timeFilterValue || timeFilterValue === "" || timeFilterValue === "All Times")) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        //<script>
    // Function to filter table rows based on date and time
    function filterTable() {
        var dateFilterValue = document.getElementById("dateFilter").value;
        var timeFilterValue = document.getElementById("timeFilter").value;

        var rows = document.querySelectorAll("#tableBody tr");

        rows.forEach(function(row) {
            var examDate = row.querySelector("td:nth-child(7)").textContent;
            var examTime = row.querySelector("td:nth-child(8)").textContent;

            var formattedExamDate = formatDate(examDate); // Format date
            var formattedExamTime = examTime;

            // Show row if both date and time match, or if filters are empty
            if ((formattedExamDate === dateFilterValue || dateFilterValue === "") &&
                (formattedExamTime === timeFilterValue || timeFilterValue === "" || timeFilterValue === "All Times")) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    // Function to format date from dd-mm-yyyy to yyyy-mm-dd
    function formatDate(dateString) {
        var parts = dateString.split("-");
        return parts[2] + "-" + parts[1] + "-" + parts[0];
    }

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

    // Function to download schedule
       // Function to download schedule
    function downloadSchedule() {
        // Collect filtered and visible table data
        var visibleRows = document.querySelectorAll("#tableBody tr:not([style*='display: none'])");
        var csvContent = "data:text/csv;charset=utf-8,";

        // Manually adding headers
        var headers = ["ID", "Registration Number", "Ht_no", "Name", "Date of Birth", "District", "Exam Date", "Exam Time"];
        csvContent += headers.join(",") + "\n";

        // Append row data
        visibleRows.forEach(function(row) {
            var rowData = [];
            row.querySelectorAll("td:not(.action-buttons)").forEach(function(cell) { // Exclude action-buttons column
                rowData.push(cell.textContent);
            });
            csvContent += rowData.join(",") + "\n";
        });

        // Trigger download
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "exam_schedule.csv");
        document.body.appendChild(link);
        link.click();
    }
</script>
</div>

</body>
</html>
