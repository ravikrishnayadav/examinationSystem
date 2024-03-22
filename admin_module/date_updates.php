<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit;
}
?>

<?php
$dateUpdated = false;
$previousDates = array(
    'openingDate' => '',
    'closingDate' => '',
    'hallTicketDate' => '',
    'resultsDate' => ''
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lokesh";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $openingDate = $_POST["openingDate"];
    $closingDate = $_POST["closingDate"];
    $hallTicketDate = $_POST["hallTicketDate"];
    $resultsDate = $_POST["resultsDate"];

    $sql = "UPDATE important_dates SET 
            registration_opening_date = '$openingDate',
            registration_closing_date = '$closingDate',
            hall_ticket_release_date = '$hallTicketDate',
            results_release_date = '$resultsDate'
            WHERE id = 1";

    if ($conn->query($sql) === TRUE) {
        $dateUpdated = true;
    } else {
        echo "Error updating important dates: " . $conn->error;
    }

    $conn->close();
} else {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lokesh";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM important_dates WHERE id = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $previousDates['openingDate'] = $row['registration_opening_date'];
        $previousDates['closingDate'] = $row['registration_closing_date'];
        $previousDates['hallTicketDate'] = $row['hall_ticket_release_date'];
        $previousDates['resultsDate'] = $row['results_release_date'];
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Interface - Update Important Dates</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* CSS styles for the form */
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f7f7f7;
    margin: 0; /* Remove default margin */
    padding: 0; /* Remove default padding */
    animation: changeBackground 10s infinite alternate; /* Animated background color */
}

        @keyframes changeBackground {
            0% {
                background-color: #f7f7f7;
                /* Initial background color */
            }

            50% {
                background-color: #e6e6e6;
                /* Midway background color */
            }

            100% {
                background-color: #f7f7f7;
                /* Final background color */
            }
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            /* Set container background color */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeInDown 1s ease;
            /* Fade in animation */
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            /* Dark text color */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .input-group i {
            margin-right: 10px;
            color: #555;
            /* Default icon color */
        }

        .input-label {
            flex: 1;
            text-align: left;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            align-self: center;
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            /* Smooth color transition */
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            font-style: italic;
            margin-top: 5px;
        }

        .alert-success {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            color: #3c763d;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <?php include 'header1.php'; ?>

    <div class="container">
        <h2><i class="fas fa-calendar-alt"></i> Update Important Dates</h2>
        <?php
        if ($dateUpdated) {
            echo '<div class="alert alert-success" role="alert">
            Dates have been successfully updated!
          </div>';
        }
        ?>
        <form action="date_updates.php" method="post" onsubmit="return validateForm()">
            <div class="input-group">
                <label class="input-label" for="openingDate">Registration Opening Date:</label>
                <div>
                <input type="text" id="openingDate" name="openingDate" placeholder="YYYY-MM-DD" value="<?php echo $previousDates['openingDate']; ?>" required>
                    <i class="fas fa-calendar-plus" style="color: #FF5733;"></i>
                    <!-- Adjusted icon color -->
                </div>
            </div>

            <div class="input-group">
                <label class="input-label" for="closingDate">Registration Closing Date:</label>
                <div>
                    <input type="text" id="closingDate" name="closingDate" placeholder="YYYY-MM-DD" value="<?php echo $previousDates['closingDate']; ?>"required>
                    <i class="fas fa-calendar-times" style="color: #C70039;"></i>
                    <!-- Adjusted icon color -->
                </div>
            </div>

            <div class="input-group">
                <label class="input-label" for="hallTicketDate">Hall Ticket Release Date:</label>
                <div>
                    <input type="text" id="hallTicketDate" name="hallTicketDate" placeholder="YYYY-MM-DD" value="<?php echo $previousDates['hallTicketDate']; ?>" required>
                    <i class="fas fa-file-alt" style="color: #FFC300;"></i>
                    <!-- Adjusted icon color -->
                </div>
            </div>

            <div class="input-group">
                <label class="input-label" for="resultsDate">Results Release Date:</label>
                <div>
                    <input type="text" id="resultsDate" name="resultsDate" placeholder="YYYY-MM-DD" value="<?php echo $previousDates['resultsDate']; ?>" required>
                    <i class="fas fa-poll" style="color: #3498DB;"></i>
                    <!-- Adjusted icon color -->
                </div>
            </div>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>

   
