<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #ffcc00;
            color: white;
            padding: 1px;
            text-align: center;
        }
        .image-container {
  display: flex;
  justify-content: center; /* Center the image horizontally */
}

.image-container img {
  width: auto; /* Allow the image to adjust its width */
  max-width: 100%; /* Ensure the image doesn't exceed its container's width */
  margin: 0 20px; /* Increase left and right side edges */
}
        nav {
            background-color: #154360;
            padding-top:1px;
            overflow: hidden;
            text-align: left; /* Center align the navigation links */
        }

        nav a {
            display: inline-block; /* Make navigation links display inline */
            color: white;
            text-decoration: none;
            padding: 14px 50px; /* Adjust padding as needed */
            margin: 0 10px; /* Adjust margin as needed */
        }

        nav a:hover {
            background-color: #f39c12;
            color: black;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="image-container">
            <img src="banner.jpg" alt="Description">
          </div>
          
    </div>

    <nav>
        <a href="admin_home.php">HOME</a>
        <a href="students_fetch.php">Student Details</a>
        <a href="date_update.php">Dates Updates</a>
        <a href="process_hallticket.php">Hallticket Arrange</a>
        <a href="results.php">Results</a>
        <a href="logout.php">Logout</a>
    </nav>
</body>
</html>
