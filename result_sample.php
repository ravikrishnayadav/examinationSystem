<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Admission form with PDF preview able..</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <style>
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
    
    <div class="row">
      <div class="col-sm-1">
      </div>
      <div class="col-sm-10" style="border: 2px solid black; padding:80px;">
        <form action="form_action.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3 row">
                <div class="col-sm-4">
                  <label class="lable">Registration No :- </label>
                </div>
                <div class="col-sm-8">
                  <h5>Ts234567890</h5>
                </div>
              </div>
              <div class="mb-3 row">
                <div class="col-sm-4">
                  <label class="lable">Hallticket No :- </label>
                </div>
                <div class="col-sm-8">
                <h5>234567890</h5>
                </div>
              </div>
              <div class="mb-3 row">
                <div class="col-sm-4">
                  <label class="lable">candidate Name :- </label>
                </div>
                <div class="col-sm-8">
                <h5>Y.Lokesh</h5>
                </div>
              </div>
              <div class="mb-3 row">
                <div class="col-sm-4">
                  <label class="lable">Father Name:- </label>
                </div>
                <div class="col-sm-8">
                <h5>subbarayudu</h5>
                </div>
              </div>
              
              
              
              <div class="mb-3 row">
                <div class="col-sm-4">
                  <label class="lable">DOB:- </label>
                </div>
                <div class="col-sm-8" required>
                <h5>18-06-2003</h5>
                </div>
              </div>
              <div class="mb-3 row">
                <div class="col-sm-4">
                  <label class="lable">Category:- </label>
                </div>
                <div class="col-sm-8">
                <h5>OBC</h5>
                </div>
              </div>
             
              
            </div>
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group" style="float: right;">
                    <label class="lable"> Photo </label>
                    <div style="border: 1px solid black; height: 150px; width: 150px;  background: #F5FAFF;">
                      <img id="output" width="150" height="150" / style="display:none">
                    </div>

                    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" required
                      accept="image/*" / style="width:150px;" required>

                    <script>
                      var loadFile = function (event) {
                        var reader = new FileReader();
                        reader.onload = function () {
                          var output = document.getElementById('output');
                          output.src = reader.result;
                        };

                        $('#output').show();
                        reader.readAsDataURL(event.target.files[0]);
                      };
                    </script>
                  </div>
                </div>
              </div>
              <br>
              
            </div>
          </div> <!--Row 1 end -->
          <br>
          <div class="row">
            <div class="col-sm-2">
              <label class="lable"></label>
            </div>
            <div class="col-sm-8">
              <div id="msg-price"> </div>
            </div>
          </div> <!-- Row 5 end -->
          <div class="container">
          <div class="row">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-8" style="border: 2px solid black;padding:5px; text-align: center;">
        <h5>Marks</h5>
      </div>
      <div class="col-sm-2">
      </div>
      
    </div>
          </div>
        </form>
      </div>
      <div class="col-sm-2">
      </div>
    </div>
  </div>
</body>

</html>