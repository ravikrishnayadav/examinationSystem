<?php
            // Establish database connection (replace with your own credentials)
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

            // SQL query to fetch dates from the database
            $sql = "SELECT * from registrations WHERE reg_no='TS671707805393'";
            $result = $conn->query($sql);
            if($result->num_rows == 0)
    {
      header('Location: down_sample.html');
      exit();
        echo 'invalid registration id and dob  <a href="down_sample.html">DownloadHallticket</a>..';
    }
    $row = $result->fetch_assoc(); 
?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Admission form with PDF preview able..</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <style>
    body{
        background-color: aqua;
    }
    
    .hallticket-info {
            text-align: center;
            margin-bottom: 20px;
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
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      
      <div class="col-sm-12" style="border: 2px solid black;padding:5px; text-align: center;">
      <div class="header">
        <div class="image-container">
            <img src="banner.jpg" alt="Description">
          </div>
          
    </div>
      </div>
      
    </div>
    
    <div class="row" style="border: 1px solid black; padding:10px;margin-top:7px">
        <div class="col-sm-1">

        </div>
        <div class="col-sm-10" >
            <div class="row">
                <div class="col-sm-12">
            
                <h3 style="text-align:center">Hall Ticket Number: KG32123</h3>
            
        </div>
        </div>
   
        <div class="row" style="padding-top:30px">
            <div class="col-sm-6" style="padding-top:20px">
                <div class="row">
                    <div class="col-sm-6">
                        <label class="lable">Registration No :- </label>

                    </div>
                    <div class="col-sm-6"> <?php echo $row['reg_no']?></div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="lable">Hallticket No :- </label>

                    </div>
                    <div class="col-sm-6"> 234567890</div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="lable">Candidate Name :- </label>

                    </div>
                    <div class="col-sm-6"> lokesh</div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="lable">Father Name :- </label>

                    </div>
                    <div class="col-sm-6"> Subbarayudu</div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="lable">Date of Birth :- </label>

                    </div>
                    <div class="col-sm-6"> <?php echo $row['dob']?></div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="lable">Rank :- </label>

                    </div>
                    <div class="col-sm-6"> 02</div>
                </div>
            </div>
            <div class="col-sm-6">
                
                    <div class="form-group" style="float: right;">
                         <label class="lable"> Photo </label>
                   <div style="width: 150px; ">
                      <img src="admin_module/uploads/<?php echo $row['image']; ?> "  width="150" height="150">
                  </div>
                
                  </div>
                  
            </div>
            <hr>
            <table class="table">
                <thead>
                  <tr>
                    
                    <th scope="col">Subject</th>
                    <th scope="col">Total Marks</th>
                    <th scope="col">Achieved Marks</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    
                    <th>Maths</th>
                    <td>60</td>
                    <td>50</td>
                  </tr>
                  <tr>
                    
                    <th>Physics</th>
                    <td>60</td>
                    <td>40</td>
                  </tr>
                  <tr>
                    <th>Chemistry</th>
                    <td>60</td>
                    <td>40</td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <td>180</td>
                    <td>130</td>
                  </tr>
                </tbody>
              </table>
        </div>
        
            
        
        </div>
        <div class="col-sm-1"></div>

    </div>
    <br>
<center><button type="button" class="btn btn-warning" id="printbtn" onclick="window.print()">Print Form</button></center>
<br>
  </div>
  
</body>
</html>