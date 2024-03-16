<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Exam Date and Time</title>
    <style>
        /* CSS styles remain unchanged */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-top: 20px;
        }
        input[type="submit"], input[type="button"] {
            padding: 8px 16px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px; /* Add margin to the right side */
            margin-top: 5px;
        }
        input[type="submit"]:last-child, input[type="button"]:last-child {
            margin-right: 0;
            margin-top: 5px; /* Remove margin from the last button */
        }
        input[type="date"], input[type="time"], input[type="number"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
            margin-top: 5px;
        }
        label {
            font-weight: bold;
            margin-right: 10px;
        }
        /* Highlight selected rows */
        .highlight {
            background-color: #ffff99; /* Yellow background */
        }

        /* Additional button styles */
        .show-schedule-button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .show-schedule-button:hover {
            background-color: #45a049; /* Darker green */
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h2>Assign Exam Date and Time</h2>
        <form action="schedule_process.php" method="post" id="assignExamForm">
            <table>
                <!-- Table headers remain unchanged -->
                <thead>
                    <tr>
                        <th>sno</th>
                        <th>select</th>
                        <th>Registration Number</th>
                        <th>Name</th>
                        <th>District</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP code for fetching registration details remains unchanged -->
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

                        // SQL query to fetch registration details including registration number, name, and district
                        $sql = "SELECT r.reg_id, r.reg_no, r.name, r.address 
                                FROM registrations r
                                LEFT JOIN exam_schedule es ON r.reg_no = es.reg_no
                                WHERE es.reg_no IS NULL
                                ORDER BY r.address";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $count = 1; // Initialize record counter
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>".$count."</td>
                                        <td><input type='checkbox' name='candidates[]' value='".$row["reg_id"]."'></td>
                                        <td>".$row["reg_no"]."</td>
                                        <td>".$row["name"]."</td>
                                        <td>".$row["address"]."</td>
                                    </tr>";
                                $count++; // Increment record counter
                            }
                        } else {
                            echo "<tr><td colspan='5'>No results found</td></tr>";
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>
            <label for="exam_date">Exam Date:</label>
            <!-- Set min attribute to ensure date not less than current date -->
            <input type="date" id="exam_date" name="exam_date" min="<?php echo date('Y-m-d'); ?>">
            <label for="exam_time">Exam Time:</label>
            <!-- Dropdown menu for selecting exam time -->
            <select id="exam_time" name="exam_time">
                <option value="10:00 AM">10:00 AM</option>
                <option value="02:00 PM">02:00 PM</option>
            </select>
            <br>
            <label for="start_range">Start Range:</label>
            <input type="number" id="start_range" name="start_range">
            <label for="end_range">End Range:</label>
            <input type="number" id="end_range" name="end_range">
            <br>
            <input type="button" value="Select Range" onclick="selectRange()">
            <input type="submit" value="Assign Schedule">
        </form>
    </div>

    <!-- Show Schedule button -->
    <div style="text-align: right;">
        <button class="show-schedule-button" onclick="showSchedule()">Show Schedule</button>
    </div>

    <script>
        function selectRange() {
            var start = parseInt(document.getElementById("start_range").value);
            var end = parseInt(document.getElementById("end_range").value);
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            
            if (start > 0 && end > 0 && end >= start) {
                checkboxes.forEach(function(checkbox, index) {
                    var row = checkbox.parentNode.parentNode;
                    checkbox.checked = (index + 1 >= start && index + 1 <= end);
                    if (checkbox.checked) {
                        row.classList.add('highlight');
                    } else {
                        row.classList.remove('highlight');
                    }
                });
            } else {
                alert("Invalid range. Please enter valid start and end numbers.");
            }
        }

        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var row = this.parentNode.parentNode;
                if (this.checked) {
                    row.classList.add('highlight');
                } else {
                    row.classList.remove('highlight');
                }
            });
        });

        // Function to handle the click event of the "Show Schedule" button
        function showSchedule() {
            window.location.href = 'show_schedule.php';
        }
    </script>
</body>
</html>
