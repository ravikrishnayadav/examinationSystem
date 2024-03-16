<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <style>

    /* ... your existing styles ... */

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1px; /* Add spacing between table and content */
        background-color: #caebefcf; /* Set your desired background color for the table */
        box-sizing: content-box;
    }

    .table th, .table td {
        border: 1px solid #ddd; /* Add borders to table cells */
        padding: 10px; /* Add padding to table cells */
        text-align: center; /* Align text to the left */
    }

    .table th{
        background-color: #B0E0E6;
        text-align: center;

    }




        header {
            width: 100%;
            height: 120px; /* Adjust the height as needed */
            background: url('banner.png') center/cover no-repeat; /* Replace 'your-banner-image.jpg' with your actual image path */
            text-align: center;
            color: #fff;
            padding-top: 50px;

        }
        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            margin-right: 50px /* Adjust the margin as needed to increase the space between navigation buttons */
        }

        nav a:hover {
            background-color: #f39c12;
            color: black;
        }
         
        nav {
            background-color: #154360;
            overflow: hidden;
            height: 45px;
        }
    </style>
</head>
<body>

    <header>
        

    </header>

    <nav>
        <a href="index.html">HOME</a>
        <a class='active' href="admin_interface.php">CANDIDATES</a>
        <a href="impdates.html">IMPORTANT DATES</a>
        <a href="contact.html">CONTACT US</a>
    </nav>

<div class="content">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">SNO</th>
      <th scope="col">Registration_Number</th>
      <th scope="col">Name</th>
      <th scope="col">FATHER NAME</th>
      <th scope="col">InterHallticket</th>
      <th scope="col">GENDER</th>
      <th scope="col">DOB</th>
      <th scope="col">Address</th>
      <th scope="col">Category</th>
      <th scope="col">Email</th>
      <th scope="col">HALL TICKET</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $server='localhost';
$username='root';
$password='';
$database='student_registration';                     
$conn=mysqli_connect($server,$username,$password,$database);
if($conn->connect_error){
    die("connection failed".$conn->connect_error);
}
echo"";
  $sql="select id,name,rollno,fname,email,phno,gender,dob,district,photo_path,hallticket_path from students";
  $result=mysqli_query($conn,$sql);
  $i=0;
  if($result->num_rows>0){
      while($rows=$result->fetch_assoc()){
          echo'
         <tr>
         <th scope="row">'.++$i.'</th>
         <td>'.$rows['name'].'</td>
         <td>'.$rows['rollno'].'</td>
         <td>'.$rows['fname'].'</td>
         <td>'.$rows['email'].'</td>
         <td>'.$rows['phno'].'</td>
         <td>'.$rows['gender'].'</td>
         <td>'.$rows['dob'].'</td>
         <td>'.$rows['district'].'</td>
         <td>'.$rows['photo_path'].'</td>
         <td>'.$rows['hallticket_path'].'</td> 
         </tr>';}}
        
   else{
     echo"";
     }
    ?>
  </tbody>
</table>
</div>
</div>
</body>
</html>