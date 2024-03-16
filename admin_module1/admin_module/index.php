
<?php


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];
    // Replace these with your actual database credentials
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

    // Query to retrieve user from the database
    $sql = "SELECT * FROM admin_password WHERE username = '$enteredUsername' AND password = '$enteredPassword'";
    $result = $conn->query($sql);

    // Check if the query returned any rows (user found)
    if ($result->num_rows > 0) {
        // Fetch user data
        $userData = $result->fetch_assoc();
          session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['password'] = $userData['password'];
        

        // Redirect to admin_interface.php
        header("Location: admin_home.php");
        exit();
    } else {
        echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Invalid</strong> Username or Password
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }   
    // Close connection
$conn->close(); 
       
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <style>
    body {
      background-color: #84a2d1;
    }

    .login-container {
      max-width: 400px;
      margin: auto;
      margin-top: 90px;
      border: 5px solid #000000;
      border-radius: 20px;
     box-shadow: 0 0 10px rgba(0,0,0,0.1);

    }
     .logo {
      max-width: 100px; /* Adjust the max-width of the logo as needed */
      margin-bottom: 20px; /* Add margin to create space between the logo and the heading */
      margin-top: 10px;
      margin-left: 135px;
       max-width: 80px; /* Adjust the max-width to decrease the size of the logo */  
    }
    button{
      margin-top: 20px;
      margin-bottom: 20px;
        margin-left: 120px;
        width: 35%;

    }
  </style>
</head>
<body>

<div class="container login-container">
  <img src="adphoto.jpg" alt="Admin Logo" class="logo">
  <h2 class="text-center mb-4">Admin Login</h2>
  <form method="post" action="index.php"> <!-- Replace with the actual filename of your PHP script -->
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Login</button>
  </form>
</div>

<!-- Bootstrap JS and Popper.js (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
