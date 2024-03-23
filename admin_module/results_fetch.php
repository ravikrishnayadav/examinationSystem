<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results and Graph</title>
    <!-- Import Chart.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .chart-container {
            width: 45%;
            float: left;
            margin-right: 5%;
        }
        canvas {
            max-width: 100%;
            margin: 0 auto;
        }
        /* Increase the height of the canvas for the bar graph */
        #resultsChart {
            height: 400px; /* Adjust the height as needed */
        }
    </style>
</head>
<body>
    <h1>Results and Graph</h1>

    <!-- Display table of results -->
    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'lokesh');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch all data from the table ordered by rank
    $sql = "SELECT * FROM results ORDER BY rank";
    $result = $conn->query($sql);

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Output table header
        echo "<table><tr><th></th><th>Registration Number</th><th>Ht_no</th><th>Name</th><th>Maths</th><th>Physics</th><th>Chemistry</th><th>Total</th><th>Rank</th></tr>";

        // Output data of each row
        $sno = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$sno."</td><td>".$row["reg_no"]."</td><td>".$row["ht_no"]."</td><td>".$row["name"]."</td><td>".$row["maths"]."</td><td>".$row["physics"]."</td><td>".$row["chemistry"]."</td><td>".$row["total"]."</td><td>".$row["rank"]."</td></tr>";
            $sno++;
        }

        echo "</table>";

        // Close database connection
        $conn->close();

        // Fetching data for the chart
        $conn = new mysqli('localhost', 'root', '', 'lokesh');
        $sql = "SELECT name, maths, physics, chemistry, total FROM results";
        $result = $conn->query($sql);

        // Creating arrays to store data for the chart
        $names = [];
        $maths = [];
        $physics = [];
        $chemistry = [];
        $totals = [];

        // Fetching data from the result set
        while ($row = $result->fetch_assoc()) {
            array_push($names, $row["name"]);
            array_push($maths, $row["maths"]);
            array_push($physics, $row["physics"]);
            array_push($chemistry, $row["chemistry"]);
            array_push($totals, $row["total"]);
        }

        // Closing database connection
        $conn->close();
    ?>

    <!-- Display the bar chart -->
    <div class="chart-container">
        <canvas id="resultsChart"></canvas>
    </div>
    
    <!-- Display the pie chart -->
    <div class="chart-container">
        <canvas id="resultsPieChart"></canvas>
    </div>

    <script>
        // Chart.js code to create a bar chart
        var ctx = document.getElementById('resultsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($names); ?>,
                datasets: [{
                    label: 'Maths',
                    data: <?php echo json_encode($maths); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Physics',
                    data: <?php echo json_encode($physics); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {
                    label: 'Chemistry',
                    data: <?php echo json_encode($chemistry); ?>,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }, {
                    label: 'Total Marks',
                    data: <?php echo json_encode($totals); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Chart.js code to create a pie chart
        var ctxPie = document.getElementById('resultsPieChart').getContext('2d');
        var myPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Maths', 'Physics', 'Chemistry'],
                datasets: [{
                    label: 'Subjects Distribution',
                    data: [
                        <?php 
                            // Calculate total marks for each subject
                            $totalMaths = array_sum($maths);
                            $totalPhysics = array_sum($physics);
                            $totalChemistry = array_sum($chemistry);
                            echo $totalMaths . ", " . $totalPhysics . ", " . $totalChemistry;
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <?php } else {
        echo "No results found";
    } ?>
</body>
</html>
