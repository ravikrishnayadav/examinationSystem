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
    <script>
        $(document).ready(function(){
            $('#form').submit(function(e){
                var errors = false;

                // Full Name validation
                var fullName = $('#name').val();
                if(!/^[a-zA-Z ]+$/.test(fullName)){
                    $('#fullNameError').text('Full Name must contain only alphabets').show();
                    errors = true;
                } else {
                    $('#fullNameError').hide();
                }

                // Father Name validation
                var fatherName = $('#fname').val();
                if(!/^[a-zA-Z ]+$/.test(fatherName)){
                    $('#fatherNameError').text('Father Name must contain only alphabets').show();
                    errors = true;
                } else {
                    $('#fatherNameError').hide();
                }

                // Intermediate Hallticket validation
                var interHallticket = $('#intermediate_hallticket').val();
                if(!/^\d{10}$/.test(interHallticket)){
                    $('#intermediateHallticketError').text('Intermediate Hallticket must contain 10 digits').show();
                    errors = true;
                } else {
                    $('#intermediateHallticketError').hide();
                }

                // Email validation
                var email = $('#email').val();
                if(!/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(email)){
                    $('#emailError').text('Invalid email address').show();
                    errors = true;
                } else {
                    $('#emailError').hide();
                }

                // Mobile validation
                var mobile = $('#mobile').val();
                if(!/^[6-9]\d{9}$/.test(mobile)){
                    $('#mobileError').text('Mobile number must start with a digit from 6 to 9 and have a length of 10 digits').show();
                    errors = true;
                } else {
                    $('#mobileError').hide();
                }

                // Check if all fields are filled
                if(errors){
                    e.preventDefault();
                }
            });
        });
    </script>
</head>
<body>
<div class="header">
        <div class="image-container">
            <img src="banner.jpg" alt="Description">
          </div>
          
    </div>
<div class="container" style="border: 2px solid black; padding:20px;">
    
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8" style="border: 3px solid black;padding:10px; text-align: center; background-color:#8fcee3">
            <h1>Registration Form </h1>
        </div>
        <div class="col-sm-2">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10" style="border: 0px solid black; padding:80px;">
            <form id="form" action="process_form.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3 row">
                            <div class="col-sm-4">
                                <label class="lable">Full Name :- </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="name" name="name" class="form-control" required>
                                <div id="fullNameError" class="text-danger" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-4">
                                <label class="lable">Father Name :- </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="fname" name="fname" class="form-control" required>
                                <div id="fatherNameError" class="text-danger" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-4">
                                <label class="lable">Intermediate Hallticket :- </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="intermediate_hallticket" name="intermediate_hallticket" class="form-control" required>
                                <div id="intermediateHallticketError" class="text-danger" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-4">
                                <label class="lable">District:- </label>
                            </div>
                            <div class="col-sm-8">
                                <select id="district" name="address" class="form-control" required>
                                    <option value="">Select District</option>
                                    <option value="kadapa">Kadapa</option>
                                    <option value="chittor">Chittor</option>
                                    <option value="anathapuram">Anathapuram</option>
                                    <option value="kurnool">Kurnool</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-4">
                                <label class="lable">Email:- </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="email" name="email" class="form-control" required>
                                <div id="emailError" class="text-danger" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-4">
                                <label class="lable">Mobile No:- </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="mobile" name="mobile" maxlength="10" class="form-control" required>
                                <div id="mobileError" class="text-danger" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-4">
                                <label class="lable">DOB:- </label>
                            </div>
                            <div class="col-sm-8" required>
                                <input type="date" id="dob" name="dob" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-4">
                                <label class="lable">Category:- </label>
                            </div>
                            <div class="col-sm-8">
                                <select id="category" name="category" class="form-control" required>
                                    <option value="">Select your category</option>
                                    <option value="SC">ST</option>
                                    <option value="ST">SC</option>
                                    <option value="OBC">OBC</option>
                                    <option value="General">General</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-4">
                                <label class="lable">Gender :- </label>
                            </div>
                            <div class="col-sm-8">
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group" style="float: right;">
                                    <label class="lable"> Photo </label>
                                    <div style="border: 1px solid black; height: 150px; width: 150px;  background: #F5FAFF;">
                                        <img id="output"  width="150" height="150" / style="display:none">
                                    </div>
                                    <input type="file" id="image" name="image" onchange="loadFile(event)" class="form-control" required accept="image/*" / style="width:150px;" required>
                                    <script>
                                        var loadFile = function(event) {
                                            var reader = new FileReader();
                                            reader.onload = function(){
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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group" style="float: right;">
                                    <label class="lable">Signature</label>
                                    <div style="border: 1px solid black; height: 120px; width: 150px;  background: #F5FAFF;">
                                        <img id="outputs"  width="150" height="120" / style="display:none">
                                    </div>
                                    <input type="file" id="simage" name="simage"  onchange="loadFiles(event)" class="form-control" required accept="image/*" / style="width:150px;" required>
                                    <script>
                                        var loadFiles = function(event) {
                                            var reader = new FileReader();
                                            reader.onload = function(){
                                                var output = document.getElementById('outputs');
                                                output.src = reader.result;
                                            }; 
                                            $('#outputs').show();
                                            reader.readAsDataURL(event.target.files[0]);
                                        };
                                    </script>
                                </div>  
                            </div>
                        </div>
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
                <div class="row">
                    <div class="col-sm-2">
                        <label class="lable">Declaration </label>
                    </div>
                    <div class="col-sm-8">
                        <div style=""><div id="msg-price"> </div></div>
                        <div style="border: 2px solid black;padding:10px; text-align: center;border-radius: 25px;">
                            <input type="checkbox" name="declare" required>
                            I declare that I have read and filled the above information, so if the information given by me is incorrect, you have the right to cancel without informing me.
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <br> 
                                <button class="btn btn-success" name="form_submit">Submit </button>
                            </div>
                            <div class="col-sm-4">
                            </div>
                        </div> 
                    </div>
                </div> <!-- Row 5 end --> 
            </form>
        </div>
        <div class="col-sm-2">
        </div>
    </div>
</div>
</body>
</html>
