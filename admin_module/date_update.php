<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Interface - Update Important Dates</title>
<style>
/* CSS styles for the form */
body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
}

.container {
    max-width: 500px;
    margin: 50px auto;
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 30px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"] {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

.error-message {
    color: red;
    font-style: italic;
    margin-top: 5px;
}

</style>
<script>
function validateForm() {
    var openingDate = document.getElementById("openingDate").value;
    var closingDate = document.getElementById("closingDate").value;
    var hallTicketDate = document.getElementById("hallTicketDate").value;
    var resultsDate = document.getElementById("resultsDate").value;

    // Validate date format (YYYY-MM-DD)
    var dateFormat = /^\d{4}-\d{2}-\d{2}$/;

    if (!openingDate.match(dateFormat) || !closingDate.match(dateFormat) || !hallTicketDate.match(dateFormat) || !resultsDate.match(dateFormat)) {
        alert("Please enter dates in the format YYYY-MM-DD");
        return false;
    }

    // Convert dates to Date objects for comparison
    var opening = new Date(openingDate);
    var closing = new Date(closingDate);

    // Validate closing date is after opening date
    if (closing <= opening) {
        alert("Closing date must be after opening date");
        return false;
    }

    return true;
}
</script>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h2>Update Important Dates</h2>
    <form action="update_dates.php" method="post" onsubmit="return validateForm()">
        <label for="openingDate">Registration Opening Date:</label>
        <input type="text" id="openingDate" name="openingDate" placeholder="YYYY-MM-DD" required>

        <label for="closingDate">Registration Closing Date:</label>
        <input type="text" id="closingDate" name="closingDate" placeholder="YYYY-MM-DD" required>

        <label for="hallTicketDate">Hall Ticket Release Date:</label>
        <input type="text" id="hallTicketDate" name="hallTicketDate" placeholder="YYYY-MM-DD" required>

        <label for="resultsDate">Results Release Date:</label>
        <input type="text" id="resultsDate" name="resultsDate" placeholder="YYYY-MM-DD" required>

        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
