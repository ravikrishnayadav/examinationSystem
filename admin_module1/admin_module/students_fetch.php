
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>STUDENTS DATA</title>
    <style>
        body
        {
            background-color: #6BBFC1; /* Set background color */
        }
        table {
            border-collapse: collapse;
            width: 100%;
            overflow-x: auto; /* Add horizontal scroll for small screens */
           

        }
        th, td {
            border: 2px solid #ddd;
            padding: 8px;
            text-align: left;
            white-space: nowrap; /* Prevent line breaks */
            
        }
        th {
            background-color: #23A5A9;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }

        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            table {
                overflow-x: auto; /* Add horizontal scroll for small screens */
            }
        }

        /* Style for search input */
        .search-container {
            position: relative;
            margin-top: 10px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .search-container input[type=text] {
            padding: 2px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        
        }

        .search-container button {
            padding: 10px;
            background: #ddd;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .search-container button:hover {
            background: #ccc;
        }

        .search-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #888;
            transition: color 0.3s ease; /* Smooth transition */
        }

        .search-icon.blink {
            color: red; /* Change color when clicked */
        }
    </style>
</head>
<body>

    <?php include 'header1.php'; ?>
   
    <!-- Step 1: Connect to your database -->
    <?php
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

    // Step 2: Handle the search query
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';
    $sql = "SELECT reg_no, name, fname, intermediate_hallticket, gender, dob, address, category, image, sign, email, mobile FROM registrations WHERE name LIKE '%$search_query%'";
    $result = $conn->query($sql);

    ?>

    <!-- Step 3: Add the search form -->
    <div class="search-container">
        <input type="text" name="search" id="search" placeholder="Search by name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit" id="searchButton"><i class="fas fa-search search-icon"></i></button>
    </div>

    <!-- Step 4: Output the HTML table -->
    <div style="overflow-x: auto;">
        <table id="candidateTable">
            <tr>
                <th>SNO</th>
                <th>Reg No</th>
                <th>Name</th>
                <th>Father's Name</th>
                <th style="10%">Inter Hallticket</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>District</th>
                <th>Category</th>
                <th>Image</th>
                <th>Signature</th>
                <th style="width: 5%;">Email</th>
                <th>Mobile</th>
                <th>Action</th>
            </tr>
            <?php
if ($result->num_rows > 0) {
    $sno=1;
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $sno. "</td>";
        echo "<td>" . $row["reg_no"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["fname"] . "</td>";
        echo "<td>" . $row["intermediate_hallticket"] . "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td>" . $row["dob"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["category"] . "</td>";
        echo "<td><img src='uploads/" . $row["image"] . "' alt='Image'></td>";
        echo "<td><img src='uploads/" . $row["sign"] . "' alt='Signature'></td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["mobile"] . "</td>"; // Display mobile number
        echo "<td>";
        echo "<a href='update.php?reg_id=" . $row["reg_id"] . "' class='btn btn-warning'><i class='fas fa-edit'></i> Edit</a>";
        echo "<span style='margin: 0 5px;'></span>"; // Adjust spacing
        echo "<a href='delete.php?reg_id=" . $row["reg_id"] . "' class='btn btn-danger'><i class='fas fa-trash-alt'></i> Delete</a>";
        echo "</td>";
        echo "</tr>";
        $sno++;
    }
} else {
    echo "<tr><td colspan='14'>0 results</td></tr>";
}
$conn->close();
?>


        </table>
    </div>

    <div style="text-align: center; margin-top: 20px;">
    <div style="display: inline-block; margin-right: 10px;">
        <form action="download_data.php" method="post" style="display: inline;">
            <button type="submit" class="btn btn-primary">Download Pdf</button>
        </form>
    </div>
    <div style="display: inline-block;">
        <form action="export_to_excel.php" method="post" style="display: inline;">
            <button type="submit" class="btn btn-success">Export to Excel</button>
        </form>
    </div>
</div>

    


    <script>
        // Live search functionality
        document.getElementById("search").addEventListener("input", function() {
            var input = this.value.toLowerCase();
            var rows = document.getElementById("candidateTable").rows;

            for (var i = 1; i < rows.length; i++) {
                var name = rows[i].cells[2].textContent.toLowerCase();
                if (name.includes(input)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        });

        // Toggle class to blink search icon
        document.getElementById("searchButton").addEventListener("click", function() {
            var searchIcon = document.querySelector(".search-icon");
            searchIcon.classList.add("blink");
            setTimeout(function() {
                searchIcon.classList.remove("blink");
            }, 500); // Adjust blinking duration as needed
        });
    </script>

</body>
</html>
