<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

include 'conn.php';
if(isset($_POST['form_submit'])){
$sql = "SELECT * FROM admin_password where sno=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$email = $row['username']; // Assigning the email address from the database query result to the $email variable
// Provide a valid email address
$otp = rand(10000, 99999);

$sql = "UPDATE admin_password SET otp=? where sno=1"; // Assuming there's a field 'otp' in the table 'admin_password'

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error: " . $conn->error);
}

$stmt->bind_param('i', $otp);

if ($stmt->execute()) {
    $message = "OTP sent successfully!<br>Your OTP is: " . $otp;
    $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="48px" height="48px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg>';
    $color = 'green';

   // Send confirmation email
   $mail = new PHPMailer(true);
   // Server settings
   $mail->isSMTP(); // Send using SMTP
   $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
   $mail->SMTPAuth   = true; // Enable SMTP authentication
   $mail->Username   = 'kuppanikiransai@gmail.com'; // SMTP username
   $mail->Password   = 'cucupxrwtknrbzyc'; // SMTP password
   $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
   $mail->Port       = 465; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

   // Recipients
   $mail->setFrom('kuppanikiransai@gmail.com', 'ADMIN'); // Sender Email and name
   $mail->addAddress($email); // Add a recipient email
   $mail->addReplyTo($email); // Reply to sender email
   
    $mail->isHTML(true);
    $mail->Subject = "OTP sent successfully";
    $mail->Body = "<h3>Your OTP is $otp </h3>";

    if (!$mail->send()) {
        $message .= "Mailer Error: " . $mail->ErrorInfo;
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="48px" height="48px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4l-8 8-4-4 1.5-1.5L4 10V3h8v4h4V3h8v7l2 2V1c0-.55-.45-1-1-1H1C.45 0 0 .45 0 1v18c0 .55.45 1 1 1h22c.55 0 1-.45 1-1V6l-2-2-2 2V4z"/></svg>';
        $color = 'red';
    }
} else {
    $message = "Error: " . $conn->error;
    $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="48px" height="48px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4l-8 8-4-4 1.5-1.5L4 10V3h8v4h4V3h8v7l2 2V1c0-.55-.45-1-1-1H1C.45 0 0 .45 0 1v18c0 .55.45 1 1 1h22c.55 0 1-.45 1-1V6l-2-2-2 2V4z"/></svg>';
    $color = 'red';
}
}


$conn->close();
?>

<?php


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

// Check if the form is submitted
if(isset($_POST['submit'])){
    $enteredOTP = $_POST["otp"];
    $newPassword = $_POST["new_password"];
    $confirmPassword=$_POST["confirm_password"];
    if($newPassword===$confirmPassword)
    {

    // Query to retrieve user from the database
    $sql = "SELECT * FROM admin_password WHERE otp = '$enteredOTP'";
    $result = $conn->query($sql);

    // Check if the query returned any rows (user found)
    if ($result->num_rows > 0) {
        // Update password
        $updateSql = "UPDATE admin_password SET password = '$newPassword' WHERE otp = '$enteredOTP'";
        if ($conn->query($updateSql) === TRUE) {
            $successMessage = "Password changed successfully.";
        } else {
            $errorMessage = "Error updating password: " . $conn->error;
        }
    } else {
        $errorMessage = "Invalid OTP.";
    }
  }
  else{
    $errorMessage="Both or not Matched";
  }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #141e30, #243b55);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .change-password-container {
      width: 350px;
      background-color: rgba(255, 255, 255, 0.9);
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
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
      margin-bottom: 20px;
      color: #333;
    }

    input[type="text"],
    input[type="password"],
    button {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      animation: slideIn 1s forwards;
    }

    input[type="text"],
    input[type="password"] {
      background-color: #f5f5f5;
    }

    button {
      background-color: #007bff;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #0056b3;
    }

    .error-message {
      color: red;
      text-align: center;
      margin-top: 10px;
      display: <?php echo isset($errorMessage) ? 'block' : 'none'; ?>;
    }

    .success-message {
      color: green;
      text-align: center;
      margin-top: 10px;
      display: <?php echo isset($successMessage) ? 'block' : 'none'; ?>;
    }
    .success-message i {
      color: green;
      font-size: 24px;
      margin-right: 5px;
      animation: zoomIn 0.5s ease-in-out;
    }

    @keyframes zoomIn {
      from {
        transform: scale(0);
      }
      to {
        transform: scale(1);
      }
    }
    .error-message {
      color: red;
      text-align: center;
      margin-top: 10px;
      display: <?php echo isset($errorMessage) ? 'block' : 'none'; ?>;
    }

    .error-message i {
      color: red;
      font-size: 24px;
      margin-right: 5px;
      animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {
      0% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      50% { transform: translateX(5px); }
      75% { transform: translateX(-5px); }
      100% { transform: translateX(0); }
    }
  </style>
</head>
<body>
<div class="change-password-container">
    <?php if (isset($errorMessage)) { ?>
        <div class="error-message"><i class="fas fa-exclamation-circle"></i><?php echo $errorMessage; ?></div>
    <?php } ?>
    <?php if (isset($successMessage)) { ?>
        <div class="success-message"><i class="fas fa-check-circle"></i><?php echo $successMessage; ?></div>
    <?php } ?>

    <h2>Change Password</h2>
    
    <form action="change_psw.php" id="change-password-form"  method="POST">
      <input type="text" id="otp" name="otp" placeholder="OTP" required>
      <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
      <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" required>
      <button type="submit" name="submit">Submit</button>
    </form>
  </div>
</body>
</html>
    